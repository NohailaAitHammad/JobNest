<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CandidatController;
use App\Http\Controllers\CertificatController;
use App\Http\Controllers\CompetenceController;
use App\Http\Controllers\DomaineController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PropositionController;
use App\Http\Controllers\RecruteurController;
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

    /* gestion du profil candidat */
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

    /* dashboard candidat */
    Route::get("/candidats/dashboard", [CandidatController::class, "dashboard"])->name('candidat.dashboard');

});

Route::middleware(['auth', 'is.recruteur'])->group(function () {

    Route::get("/recruteurs/profile", [RecruteurController::class, "show"])->name('recruteurs.show');
    Route::get("/recruteurs/profile/edit", [RecruteurController::class, "edit"])->name('recruteurs.edit');
    Route::put("/recruteurs/profile", [RecruteurController::class, "update"])->name('recruteurs.update');
    Route::delete("/recruteurs/profile/delete", [RecruteurController::class, "destroy"])->name('recruteurs.destroy');

    Route::get("/recruteurs/search", [RecruteurController::class, "searchCandidats"])->name('recruteur.search-candidats');
    Route::get('/recruteurs/profile/{profileCandidat}', [RecruteurController::class, 'showCandidat'])->name('recruteur.show-candidat');

    Route::post("/recruteurs/propositions", [RecruteurController::class, "sendPropositions"])->name('recruteur.propositions-send');
    Route::get("/recruteurs/propositions", [RecruteurController::class, "getAllPropositionSendedByRecruteur"])->name('recruteurs.propositions');
    Route::get('/recruteurs/propositions/{proposition}', [RecruteurController::class, 'showProposition'])->name('recruteur.propositions.show');
    Route::get("/recruteur/dashboard", [RecruteurController::class, "dashboard"])->name('recruteur.dashboard');
});

Route::middleware(['auth', 'is.admin'])->group(function (){
    /* Profile et Dashboard */
    Route::get("/admin/dashboard", [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get("/admin/profile", [AdminController::class, "show"])->name('admin.show');

    /* Gestion des utilisateurs */
    Route::get('/admin/users', [AdminController::class, 'index'])->name('admin.users.index');
    Route::patch('/admin/users/{user}/toggle', [AdminController::class, 'toggle'])->name('admin.users.toggle');
    Route::delete('/admin/users', [AdminController::class, 'destroy'])->name('admin.users.destroy');

    /* Gestion des competences */
    Route::get('/admin/competences', [CompetenceController::class, 'adminIndex'])->name('admin.competences.index');
    Route::get('/admin/competences/create', [CompetenceController::class, 'create'])->name('admin.competences.create');
    Route::post('/admin/competences', [CompetenceController::class, "store"])->name('admin.competences.store');
    Route::get('/admin/competences/{competence}/edit', [CompetenceController::class, 'edit'])->name('admin.competences.edit');
    Route::put('/admin/competences/{competence}', [CompetenceController::class, "update"])->name('admin.competences.update');
    Route::delete('/admin/competences/{competence}', [CompetenceController::class, "destroy"])->name('admin.competences.destroy');

    /* Gestion des domaines */
    Route::get("/admin/domaines", [DomaineController::class, "index"])->name('admin.domaines.index');
    Route::get("/admin/domaines/create", [DomaineController::class, "create"])->name('admin.domaines.create');
    Route::get("/admin/domaines/{domaine}/edit", [DomaineController::class, "edit"])->name('admin.domaines.edit');
    Route::post("/admin/domaines", [DomaineController::class, "store"])->name('admin.domaines.store');
    Route::put("/admin/domaines/{domaine}", [DomaineController::class, "update"])->name('admin.domaines.update');
    Route::delete("/admin/domaines/{domaine}", [DomaineController::class, "destroy"])->name('admin.domaines.destroy');

});

Route::middleware(['auth'])->group(function () {
    Route::get('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.markRead');
    Route::get('/notifications/mark-all-read', [NotificationController::class, 'markAllRead'])->name('notifications.markAllRead');
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
});
