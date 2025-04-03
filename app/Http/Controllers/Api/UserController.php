<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function login(Request $request)
    {
        // Validation des entrées
        $validated = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string|min:6'
        ]);

        if ($validated->fails()) {
            return response()->json($validated->errors(), 403);
        }

        $credentials = ['email' => $request->email, 'password' => $request->password];

        try {
            // Tentative de connexion
            if (!Auth::attempt($credentials)) {
                return response()->json(['error' => 'Email or password incorrect'], 401);
            }

            // Récupérer l'utilisateur authentifié
            $user = Auth::user();

            // Génération du token avec Sanctum
            $token = $user->createToken('auth-token')->plainTextToken;

            return response()->json([
                'user' => $user,
                'token' => $token,
            ], 200);

        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }

    /**
     * Logout Method
     */
    public function logout(Request $request)
    {
        // Vérifie si l'utilisateur est authentifié
        if ($request->user()) {
            $request->user()->currentAccessToken()->delete();

            return response()->json([
                'message' => "User has been logged out successfully"
            ], 200);
        }

        return response()->json([
            'error' => 'User not authenticated'
        ], 401);
    }
}
