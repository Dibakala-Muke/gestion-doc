<?php

namespace Database\Factories;

use App\Models\Mention;
use App\Models\Personnel;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Personnel>
 */
class PersonnelFactory extends Factory
{
    protected $model = Personnel::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $nom = $this->faker->lastName;
        $prenom = $this->faker->firstName;

        // Création de l'utilisateur associé à l'étudiant
        $user = User::factory()->create([
            'name' => $nom . '_' . $prenom,
            'email' => $this->faker->unique()->safeEmail,
            'password' => Hash::make('password'), // ou bcrypt() si tu préfères
            'role' => 'personnel',
        ]);

        return [
            'nom' => $nom,
            'postnom' => $this->faker->lastName,
            'prenom' => $prenom,
            'fonction' => $this->faker->randomElement(['Professeur', 'Chef T', 'Assistant', 'Technicien']),
            'user_id' => $user->id,
            'mention_id' => Mention::inRandomOrder()->first()->id,
        ];
    }
}
