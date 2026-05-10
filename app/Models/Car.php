<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    /**
     * Атрибуты, которые можно массово присваивать
     *
     * @var array
     */
    protected $fillable = [
        'color_id',
        'brend_id',
        'comment',
        'total_price',
        'owner_id',
    ];

    /**
     * Атрибуты, которые будут преобразованы к типам
     *
     * @var array
     */
    protected $casts = [
        'total_price' => 'float',
    ];

    /**
     * Связь: автомобиль относится к цвету
     */
    public function color()
    {
        return $this->belongsTo(Color::class, 'color_id');
    }

    /**
     * Связь: автомобиль относится к бренду
     */
    public function brend()
    {
        return $this->belongsTo(Brend::class, 'brend_id');
    }

    /**
     * Связь: автомобиль принадлежит владельцу (пользователю)
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
}
