<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Attente;
use App\Models\Etudiant;
use App\Models\Mention;
use App\Models\Personnel;
use App\Models\Promotion;
use App\Models\TypeDocument;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Mention::factory(5)->create();
        // Promotion::factory(15)->create();
        // TypeDocument::factory(10)->create();
        // Personnel::factory(20)->create();
        // Etudiant::factory(20)->create();
        // Attente::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Ado_MUKE',
        //     'email' => 'ado@gmail.com',
        //     'password' => Hash::make('@ado123'),
        //     'role' => 'admin',
        // ]);

        Admin::factory()->create([
            'nom' => 'Ado_MUKE',
            'prenom' => 'Ado',
            'user_id' => 41,
        ]);
    }
}
