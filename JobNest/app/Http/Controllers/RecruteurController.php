<?php

namespace App\Http\Controllers;

use App\Http\Requests\PropositionRequest;
use App\Http\Requests\RecruteurRequest;
use App\Http\Services\DashboardService;
use App\Http\Services\PropositionService;
use App\Http\Services\RecruteurService;
use App\Models\ProfileCandidat;
use App\Models\Proposition;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecruteurController extends Controller
{
    private RecruteurService $recruteurService;
    private PropositionService $propositionService;
    private DashboardService $dashboardService;

    public function __construct(RecruteurService $recruteurService, PropositionService $propositionService, DashboardService $dashboardService)
    {
        $this->recruteurService = $recruteurService;
        $this->propositionService = $propositionService;
        $this->dashboardService = $dashboardService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $profileRecruteur = $user->profileRecruteur;

        if (!$profileRecruteur) {
            return redirect()->route('home')->with('error', 'Profil non trouvé.');
        }

        return view('recruteur.show', compact('user', 'profileRecruteur'));
    }

    public function edit()
    {
        $user = Auth::user();
        $profileRecruteur = $user->profileRecruteur;

        return view('recruteur.edit', compact('user', 'profileRecruteur'));

    }

    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $user = Auth::user();
        $profileRecruteur = $user->profileRecruteur;

        if (!$profileRecruteur) {
            return redirect()->route('home')->with('error', 'Profil non trouvé.');
        }

        return view('recruteur.show', compact('user', 'profileRecruteur'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RecruteurRequest $request)
    {

        $user = Auth::user();
        $profileRecruteur = $user->profileRecruteur;
        try {
            $this->recruteurService->updateProfile($request, $profileRecruteur);
            return redirect()->route('recruteurs.show')->with('success', 'Votre profil et entreprise ont été mis à jour !');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erreur : ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $user = Auth::user();
        $profileRecruteur = $user->profileRecruteur;

        $this->recruteurService->deleteProfileRecruteur($request, $profileRecruteur);

        return redirect()->route('home')->with('success', 'Compte supprimé avec succès.');
    }


    public function searchCandidats(Request $request)
    {
        $filters = $request->all();
         $candidats = $this->recruteurService->searchCandidats($filters);
        $allCompetences = \App\Models\Competence::all();

        return view('recruteur.search', compact('candidats', 'allCompetences', 'filters'));
    }

    public function showCandidat(ProfileCandidat $profileCandidat)
    {
        if (!$profileCandidat->est_visible) {
            return redirect()->route('recruteur.search-candidats')->with('error', 'Ce profil n\'est pas visible.');
        }
        $profileCandidat->load(['experiences', 'certifications']);

        return view('recruteur.show-candidat', compact('profileCandidat'));
    }

    public function sendPropositions(PropositionRequest $request)
    {
        $candidatId = $request['candidat_id'];
        $candidat = User::findOrFail($candidatId);

        try {
            $this->propositionService->sendPropositions($request, auth()->user(), $candidat);
            return redirect()->route('recruteur.search-candidats')->with('success', 'Proposition envoyée avec succès !');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function getAllPropositionSendedByRecruteur()
    {
        $user = auth()->user();
        $propositions = $this->propositionService->getAllPropositionSendedByRecruteur($user);
        return view('recruteur.propositions.index', compact('propositions'));
    }

    public function showProposition(Proposition $proposition)
    {
        if ($proposition->recruteur_id !== Auth::id()) {
            abort(403, 'Action non autorisée');
        }

        $proposition->load(['candidat.profileCandidat']);
        return view('recruteur.propositions.show', compact('proposition'));
    }

    public function dashboard()
    {
        $user = Auth::user();
        $profileRecruteur = $user->profileRecruteur;

        $stats = $this->dashboardService->recruiterDashboard($profileRecruteur);

        $propositions = $this->propositionService->getAllPropositionSendedByRecruteur($user);


        return view('recruteur.dashboard', compact('user', 'stats', 'propositions'));
    }
}
