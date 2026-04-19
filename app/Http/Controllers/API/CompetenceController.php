<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CertificationRequest;
use App\Http\Requests\CompetenceRequest;
use App\Http\Resources\ProfileCandidatResource;
use App\Http\Services\CompetenceService;
use App\Models\Experience;
use App\Models\Competence;
use App\Models\ProfileCandidat;
c


class CompetenceController extends Controller
{
    private CompetenceService $competenceService;

    public function __construct(CompetenceService $competenceService)
    {
        $this->competenceService = $competenceService;
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $competences= $this->competenceService->getAllCompetences();
        return response()->json([
            "success" => true,
            "message" => "Liste des competences",
            "data" => $competences
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CompetenceRequest $request)
    {
        $this->authorize("create", Competence::class);
        $competence = $this->competenceService->addCompetence($request);
        return response()->json([
            "success" => true,
            "message" => "Competence ajouter avec success",
            "data" => $competence
        ], 201);
    }

    public function addCompetence(Request $request, ProfileCandidat $profileCandidat)
    {
        $profileCandidat = $this->competenceService->add($request, $profileCandidat);
        return response()->json([
            "success" => true,
            "message" => "Competence ajouter",
            "data" => new ProfileCandidatResource($profileCandidat)
        ]);

    }

    public function removeCompetence(ProfileCandidat $profileCandidat, Competence $competence)
    {
        $this->competenceService->removeCompetence($profileCandidat, $competence);
        return response()->json([
            "success" => true,
            "message" => "Competence remover",
            "data" => new ProfileCandidatResource($profileCandidat)
        ]);
    }

    public function show(Competence $competence)
    {
        //$competence = $this->competenceService->showCompetence($competence);

        return response()->json([
            "success" => true,
            "message" => "Detail Competence",
            "data" => $competence
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CompetenceRequest $request, Competence $competence)
    {
        $resultCompetence = $this->competenceService->updateCompetence($request, $competence);
        return response()->json([
            "success" => true,
            "message" => "Competence modifier avec success",
            "data" => $resultCompetence
        ]);

    }


    public function destroy(Competence $competence)
    {
        $this->authorize("delete", Competence::class);
        if(!$this->competenceService->deleteCompetence($competence)){
            return response()->json([
                "success" => false,
                "message" => "Error lors de la suppression de la competence"
            ]);
        }

        return response()->json([
            "success" => true,
            "message" => "Competence supprimer avec success"
        ]);
    }
}
