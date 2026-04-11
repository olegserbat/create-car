<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brend extends Model
{
    protected $fillable = [
        'name',
        'comment',
        'user_id',
    ];
}
