<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PersonResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'gender' => $this->gender,
            'height' => $this->height,
            'mass' => $this->mass,
            'hair_color' => $this->hair_color,
            'skin_color' => $this->skin_color,
            'eye_color' => $this->eye_color,
            'born_at' => $this->born_at,
            'died_at' => $this->died_at,
            'planet' => new PlanetResource($this->planet)
        ];
    }
}
