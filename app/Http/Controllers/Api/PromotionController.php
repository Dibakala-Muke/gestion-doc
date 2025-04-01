<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Promotion;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    public function index()
    {
        return Promotion::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string',
            'anneeAcademique' => 'required|string',
            'mention_id' => 'required|exists:mentions,id',
        ]);

        return Promotion::create($request->all());
    }

    public function show($id)
    {
        return Promotion::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $promotion = Promotion::findOrFail($id);
        $promotion->update($request->all());

        return $promotion;
    }

    public function destroy($id)
    {
        $promotion = Promotion::findOrFail($id);
        $promotion->delete();

        return response(null, 204);
    }
}
