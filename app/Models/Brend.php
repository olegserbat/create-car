<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use App\Models\Car;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Brend extends Model
{
    use hasFactory;

    protected $fillable = [
        'name',
        'comment',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo('\App\Models\User', 'user_id');
    }

    public function cars():HasMany
    {
        return $this->hasMany(Car::class, 'brend_id', 'id');
    }
}
