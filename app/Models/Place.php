<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Place extends Model
{
    use HasFactory, Sluggable;

    protected  $table = 'places';
    protected $fillable = [
        'title',
        'description',
        'coordinates',
    ];

    public function cities(): BelongsToMany
    {
        return $this->belongsToMany(City::class, 'cities_places',
            'place_id', 'city_id',
            'id', 'id'
        );
    }

    public function images(): BelongsToMany
    {
        return $this->belongsToMany(Image::class, 'places_images',
            'place_id', 'image_id',
            'id', 'id'
        );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function likes()
    {
        return $this->hasMany(Like::class);
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
