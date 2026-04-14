<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileCandidatRequest;
use App\Http\Resources\ProfileCandidatResource;
use App\Http\Services\CandidatService;
use App\Models\Candidat;
use App\Models\ProfileCandidat;
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
            "data" => new ProfileCandidatResource($profileCandidat)

        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProfileCandidatRequest $request, ProfileCandidat $profileCandidat)
    {
        $profileCandidat = $this->candidatService->updateProfile($request, $profileCandidat);
        return response()->json([
            "success" => true,
            "message" => "¨Profile Candidat Modifier avec success",
            "data" => new ProfileCandidatResource($profileCandidat)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProfileCandidat $profileCandidat)
    {

    }
}
