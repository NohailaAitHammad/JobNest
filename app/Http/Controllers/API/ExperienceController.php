<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExperienceRequest;
use App\Http\Resources\ExperienceResource;
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
            "data" => $experiences
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ExperienceRequest $request, ProfileCandidat $profileCandidat)
    {
        $experience = $this->experienceService->createExperience($request,auth()->user() );
        return response()->json([
            "success" => true,
            "message" => "Experience",
            "data" => $experience
        ], 201);
    }

    /*
     * Display the specified resource.
     */
    public function show(Experience $experience, ProfileCandidat $profileCandidat)
    {
        $experience = $this->experienceService->showExperience($experience, $profileCandidat );
        return response()->json([
            "success" => true,
            "message" => "Detail d'une experience",
            "data" => $experience
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ExperienceRequest $request, Experience $experience)
    {
        $experience = $this->experienceService->updateExperience($request, $experience, auth()->user());
        return response()->json([
            "success" => true,
            "message" => "Experience modifier avec success",
            "data" => $experience
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Experience $experience)
    {
        $this->experienceService->deleteExpereince(auth()->user(),$experience);
        return response()->json([
            "success" => true,
            "message" => "Experience supprimer avec success"
        ]);
    }
}
