<?php

namespace Database\Factories;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin>
 */
class AdminFactory extends Factory
{
    protected $model = Admin::class;
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
            'role' => 'admin',
        ]);

        return [
            'nom' => $nom,
            'prenom' => $prenom,
            'user_id' => $user->id,
        ];
    }
}
