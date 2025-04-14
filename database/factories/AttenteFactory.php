<?php

namespace Database\Factories;

use App\Models\Attente;
use App\Models\TypeDocument;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Attente>
 */
class AttenteFactory extends Factory
{
    protected $model = Attente::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'numeroUnique' => $this->faker->unique()->uuid,
            'dateCreation' => $this->faker->date,
            'anneeAcademique' => $this->faker->year . '-' . ($this->faker->year + 1),
            'objet' => $this->faker->sentence,
            'typeDocument_id' => TypeDocument::inRandomOrder()->first()->id,
            'user_id' => User::inRandomOrder()->first()->id, 
        ];
    }
}
