<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CandidatController;
use App\Http\Controllers\API\CertificatController;
use App\Http\Controllers\API\CompetenceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post("/register/signUpCondidat", [AuthController::class, "registerCondidat"]);
Route::post("/register/signUpRecruter", [AuthController::class, "registerRrecruter"]);
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    Route::get("/candidats/{profileCandidat}", [CandidatController::class, "show"]);
    Route::put("/candidats/{profileCandidat}", [CandidatController::class, "update"]);


    /*competences */
});
Route::apiResource('certifications', CertificatController::class);
Route::apiResource('competences', CompetenceController::class);
