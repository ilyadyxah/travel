<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class City extends Model
{
    use HasFactory, Sluggable;
    protected  $table = 'cities';
    protected $fillable = [
        'title',
        'description',
        'coordinates',
    ];

    public function places(): BelongsToMany
    {
        return $this->belongsToMany(Place::class, 'cities_places',
            'city_id', 'place_id',
            'id', 'id'
        );
    }


    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
