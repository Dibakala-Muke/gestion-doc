<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DocumentResource;
use App\Models\Attente;
use App\Models\Document;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function index()
    {
        return DocumentResource::collection(Document::all());
    }

    public function store(Request $request)
    {
        // Récupérer l'enregistrement de l'attente
        $attente = Attente::findOrFail($request->id);

        // Extraire les champs nécessaires
        $documentData = $attente->only([
            'numeroUnique',
            'dateCreation',
            'anneeAcademique',
            'objet',
            'typeDocument_id',
            'user_id',
        ]);

        // Créer le document
        $document = Document::create($documentData);

        // Supprimer l'attente
        $attente->delete();

        // Retourner la réponse JSON avec un message simple
        return response()->json([
            'message' => 'Document approuvé avec succès.',
            'document' => $document,
        ]);
    }


    public function show($id)
    {
        return Document::findOrFail($id);
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

        $attente = Document::findOrFail($id);
        $attente->update($request->all());

        return $attente;
    }

    public function destroy($id)
    {
        $attente = Document::findOrFail($id);
        $attente->delete();

        return response(null, 204);
    }
}
