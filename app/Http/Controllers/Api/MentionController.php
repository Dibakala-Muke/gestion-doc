<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Mention;
use Illuminate\Http\Request;

class MentionController extends Controller
{
    public function index()
    {
        return Mention::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string',
        ]);

        return Mention::create($request->all());
    }

    public function show($id)
    {
        return Mention::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $mention = Mention::findOrFail($id);
        $mention->update($request->all());

        return $mention;
    }

    public function destroy($id)
    {
        $mention = Mention::findOrFail($id);
        $mention->delete();

        return response(null, 204);
    }
}
