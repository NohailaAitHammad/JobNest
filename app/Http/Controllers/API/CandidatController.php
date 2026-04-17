<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileCandidatRequest;
use App\Http\Resources\ProfileCandidatResource;
use App\Http\Services\CandidatService;
use App\Models\ProfileCandidat;
use App\Models\User;
use Illuminate\Http\Request;

class CandidatController extends Controller
{
    private CandidatService $candidatService;

    /**
     * @param CandidatService $candidatService
     */
    public function __construct(CandidatService $candidatService)
    {
        $this->candidatService = $candidatService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            "success" => true,
            "message" => "Liste des profiles candidats",
            "data" => Candidat::with('user')->get()
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
            "message" => $visible ?  "Visibilité du Profile Candidat est active":"Visibilité du Profile Candidat est inactive",

        ]);
    }

    public function uploadCV(Request $request, ProfileCandidat $profileCandidat)
    {
        $path = $this->candidatService->uploadCV($request, $profileCandidat);
        return response()->json([
            "success" => true,
            "message" => "CV importer avec success",
            "path" => $path
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
}
