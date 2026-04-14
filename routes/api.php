<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CandidatController;
use App\Http\Controllers\API\CertificatController;
use App\Http\Controllers\API\CompetenceController;
use App\Http\Controllers\API\RecruteurController;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    //return  UserResource::collection($request->user());
})->middleware('auth:sanctum');


Route::post("/register/signUpCondidat", [AuthController::class, "registerCondidat"]);
Route::post("/register/signUpRecruter", [AuthController::class, "registerRrecruter"]);
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::middleware(['auth:sanctum', 'is.candidat'])->group(function () {
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    Route::get("/candidats/{profileCandidat}", [CandidatController::class, "show"]);
    Route::put("/candidats/{profileCandidat}", [CandidatController::class, "update"]);
    Route::patch("/candidats/profile/visibility", [CandidatController::class, "toggleVisibility"]);
    Route::post("/candidats/profile/cv", [CandidatController::class, "uploadCV"]);
    Route::delete("/candidats/profile/{profileCandidat}/delete", [CandidatController::class, "destroy"]);
});

Route::middleware(['auth:sanctum', 'is.recruteur'])->group(function () {
    Route::get("/recruteurs/{profileRecruteur}", [RecruteurController::class, "show"]);
    Route::put("/recruteurs/{profileRecruteur}", [RecruteurController::class, "update"]);
    Route::post("/recruteurs/profile/{profileRecruteur}/delete", [RecruteurController::class, "destroy"]);
});


Route::apiResource('certifications', CertificatController::class);
Route::apiResource('competences', CompetenceController::class);
