<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Status extends Model
{
    use HasFactory;
    protected $table = 'statuses';
    protected $fillable = [
        'title'

    ];


    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}
