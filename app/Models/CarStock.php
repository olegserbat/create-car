<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CarStock extends Model
{
    use HasFactory;

    protected $fillable = [
        'brend_name',
        'color',
        'price',
        'number',
        'reserved_number',
        'is_booked',
        'description',
    ];
    protected $casts = [
        'price' => 'decimal:2',
        'is_booked' => 'boolean',
    ];
    public function available(): int {
        return max(0, $this->number - $this->reserved_number);
    }
}
