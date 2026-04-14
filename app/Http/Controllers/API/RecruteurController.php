<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\RecruteurRequest;
use App\Http\Resources\ProfileRecruteurResource;
use App\Http\Services\RecruteurService;
use App\Models\ProfileRecruteur;
use Illuminate\Http\Client\Request;

class RecruteurController extends Controller
{
    private RecruteurService $recruteurService;

    /**
     * @param RecruteurService $recruteurService
     */
    public function __construct(RecruteurService $recruteurService)
    {
        $this->recruteurService = $recruteurService;
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
        $profileRecruteur = $this->recruteurService->updateProfile($request, $profileRecruteur);
        return response()->json([
            "success" => true,
            "message" => "¨Profile Candidat Modifier avec success",
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
            "message" => "Profile Recruteur Supprimer avec success"
        ]);
    }
}
