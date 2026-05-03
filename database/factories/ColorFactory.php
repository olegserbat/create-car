<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Color;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Color>
 */
class ColorFactory extends Factory
{

    /**
     * Имя модели, связанной с фабрикой.
     *
     * @var string
     */
    protected $model = Color::class;

    /**
     * Определите состояние модели по умолчанию.
     *
     * @return array
     */
    public function definition(): array
    {
        // Случайно решаем, будет ли цвет бесплатным
        $isFree = $this->faker->boolean(30); // 30% шанс, что цвет бесплатный
        $price = $isFree ? 0 : $this->faker->randomFloat(2, 1, 5000); // от 1 до 5000, если не бесплатно

        return [
            'name' => fake()->safeColorName(),
            'price' => $price,
            'isFree' => $isFree, // устанавливаем isFree = 1, если цена 0
        ];
    }
}
