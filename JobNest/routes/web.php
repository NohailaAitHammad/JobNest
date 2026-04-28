<?php

use App\Http\Controllers\API\AdminController;
use App\Http\Controllers\API\CertificatController;
use App\Http\Controllers\API\CompetenceController;
use App\Http\Controllers\API\DomaineController;
use App\Http\Controllers\API\ExperienceController;
use App\Http\Controllers\API\PropositionController;
use App\Http\Controllers\API\RecruteurController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CandidatController;
use Illuminate\Support\Facades\Route;

Route::get('/',
    function () {
        return view('home');
    }
)->name('home');
Route::middleware('guest')->group(function () {

    Route::get('/login', [AuthController::class, 'showLogin'])->name('show.login');
    Route::post('/login', [AuthController::class, 'login'])->name('login');

    Route::get('/register/candidat', [AuthController::class, 'showRegisterCandidat'])->name('register.show.candidat');
    Route::post('/register/candidat', [AuthController::class, 'registerCandidat'])->name('register.candidat');

    Route::get('/register/recruteur', [AuthController::class, 'showRegisterRecruteur'])->name('register.show.recruteur');
    Route::post('/register/recruteur', [AuthController::class, 'registerRecruteur'])->name('register.recruteur');
});

//Route::post("/register/signUpCondidat", [AuthController::class, "registerCondidat"])->name("");
//Route::post("/register/signUpRecruter", [AuthController::class, "registerRrecruter"]);
//Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::middleware(['auth', 'is.candidat'])->group(callback: function () {

    /* gestion du profile candidat */
    Route::get("/candidats/profile", [CandidatController::class, "show"])->name('candidat.show');
    Route::get("/candidat/profile/edit", [CandidatController::class, 'edit'])->name('candidat.edit');
    Route::put("/candidats/profile", [CandidatController::class, "update"])->name('candidat.profile.update');
    Route::patch("/candidats/profile/visibility", [CandidatController::class, "toggleVisibility"])->name('candidat.profile.toggle-visibility');
    Route::post("/candidats/profile/cv", [CandidatController::class, "uploadCV"])->name('candidat.upload-cv');
    Route::post("/candidats/profile/portfolio", [CandidatController::class, "uploadPortfolio"])->name('candidat.upload-portfolio');
    Route::post("/candidats/profile/image", [CandidatController::class, "uploadImage"])->name('candidat.upload-image');
    Route::delete("/candidats/profile/delete", [CandidatController::class, "destroy"])->name('candidat.destroy');


//    Route::post("/candidats/profile/{profileCandidat}/competences", [CompetenceController::class, 'addCompetence'])->name('candidats.profile.competences.add');
//    Route::post("/candidats/profile/{profileCandidat}/competences/{competence}", [CompetenceController::class, 'removeCompetence'])->name('candidats.profile.competence.destroy');

    /* gestion des experiences */
    Route::get("/candidats/experiences", [ExperienceController::class, "index"])->name('candidats.experiences.index');
    Route::get("/candidats/experiences/create", [ExperienceController::class, "create"])->name('candidats.experiences.create');
    //Route::get("/candidats/experiences/{experience}", [ExperienceController::class, "show"])->name('candidats.experiences.show');
    Route::get("/candidats/experiences/{experience}/edit", [ExperienceController::class, "edit"])->name('candidats.experiences.edit');
    Route::post("/candidats/experiences", [ExperienceController::class, "store"])->name('candidats.experience.store');
    Route::put("/candidats/experiences/{experience}", [ExperienceController::class, "update"])->name('candidats.experiences.update');
    Route::delete("/candidats/experiences/{experience}", [ExperienceController::class, "destroy"])->name('candidats.experiences.destroy');

    /* gestion des competences */
    Route::get("/candidats/competences", [CompetenceController::class, "index"])->name('candidats.competences.index');
    Route::post("/candidats/competences", [CompetenceController::class, "addCompetence"])->name('candidats.competences.add');

    /* gestion des certifications */
    Route::get("/candidats/certifications", [CertificatController::class, "index"])->name('candidats.certifications.index');
    Route::get("/candidats/certifications/create", [CertificatController::class, "create"])->name('candidats.certifications.create');
    Route::post("/candidats/certifications", [CertificatController::class, "store"])->name('candidats.certifications.store');
    Route::put("/candidats/certifications/{certification}", [CertificatController::class, "update"])->name('candidats.certifications.update');
    Route::get("/candidats/certifications/{certification}/edit", [CertificatController::class, "edit"])->name('candidats.certifications.edit');
    Route::delete("/candidats/certifications/{certification}", [CertificatController::class, "destroy"])->name('candidats.certifications.destroy');

    /* gestion des propositions */
    Route::get("/candidats/propositions", [PropositionController::class, "index"])->name('candidats.propositions.index');
    Route::get("/candidats/propositions/{proposition}", [PropositionController::class, "show"])->name('candidats.propositions.show');
    Route::post("/candidats/propositions/{proposition}/accepter", [PropositionController::class, "accepter"])->name('candidats.propositions.accepter');
    Route::post("/candidats/propositions/{proposition}/refuser", [PropositionController::class, "refuser"])->name('candidats.propositions.refuser');


    Route::get("/candidats/dashboard", [CandidatController::class, "dashboard"])->name('candidat.dashboard');

});

Route::middleware(['auth', 'is.recruteur'])->group(function () {
    Route::get("/recruteurs/profile", [RecruteurController::class, "show"])->name('recruteur.show');
    Route::put("/recruteurs/profile", [RecruteurController::class, "update"])->name('recruteurs.profile.update');
    Route::delete("/recruteurs/profile/delete", [RecruteurController::class, "destroy"])->name('recruteurs.profile.destroy');
    Route::get("/recruteurs/search", [RecruteurController::class, "searchCandidats"])->name('recruteur.search-candidats');

    Route::post("/recruteurs/propositions", [RecruteurController::class, "sendPropositions"])->name('recruteur.propositions-send');
    Route::get("/recruteurs/propositions", [RecruteurController::class, "getAllPropositionSendedByRecruteur"])->name('recruteur.propositions');
    Route::get("/recruteur/dashboard", [RecruteurController::class, "dashboard"])->name('recruteur.dashboard');

});

Route::middleware(['auth', 'is.admin'])->group(function (){
    Route::get("/admin/profile", [AdminController::class, "show"])->name('admin.show');

    Route::get('/admin/competences', [CompetenceController::class, 'adminIndex'])->name('admin.competences.index');
    Route::get('/admin/competences/create', [CompetenceController::class, 'create'])->name('admin.competences.create');
    Route::post('/admin/competences', [CompetenceController::class, "store"])->name('admin.competences.store');
    Route::get('/admin/competences/{competence}/edit', [CompetenceController::class, 'edit'])->name('admin.competences.edit');
    Route::put('/admin/competences/{competence}', [CompetenceController::class, "update"])->name('admin.competences.update');
    Route::delete('/admin/competences/{competence}', [CompetenceController::class, "destroy"])->name('admin.competences.destroy');



    Route::get("/admins/domaines", [DomaineController::class, "index"])->name('admin.competences');
    Route::post("/admins/domaines", [DomaineController::class, "store"])->name('admin.domaine.store');


    Route::put("/admins/domaines/{domaine}", [DomaineController::class, "update"])->name('admin.domaine.update');
    Route::delete("/admins/domaines/{domaine}/delete", [DomaineController::class, "destroy"])->name('admin.domaine.destroy');
    Route::get("/admin/dashboard", [AdminController::class, 'dashboard'])->name('admin.dashboard');
});
