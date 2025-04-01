<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PersonnelRequest;
use App\Http\Resources\PersonnelResource;
use App\Models\Personnel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PersonnelController extends Controller
{
    // Récupérer tous les personnels
    public function index()
    {
        return PersonnelResource::collection(Personnel::all());
    }

    // Ajouter un personnel
    public function store(PersonnelRequest $request)
    {
        $user = new User();
        $user->name = $request->nom . '_' . $request->prenom;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = 'personnel';
        $user->save();
        
        $personnel = new Personnel();
        $personnel->nom = $request->nom;
        $personnel->postnom = $request->postnom;
        $personnel->prenom = $request->prenom;
        $personnel->fonction = $request->fonction;
        $personnel->mention_id = $request->mention_id;
        $personnel->user_id = $user->id;
        $personnel->save();
        return response()->json([
            'message' => 'Personnel créé avec succès',
            'personnel' => $personnel,
        ], 201);
    }

    // Afficher un personnel spécifique
    public function show($id)
    {
        $personnel = Personnel::with(['user', 'mention'])->findOrFail($id);
        return response()->json($personnel);
    }

    // Mettre à jour un personnel
    public function update(Request $request, $id)
    {
        $personnel = Personnel::findOrFail($id);

        $validated = $request->validate([
            'nom' => 'sometimes|string|max:255',
            'postnom' => 'sometimes|string|max:255',
            'prenom' => 'sometimes|string|max:255',
            'fonction' => 'sometimes|string|max:255',
            'user_id' => 'sometimes|exists:users,id',
            'mention_id' => 'sometimes|exists:mentions,id',
        ]);

        $personnel->update($validated);

        return response()->json($personnel);
    }

    // Supprimer un personnel
    public function destroy($id)
    {
        $personnel = Personnel::findOrFail($id);
        $personnel->delete();

        return response()->json(['message' => 'Personnel supprimé avec succès']);
    }
}
