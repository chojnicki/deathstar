<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PlanetResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'rotation_period' => $this->rotate_period,
            'orbital_period' => $this->orbital_period,
            'diameter' => $this->diameter,
            'climate' => $this->climate,
            'gravity' => $this->gravity,
            'terrains' => $this->terrains,
            'diameter' => $this->diameter,
            'population' => $this->population,
        ];
    }
}
