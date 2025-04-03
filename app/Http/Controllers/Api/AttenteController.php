<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AttenteResource;
use App\Models\Attente;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AttenteController extends Controller
{
    public function index()
    {
        return AttenteResource::collection(Attente::all());
    }

    public function store(Request $request)
    {
        // Génération des valeurs automatiques
        $dateCreation = Carbon::now()->toDateString();
        $numeroUnique = 'ATT-' . uniqid();

        // Validation des données
        $request->validate([
            'anneeAcademique' => 'required|string',
            'objet' => 'required|string|max:255',
            'typeDocument_id' => 'required|exists:type_documents,id',
            'user_id' => 'required|exists:users,id',
        ]);

        // Création de l'enregistrement avec les données validées et les valeurs générées
        return Attente::create(array_merge($request->all(), [
            'dateCreation' => $dateCreation,
            'numeroUnique' => $numeroUnique,
        ]));
    }


    public function show($id)
    {
        return Attente::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'dateCreation' => 'sometimes|string',
            'anneeAcademique' => 'sometimes|string',
            'numeroUnique' => 'sometimes|string|unique:attentes,numeroUnique,' . $id,
            'objet' => 'string|max:255',
            'typeDocument_id' => 'sometimes|exists:type_documents,id',
            'user_id' => 'sometimes|exists:users,id',
        ]);

        $attente = Attente::findOrFail($id);
        $attente->update($request->all());

        return $attente;
    }

    public function destroy($id)
    {
        $attente = Attente::findOrFail($id);
        $attente->delete();

        return response(null, 204);
    }
}
