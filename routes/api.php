<?php

use App\Http\Controllers\Api\EtudiantController;
use App\Http\Controllers\Api\MentionController;
use App\Http\Controllers\Api\PersonnelController;
use App\Http\Controllers\Api\PromotionController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::apiResource('etudiants', EtudiantController::class);
Route::apiResource('personnels', PersonnelController::class);
Route::apiResource('mentions', MentionController::class);
Route::apiResource('promotions', PromotionController::class);
Route::post('/login', [UserController::class, 'login']);


