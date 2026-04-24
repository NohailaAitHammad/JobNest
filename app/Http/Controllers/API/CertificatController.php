<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CertificationRequest;
use App\Http\Resources\CertificationResource;
use App\Http\Resources\ProfileCandidatResource;
use App\Http\Services\CertificationService;
use App\Models\Certification;
use App\Models\Experience;
use App\Models\ProfileCandidat;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Profiler\Profile;

class CertificatController extends Controller
{
    private CertificationService $certificationService;

    /**
     * @param CertificationService $certificationService
     */
    public function __construct(CertificationService $certificationService)
    {
        $this->certificationService = $certificationService;
    }



    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $certifications = $this->certificationService->getAllCertification();
        return response()->json([
            "success" => true,
            "message" => "Liste des certifications",
            "data" => CertificationResource::collection($certifications)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CertificationRequest $request, ProfileCandidat $profileCandidat)
    {
        $certification = $this->certificationService->addCertification($request, $profileCandidat);
        return response()->json([
            "success" => true,
            "message" => "Experience ajouter avec success",
            "data" => $certification
        ], 201);
    }

    /**
     * Display the specified resource.
     * @throws \Exception
     */
    public function show(Experience $certification)
    {
        $certification = $this->certificationService->showCertification($certification);

        return response()->json([
            "success" => true,
            "message" => "Detail certification",
            "data" => $certification
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CertificationRequest $request,ProfileCandidat $profileCandidat, Certification $certification)
    {
       $this->certificationService->updateCertification($request, $certification, $profileCandidat);
        return response()->json([
            "success" => true,
            "message" => "Experience modifier avec success",
            "data" => new ProfileCandidatResource($profileCandidat)
        ]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProfileCandidat $profileCandidat, Certification $certification)
    {
        if(!$this->certificationService->deleteCertification($certification, $profileCandidat)){
            return response()->json([
                "success" => false,
                "message" => "Error lors de la suppression de la certification"
            ]);
        }

        return response()->json([
            "success" => true,
            "message" => "Experience supprimer avec success",
            "data" => new ProfileCandidatResource($profileCandidat)
        ]);
    }
}
