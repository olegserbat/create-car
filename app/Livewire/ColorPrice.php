<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Color;

class ColorPrice extends Component
{
    public ?int $colorId = null;
    public ?string $priceFormatted = null; // Будет "5 000,00 ₽"

    /**
     * При изменении colorId — получаем цену и форматируем
     */
    public function updatedColorId($value)
    {
        \Log::info('ColorId changed', ['color_id' => $value]);
        if ($value) {
            $color = Color::find($value);
            if ($color) {
                $this->priceFormatted = number_format($color->price, 2, ',', ' ') . ' ₽';
            } else {
                $this->priceFormatted = 'Цвет не найден';
            }
        } else {
            $this->priceFormatted = null;
        }
    }

    public function render()
    {
        return view('livewire.color-price');
    }
}
