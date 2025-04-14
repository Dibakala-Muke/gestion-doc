<?php

namespace Database\Factories;

use App\Models\Mention;
use App\Models\Promotion;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Promotion>
 */
class PromotionFactory extends Factory
{
    protected $model = Promotion::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nom' => $this->faker->word,
            'anneeAcademique' => $this->faker->year . '-' . ($this->faker->year + 1),
            'mention_id' => Mention::inRandomOrder()->first()->id, 
        ];
    }
}
