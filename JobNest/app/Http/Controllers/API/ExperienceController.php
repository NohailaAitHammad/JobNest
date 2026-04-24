<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExperienceRequest;
use App\Http\Resources\ExperienceResource;
use App\Http\Resources\ProfileCandidatResource;
use App\Http\Services\ExperienceService;
use App\Models\Experience;
use App\Models\ProfileCandidat;
use App\Models\User;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    private ExperienceService $experienceService;


    public function __construct(ExperienceService $experienceService)
    {
        $this->experienceService = $experienceService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(ProfileCandidat $profileCandidat)
    {
        $experiences = $this->experienceService->listExperiences($profileCandidat);
        return response()->json([
            "success" => true,
            "message" => "Liste des experiences",
            "data" =>  ExperienceResource::collection($experiences)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ExperienceRequest $request, ProfileCandidat $profileCandidat)
    {
       $this->experienceService->createExperience($request,$profileCandidat );
        return response()->json([
            "success" => true,
            "message" => "Experience ajouter avec success",
            "data" => new ProfileCandidatResource($profileCandidat)
        ], 201);
    }

    /*
     * Display the specified resource.
     */
    public function show( ProfileCandidat $profileCandidat, Experience $experience)
    {
        $this->experienceService->showExperience($experience, $profileCandidat );
        return response()->json([
            "success" => true,
            "message" => "Detail d'une experience",
            "data" => new ExperienceResource($experience)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ExperienceRequest $request, ProfileCandidat $profileCandidat, Experience $experience)
    {
        $this->experienceService->updateExperience($request, $experience,$profileCandidat);
        return response()->json([
            "success" => true,
            "message" => "Experience modifier avec success",
            "data" => new ProfileCandidatResource($profileCandidat)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProfileCandidat $profileCandidat, Experience $experience)
    {
        $this->experienceService->deleteExpereince($profileCandidat,$experience);
        return response()->json([
            "success" => true,
            "message" => "Experience supprimer avec success",
            "data" => new ProfileCandidatResource($profileCandidat)
        ]);
    }
}
