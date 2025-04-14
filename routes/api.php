<?php

use App\Http\Controllers\Api\AttenteController;
use App\Http\Controllers\Api\DocumentController;
use App\Http\Controllers\Api\EtudiantController;
use App\Http\Controllers\Api\MentionController;
use App\Http\Controllers\Api\PersonnelController;
use App\Http\Controllers\Api\PromotionController;
use App\Http\Controllers\Api\TypeDocumentController;
use App\Http\Controllers\Api\UserController;
use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Route;


// 🔐 Auth routes
Route::prefix('auth')->group(function () {
    Route::post('/login', [UserController::class, 'login']);
    Route::post('/logout', [UserController::class, 'logout'])->middleware('auth:sanctum');
});

// 🌐 Routes publiques pour l'ajout
Route::post('/etudiants', [EtudiantController::class, 'store']);
Route::post('/personnels', [PersonnelController::class, 'store']);

// 🔐 Routes protégées par Sanctum
Route::middleware('auth:sanctum')->group(function () {

    // 📘 Routes accessibles à tous les utilisateurs authentifiés
    Route::apiResource('mentions', MentionController::class);
    Route::apiResource('promotions', PromotionController::class);
    Route::apiResource('typeDocuments', TypeDocumentController::class);
    Route::apiResource('attentes', AttenteController::class);

    // 🔐 Routes accessibles uniquement aux administrateurs
    Route::middleware(IsAdmin::class)->group(function () {
        Route::apiResource('etudiants', EtudiantController::class)->except(['store']);
        Route::apiResource('personnels', PersonnelController::class)->except(['store']);
        Route::apiResource('documents', DocumentController::class);
    });
});
