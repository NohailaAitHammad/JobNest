<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CandidatController;
use App\Http\Controllers\API\CertificatController;
use App\Http\Controllers\API\CompetenceController;
use App\Http\Controllers\API\ExperienceController;
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

Route::middleware(['auth:sanctum', 'is.candidat'])->group(callback: function () {
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    Route::get("/candidats/profile/{profileCandidat}", [CandidatController::class, "show"]);
    Route::put("/candidats/profile/{profileCandidat}", [CandidatController::class, "update"]);
    Route::patch("/candidats/profile/visibility", [CandidatController::class, "toggleVisibility"]);
    Route::post("/candidats/profile/{profileCandidat}/cv", [CandidatController::class, "uploadCV"]);
    Route::post("/candidats/profile/{profileCandidat}/portfolio", [CandidatController::class, "uploadPortfolio"]);
    Route::post("/candidats/profile/{profileCandidat}/image", [CandidatController::class, "uploadImage"]);
    Route::delete("/candidats/profile/{profileCandidat}/delete", [CandidatController::class, "destroy"]);
    Route::post("/candidats/profile/{profileCandidat}/competences", [CompetenceController::class, 'addCompetence']);
    Route::post("/candidats/profile/{profileCandidat}/competences/{competence}", [CompetenceController::class, 'removeCompetence']);

    Route::get("/candidats/profile/{profileCandidat}/experiences", [ExperienceController::class, "index"]);
    Route::post("/candidats/profile/{profileCandidat}/experiences", [ExperienceController::class, "store"]);
    Route::put("/candidats/profile/{profileCandidat}/experiences/{experience}", [ExperienceController::class, "update"]);
    Route::delete("/candidats/profile/{profileCandidat}/experiences/{experience}", [ExperienceController::class, "destroy"]);

    Route::get("/candidats/profile/{profileCandidat}/competences", [CompetenceController::class, "index"]);
    Route::post("/admins/{user}/competences", [CompetenceController::class, "store"]);
    Route::put("/admins/{user}/competences/{competence}", [CompetenceController::class, "update"]);
    Route::delete("/admins/{user}/competences/{competence}", [CompetenceController::class, "destroy"]);
    Route::post("/candidats/profile/{profileCandidat}/competences", [CompetenceController::class, "addCompetence"]);
    Route::post("/candidats/profile/{profileCandidat}/competences/{competence}", [CompetenceController::class, "removeCompetence"]);

    Route::get("/candidats/profile/{profileCandidat}/certifications", [CertificatController::class, "index"]);
    Route::post("/candidats/profile/{profileCandidat}/certifications", [CertificatController::class, "store"]);
    Route::put("/candidats/profile/{profileCandidat}/certifications/{certification}", [CertificatController::class, "update"]);
    Route::delete("/candidats/profile/{profileCandidat}/certifications/{certification}", [CertificatController::class, "destroy"]);

});

Route::middleware(['auth:sanctum', 'is.recruteur'])->group(function () {
    Route::get("/recruteurs/{profileRecruteur}", [RecruteurController::class, "show"]);
    Route::put("/recruteurs/{profileRecruteur}", [RecruteurController::class, "update"]);
    Route::post("/recruteurs/profile/{profileRecruteur}/delete", [RecruteurController::class, "destroy"]);
});

Route::middleware(['auth:sanctum', 'is.admin'])->group(function (){
    Route::post('/competences', [CompetenceController::class, "store"]);
    Route::put('/competences/{competence}', [CompetenceController::class, "store"]);
    Route::delete('/competences/{competence}', [CompetenceController::class, "destroy"]);
});
