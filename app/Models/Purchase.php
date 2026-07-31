<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $casts = [
        'items' => 'array',
        'purchased_at' => 'datetime',
    ];
}
