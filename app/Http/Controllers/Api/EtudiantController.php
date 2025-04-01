<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\EtudiantRequest;
use App\Http\Resources\EtudiantResource;
use App\Models\Etudiant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EtudiantController extends Controller
{
    // Récupérer tous les étudiants
    public function index()
    {
        return EtudiantResource::collection(Etudiant::all());
    }

    // Ajouter un étudiant
    public function store(EtudiantRequest $request)
    {
        $user = new User();
        $user->name = $request->nom . '_' . $request->prenom;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = 'etudiant';
        $user->save();
        
        $etudiant = new Etudiant();
        $etudiant->nom = $request->nom;
        $etudiant->postnom = $request->postnom;
        $etudiant->prenom = $request->prenom;
        $etudiant->promotion_id = $request->promotion_id;
        $etudiant->user_id = $user->id;
        $etudiant->save();
        return response()->json([
            'message' => 'Étudiant créé avec succès',
            'etudiant' => $etudiant,
        ], 201);
    }

    // Afficher un étudiant spécifique
    public function show($id)
    {
        $etudiant = Etudiant::with(['user', 'promotion'])->findOrFail($id);
        return response()->json($etudiant);
    }

    // Mettre à jour un étudiant
    public function update(Request $request, $id)
    {
        $etudiant = Etudiant::findOrFail($id);

        $validated = $request->validate([
            'nom' => 'sometimes|string|max:255',
            'postnom' => 'sometimes|string|max:255',
            'prenom' => 'sometimes|string|max:255',
            'user_id' => 'sometimes|exists:users,id',
            'promotion_id' => 'sometimes|exists:promotions,id',
        ]);

        $etudiant->update($validated);

        return response()->json($etudiant);
    }

    // Supprimer un étudiant
    public function destroy($id)
    {
        $etudiant = Etudiant::findOrFail($id);
        $etudiant->delete();

        return response()->json(['message' => 'Étudiant supprimé avec succès']);
    }
}
