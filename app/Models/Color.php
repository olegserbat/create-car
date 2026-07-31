<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Color extends Model
{
    use hasFactory;

    protected  $fillable = [
        'name',
        'price',
        'isFree',
    ];

    public function cars():HasMany
    {
        return $this->hasMany(Car::class, 'color_id', 'id');
    }
}
