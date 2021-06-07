<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Planet extends Model
{
    use HasFactory;

    protected $casts = [
        'terrains' => 'array',
        'climate' => 'array',
    ];

    protected $guarded = ['id'];

    public function people(): HasMany
    {
        return $this->hasMany(Person::class);
    }
}
