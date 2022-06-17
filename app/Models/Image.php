<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class Image extends Model
{
    use HasFactory;

    protected $table = 'images';
    protected $fillable = [
        'url',
    ];

    /**
     * @return HasMany
     */

    public function places()
    {
        return $this->hasMany(Place::class);
    }
}
