<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Transport extends Model
{
    use HasFactory;
    protected  $table = 'transports';

    public function places(): BelongsToMany
    {
        return $this->belongsToMany(Place::class, 'places_transports',
            'transport_id', 'place_id',
            'id', 'id'
        );
    }
}
