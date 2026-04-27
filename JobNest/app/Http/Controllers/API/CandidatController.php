<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileCandidatRequest;
use App\Http\Requests\PropositionRequest;
use App\Http\Resources\ProfileCandidatResource;
use App\Http\Resources\PropositionResource;
use App\Http\Services\CandidatService;
use App\Http\Services\DashboardService;
use App\Http\Services\PropositionService;
use App\Models\ProfileCandidat;
use App\Models\Proposition;
use App\Models\User;
use Illuminate\Http\Request;

class CandidatController extends Controller
{
    private CandidatService $candidatService;
    private PropositionService $propositionService;
    private DashboardService $dashboardService;

    /**
     * @param CandidatService $candidatService
     */
    public function __construct(CandidatService $candidatService, PropositionService $propositionService, DashboardService $dashboardService)
    {
        $this->candidatService = $candidatService;
        $this->propositionService = $propositionService;
        $this->dashboardService = $dashboardService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            "success" => true,
            "message" => "Liste des profiles candidats",
            "data" => ProfileCandidat::with('user')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     */
    public function show(ProfileCandidat $profileCandidat)
    {
        $profileCandidat = $this->candidatService->getProfile($profileCandidat);
        return response()->json([
            "success" => true,
            "message" => "Profile Candidat",
            "data" =>new ProfileCandidatResource($profileCandidat)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProfileCandidatRequest $request, ProfileCandidat $profileCandidat)
    {
         $this->candidatService->updateProfile($request, $profileCandidat);
        return response()->json([
            "success" => true,
            "message" => "Profile Candidat Modifier avec success",
            "data" => new ProfileCandidatResource($profileCandidat)
        ]);
    }

    public function toggleVisibility(Request $request)
    {
        $user = $request->user();
        $visible = $this->candidatService->toggleVisibility($user);
        return response()->json([
            "success" => true,
            "message" => $visible ?  "Visibilité du Profile Candidat est active":"Visibilité du Profile Candidat est inactive"
        ]);
    }

        public function uploadCV(ProfileCandidatRequest $request, ProfileCandidat $profileCandidat)
    {
        $path = $this->candidatService->uploadCV($request, $profileCandidat);
        return response()->json([
            "success" => true,
            "message" => "CV importer avec success",
            "data" => new ProfileCandidatResource($profileCandidat)
            //"data" => $path
        ]);
    }
    public function uploadPortfolio(Request $request, ProfileCandidat $profileCandidat)
    {
        $path = $this->candidatService->uploadPortfolio($request, $profileCandidat);
        return response()->json([
            "success" => true,
            "message" => "Portfolio importer avec success",
            "data" => new ProfileCandidatResource($profileCandidat)
        ]);
    }
    public function uploadImage(Request $request, ProfileCandidat $profileCandidat)
    {
       $p= $this->candidatService->uploadImage($request, $profileCandidat);
        return response()->json([
            "success" => true,
            "message" => "Image importer avec success",
            "data" => new ProfileCandidatResource($profileCandidat)
        ]);

    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,ProfileCandidat $profileCandidat)
    {
        $this->candidatService->deleteProfileCandidat($request, $profileCandidat);
        return response()->json([
            "success" => true,
            "message" => "Profile Candidat Supprimer avec success",
            "data" => $request->user()
        ]);

    }

    public function getAllPropositionReceivedByCandidat()
    {
        $propositions = $this->propositionService->getAllPropositionReceivedByCandidat(auth()->user());
        return response()->json([
            'success' => true,
            "message" => "Liste des propositions envoyer",
            "data" =>  PropositionResource::collection($propositions)
        ]);
    }


    public function accepterProposition(PropositionRequest $propositionRequest,Proposition $proposition)
    {
        $this->propositionService->accepte($proposition);
        return response()->json([
            "success" => true,
            "message" => "Proposition est bien accepter",
            "data" => new PropositionResource($proposition)
        ]);
    }
    public function refuserProposition(Proposition $proposition)
    {
        $this->propositionService->refuser($proposition);
        return response()->json([
            "success" => true,
            "message" => "Proposition est bien refuser",
            "data" => new PropositionResource($proposition)
        ]);
    }

    public function dashboard(ProfileCandidat $profileCandidat)
    {
        //$stats = $this->dashboardService->candidateDashboard($profileCandidat);
        return view('candidat.dashboard');
    }
}
