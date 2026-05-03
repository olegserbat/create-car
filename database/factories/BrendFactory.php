<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Brend;
use App\Models\User;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Brend>
 */
class BrendFactory extends Factory
{
    protected $model = Brend::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->company(),
            'comment' => fake()->sentence(),
            'user_id' => User::factory(), // автоматически создаст или использует существующего
        ];
    }
}
