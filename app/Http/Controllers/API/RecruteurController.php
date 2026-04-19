<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\FilterCandidatsRequest;
use App\Http\Requests\PropositionRequest;
use App\Http\Requests\RecruteurRequest;
use App\Http\Resources\ProfileCandidatResource;
use App\Http\Resources\ProfileRecruteurResource;
use App\Http\Resources\PropositionResource;
use App\Http\Services\DashboardService;
use App\Http\Services\PropositionService;
use App\Http\Services\RecruteurService;
use App\Models\ProfileRecruteur;
use App\Models\User;
use Illuminate\Http\Request;

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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ProfileRecruteur $profileRecruteur)
    {
        $profileRecruteur = $this->recruteurService->getProfile($profileRecruteur);
        return response()->json([
            "success" => true,
            "message" => "Profile Recruteur",
            "data" =>new ProfileRecruteurResource($profileRecruteur)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RecruteurRequest $request, ProfileRecruteur $profileRecruteur)
    {
        $this->recruteurService->updateProfile($request, $profileRecruteur);
        return response()->json([
            "success" => true,
            "message" => "Profile Candidat Modifier avec success",
            "data" => new ProfileRecruteurResource($profileRecruteur)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, ProfileRecruteur $profileRecruteur)
    {
        $this->recruteurService->deleteProfileRecruteur($request, $profileRecruteur);
        return response()->json([
            "success" => true,
            "message" => "Profile Recruteur Supprimer avec success",
            "data" => new ProfileRecruteurResource($profileRecruteur)
        ]);
    }


    public function searchCandidats(FilterCandidatsRequest $request)
    {
        $validated = $request->validated();
         $candidats = $this->recruteurService->searchCandidats($validated);
        return response()->json([
                "success" => true,
                "message" => "Liste des candidats filtres",
                "data" => ProfileCandidatResource::collection($candidats)
        ]);
    }

    public function sendPropositions(PropositionRequest $request, User $user)
    {
        $proposition = $this->propositionService->sendPropositions($request,auth()->user(), $user );
        return response()->json([
            "success" => true,
            "message" => "Proposition est bien envoyer",
            "data" => new PropositionResource($proposition)
        ]);
    }

    public function getAllPropositionSendedByRecruteur()
    {
        $user = auth()->user();
        $propositions = $this->propositionService->getAllPropositionSendedByRecruteur(auth()->user());
        return response()->json([
            "success" => true,
            "message" => "Liste des propositions envoyer",
            "data" => PropositionResource::collection($propositions)
        ]);
    }

    public function dashboard(ProfileRecruteur $profileRecruteur)
    {
        $stats = $this->dashboardService->recruiterDashboard($profileRecruteur);
        return response()->json([
            "success" => true,
            "message" => "Statistique du recruteur",
            "data" => $stats
        ]);
    }
}
