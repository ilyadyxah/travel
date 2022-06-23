<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class Place extends Model
{
    use HasFactory, Sluggable;

    protected $table = 'places';
    protected $fillable = [
        'title',
        'description',
        'coordinates',
        'main_picture_id',
        'complexity',
        'distance',
        'latitude',
        'longitude',
        'created_by_user_id',
        'cost',
        'district',
        'region'
    ];

    public static function getFieldsToCreate(): array
    {
        return [
            'title' => 'название',
            'description' => 'описание',
            'latitude' => 'широта',
            'longitude' => 'долгота',
//            'distance' => 'расстояние от города',
            'complexity' => 'сложность',
            'cost' => 'стоимость',
        ];
    }

    public static function getLinkedFields(): array
    {
        return [
            'cities' => 'город',
            'transports' => 'транспорт',
            'images' => 'фото',
            'groups' => 'группа',
            'types' => 'тип',

        ];
    }

    public static function GetLinkedModelsWithoutImages()
    {
        $linkedModelsWithoutImages = [];
        foreach (self::getLinkedFields() as $model => $cyrillic){
            if($model === 'images') continue;
            $linkedModelsWithoutImages[$model] = DB::table($model)->get();

        }
        return $linkedModelsWithoutImages;
    }

    public function cities(): BelongsToMany
    {
        return $this->belongsToMany(City::class, 'cities_places',
            'place_id', 'city_id',
            'id', 'id'
        );
    }

    public function transports(): BelongsToMany
    {
        return $this->belongsToMany(Transport::class, 'places_transports',
            'place_id', 'transport_id',
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
     * @return HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function groups(): BelongsToMany
    {
        return $this->belongsToMany(Group::class, 'places_groups',
            'place_id', 'group_id',
            'id', 'id'
        );
    }

    public function types(): BelongsToMany
    {
        return $this->belongsToMany(Type::class, 'places_types',
            'place_id', 'type_id',
            'id', 'id'
        );
    }

    public function routes(): HasMany
    {
        return $this->hasMany(Route::class);
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public static function getWithFilters(array $filters, $filteredWithTransport = null)
    {
        $places =
            Place::query()
                ->when($filters['minDistance'],
                    function ($query, $minDistance) {
                        return $query->where('distance', '>', $minDistance);
                    })
                ->when($filters['maxDistance'],
                    function ($query, $maxDistance) {
                        return $query->where('distance', '<', $maxDistance);
                    })
                ->when($filters['minCost'],
                    function ($query, $minCost) {
                        return $query->where('cost', '>', $minCost);
                    })
                ->when($filters['maxCost'],
                    function ($query, $maxCost) {
                        return $query->where('cost', '<', $maxCost);
                    })
                ->when($filters['complexity'],
                    function ($query, $complexity) {
                        return $query->where('complexity', $complexity);
                    })
                ->when($filteredWithTransport,
                    function ($query, $places_id) {
                        return $query->whereIn('id', $places_id);
                    });

        if ($search = $filters['search']) {
            $places = $places
                ->where('title', 'like', "%$search%")
                ->orWhere('description', 'like', "%$search%");
        }

        $places = $places->get();

        if ($filters['city']) {
            $places = $places->reject(function ($place) use ($filters) {
                return
                    $place->cities->first()->id != $filters['city'];
            });
        }

        if ($filters['transport']) {
            $places = $places->reject(function ($place) use ($filters) {
                return
                    !$place->transports->find($filters['transport']);
            });
        }

        return $places;
    }

    public static function getWhithFiltersOnPage(int $page, int $itemsPerPage, array $filters): LengthAwarePaginator
    {
        $places = self::getWithFilters($filters);

        return
            new LengthAwarePaginator(
                $places->forPage($page, $itemsPerPage),
                $places->count(),
                $itemsPerPage,
                []
        );
    }
}
