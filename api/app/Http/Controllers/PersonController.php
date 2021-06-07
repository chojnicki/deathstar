<?php

namespace App\Http\Controllers;

use App\Http\Requests\IndexPersonRequest;
use App\Http\Requests\UpdatePersonRequest;
use App\Http\Resources\PersonBasicResource;
use App\Http\Resources\PersonResource;
use App\Models\Person;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PersonController extends Controller
{

    public function index(IndexPersonRequest $request): ResourceCollection
    {
        $perPage = $request->input('per_page', 10);

        return PersonBasicResource::collection(
            Person::paginate($perPage)
        );
    }

    public function show(Person $person): PersonResource
    {
        return new PersonResource($person);
    }

    public function destroy(Person $person): PersonResource
    {
        $person->delete();

        return new PersonResource($person);
    }

    public function update(UpdatePersonRequest $request, Person $person): PersonResource
    {
        $person->fill($request->validated());
        $person->save();

        return new PersonResource($person);
    }
}