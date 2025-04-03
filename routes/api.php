<?php

use App\Http\Controllers\Api\AttenteController;
use App\Http\Controllers\Api\DocumentController;
use App\Http\Controllers\Api\EtudiantController;
use App\Http\Controllers\Api\MentionController;
use App\Http\Controllers\Api\PersonnelController;
use App\Http\Controllers\Api\PromotionController;
use App\Http\Controllers\Api\TypeDocumentController;
use App\Http\Controllers\Api\UserController;
use App\Models\TypeDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// Routes d'authentification
Route::prefix('auth')->group(function () {
    Route::post('/login', [UserController::class, 'login']);
    Route::post('/logout', [UserController::class, 'logout'])->middleware('auth:sanctum');
});

// Routes protégées par Sanctum
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('etudiants', EtudiantController::class);
    Route::apiResource('personnels', PersonnelController::class);
    Route::apiResource('mentions', MentionController::class);
    Route::apiResource('promotions', PromotionController::class);
});

Route::apiResource('typeDocuments', TypeDocumentController::class);
Route::apiResource('attentes', AttenteController::class);
Route::apiResource('documents', DocumentController::class);
