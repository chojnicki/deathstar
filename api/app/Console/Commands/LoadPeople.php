<?php

namespace App\Console\Commands;

use App\Models\Person;
use App\Models\Planet;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Validator;

class LoadPeople extends Command
{
    protected $signature = 'people:load {limit=50 : Limit max people to load}';
    protected $description = 'Load people from external SW API';

    private array $items = [];
    private string $nextPageUrl = '';
    private array $planetsCache = []; // store url and internal IDs for later to associating with person 

    public function __construct()
    {
        parent::__construct();
    }

    /* Handle command execution */
    public function handle(): int
    {
        if (! $this->confirm('This command will wipe current people and planets in database. Continue?', true)) {
            $this->error('Aborting...');
            return 0;
        }

        if (! $this->validate()) {
            $this->error('Aborting...');
            return 0;
        }

        if (! $this->loopFetching('https://swapi.dev/api/planets/')) {
            $this->error('Aborting...');
            return 0;
        }
        $this->storePlanets(); // save results in db

        if (! $this->loopFetching('https://swapi.dev/api/people/', $this->argument('limit'))) {
            $this->error('Aborting...');
            return 0;
        }
        $this->storePeople(); // save results in db


        $this->info('Loading completed!');
        return 0;
    }

    /* Start fetching from first page until filled */
    private function loopFetching(string $url, int $limit = 0): bool
    {
        $this->info('Fetching items to memory from ' . $url . '...');
        $this->items = [];
        $this->nextPageUrl = $url; // first page init
        do {
            if (! $this->fetchNextPage()) {
                $this->error('Error while connecting to swapi.dev...');
                return false;
            }
            $this->info('Fetched ' . count($this->items) . ' items to memory so far...');
            if (empty($this->nextPageUrl)) break; 
        } while (($limit === 0) || (count($this->items) < $limit));

        $this->info('Fetching to memory completed.');

        return true;
    }

    /* Get items from next page */
    private function fetchNextPage(): bool
    {
        $response = Http::get($this->nextPageUrl);
        if ($response->failed()) {
            $this->error('Error while connecting to swapi.dev!');
            return false;
        }

        $data = $response->json();
        if (! empty($data['results'])) {
            $this->items = [...$this->items, ...$data['results']];
            $this->nextPageUrl = $data['next'] ?: '';
        }

        return true;
    }

    /* Validate command arguments */
    private function validate(): bool
    {
        $validator = Validator::make(['limit' => $this->argument('limit')], [
            'limit' => ['integer', 'min:1', 'max:1000']
        ]);

        if ($validator->stopOnFirstFailure()->fails()) {
            $this->error($validator->errors()->all()[0]);
            return false;
        }

        return true;
    }

    /* Parse and save fetched people items to database */
    private function storePeople(): void
    {
        $this->info('Parsing and storing people...');

        $this->items = array_slice($this->items, 0, $this->argument('limit')); // if fetched more
        
        Person::truncate();

        foreach($this->items as $item) {
            $person = new Person([
                'name' => self::filterValue($item['name']),
                'height' => self::filterValue($item['height']),
                'mass' => self::filterValue($item['mass']),
                'hair_color' => self::filterValue($item['hair_color']),
                'skin_color' => self::filterValue($item['skin_color']),
                'eye_color' => self::filterValue($item['eye_color']),
                'gender' => self::filterValue($item['gender']),
                'born_at' => self::filterValue(str_replace('BBY', '', $item['birth_year'])),
                'died_at' => null,
            ]);

            if (! empty($this->planetsCache[$item['homeworld']])) {
                $person->planet_id = $this->planetsCache[$item['homeworld']];
            }

            $person->save();
        }

        $this->info('Successfully saved ' . Person::count() . ' people.');
    }

    /* Parse and save fetched planet items to database */
    private function storePlanets(): void
    {
        $this->info('Parsing and storing planets...');
        
        Planet::truncate();

        foreach($this->items as $item) {
            $planet = new Planet([
                'name' => self::filterValue($item['name']),
                'rotation_period' => self::filterValue($item['rotation_period']),
                'orbital_period' => self::filterValue($item['orbital_period']),
                'diameter' => self::filterValue($item['diameter']),
                'climate' => explode(',', $item['climate']),
                'gravity' => self::filterValue($item['gravity']),
                'terrains' => explode(',', $item['terrain']),
                'surface_water' => self::filterValue($item['surface_water']),
                'population' => self::filterValue($item['population']),
            ]);
            if (empty($planet->name)) continue; // broken item on api
            $planet->save();
            $this->planetsCache[$item['url']] = $planet->id; // for easier association
        }

        $this->info('Successfully saved ' . Planet::count() . ' planets.');
    }

    /* Replace "unknown", "n/a" etc in values */
    private static function filterValue(string $value): mixed
    {
        $filtered = str_replace(['unknown', 'n/a', 'null', '?'], '', $value);
        $filtered = trim($filtered);

        if (is_numeric(str_replace(',', '', $filtered))) { // 11,11 to 11.11
            $filtered = str_replace(',', '.', $filtered);
        }

        return ! empty($filtered) ? $filtered : null;
    }
}
