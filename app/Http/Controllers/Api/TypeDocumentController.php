<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TypeDocumentResource;
use App\Models\TypeDocument;
use Illuminate\Http\Request;

class TypeDocumentController extends Controller
{
    public function index()
    {
        return TypeDocumentResource::collection(TypeDocument::all());
    }

    public function store(Request $request)
    {
        // Valide les données d'entrée
        $request->validate([
            'nom' => 'required|string|max:255',
        ]);

        // Crée un nouveau type de document
        return TypeDocument::create($request->all());
    }

    public function show($id)
    {
        // Récupère un type de document spécifique
        return TypeDocument::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        // Valide les données d'entrée
        $request->validate([
            'nom' => 'sometimes|string|max:255',
        ]);

        // Met à jour un type de document existant
        $typeDocument = TypeDocument::findOrFail($id);
        $typeDocument->update($request->all());

        return $typeDocument;
    }

    public function destroy($id)
    {
        // Supprime un type de document
        $typeDocument = TypeDocument::findOrFail($id);
        $typeDocument->delete();

        return response(null, 204);
    }
}
