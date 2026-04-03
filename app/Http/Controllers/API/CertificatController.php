<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CertificationRequest;
use App\Http\Services\CertificationService;
use App\Models\Experience;
use Illuminate\Http\Request;

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
            "data" => $certifications
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CertificationRequest $request)
    {
        $certification = $this->certificationService->addCertification($request);
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
    public function update(CertificationRequest $request, Experience $certification)
    {
        $resultCertification = $this->certificationService->updateCertification($request, $certification);
        return response()->json([
            "success" => true,
            "message" => "Experience modifier avec success",
            "data" => $resultCertification
        ]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Experience $certification)
    {
        if(!$this->certificationService->deleteCertification($certification)){
            return response()->json([
                "success" => false,
                "message" => "Error lors de la suppression de la certification"
            ]);
        }

        return response()->json([
            "success" => true,
            "message" => "Experience supprimer avec success"
        ]);
    }
}
