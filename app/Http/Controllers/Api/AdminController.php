<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // Récupérer tous les étudiants
    public function index()
    {
        $admins = Admin::all();
        return $admins;

    }


    // Ajouter un étudiant
    public function store(Request $request)
    {
        $user = new User();
        $user->name = $request->nom . '_' . $request->prenom;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = 'admin';
        $user->save();

        $etudiant = new Admin();
        $etudiant->nom = $request->nom;
        $etudiant->prenom = $request->prenom;
        $etudiant->user_id = $user->id;
        $etudiant->save();
        return response()->json([
            'message' => 'Étudiant créé avec succès',
            'etudiant' => $etudiant,
        ], 201);
    }
}
