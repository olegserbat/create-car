<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;

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
}
