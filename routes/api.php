<?php

use App\Http\Controllers\Api\AttenteController;
use App\Http\Controllers\Api\DocumentController;
use App\Http\Controllers\Api\EtudiantController;
use App\Http\Controllers\Api\MentionController;
use App\Http\Controllers\Api\PersonnelController;
use App\Http\Controllers\Api\PromotionController;
use App\Http\Controllers\Api\TypeDocumentController;
use App\Http\Controllers\Api\UserController;
use App\Http\Resources\EtudiantResource;
use App\Models\TypeDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Routes d'authentification
Route::prefix('auth')->group(function () {
    Route::post('/login', [UserController::class, 'login']);
    Route::post('/logout', [UserController::class, 'logout'])->middleware('auth:sanctum');
});

// Routes protégées par Sanctum
Route::middleware('auth:sanctum')->group(function () {

    Route::apiResource('mentions', MentionController::class);
    Route::apiResource('promotions', PromotionController::class);
    Route::apiResource('typeDocuments', TypeDocumentController::class);
    Route::apiResource('attentes', AttenteController::class);

    // ✅ Vérifie le rôle avant de charger les routes admin
    Route::group([], function () {
        // Vérifie si l'utilisateur est admin
        if (auth()->user()?->role === 'admin') {
            Route::apiResource('personnels', PersonnelController::class)->except(['store']);
            Route::apiResource('etudiants', EtudiantController::class)->except(['store']);
            Route::apiResource('documents', DocumentController::class);
        }
    });
});

Route::post('/etudiants', [EtudiantController::class, 'store']);
Route::post(('/personnels'), [PersonnelController::class, 'store']);


Route::apiResource('personnels', PersonnelController::class)->except(['store']);
Route::apiResource('etudiants', EtudiantController::class)->except(['store']);
Route::apiResource('documents', DocumentController::class);
