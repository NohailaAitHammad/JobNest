<?php

namespace App\Http\Services;

use App\Http\Requests\CertificationRequest;
use App\Http\Resources\CertificationResource;
use App\Models\Certification;
use App\Models\Experience;
use App\Models\ProfileCandidat;
use App\Models\User;
use Symfony\Component\HttpKernel\Profiler\Profile;

class CertificationService
{


    public function getAllCertification()
    {
        return Experience::all();
    }

    public function addCertification(CertificationRequest $request)
    {
        $validated  = $request->validated();

        $certification = Experience::create($validated);

        return $certification;
    }

    public function showCertification(Certification $certification, ProfileCandidat $profileCandidat)
    {
        try {
            $certification = $profileCandidat->certifications()->findOrFail($certification->id);
        }catch (\Exception $exception){
            throw $exception;
        }
        return $certification;
    }

    public function updateCertification(CertificationRequest $request, Experience $certification, ProfileCandidat $profileCandidat)
    {
        try {
            $certification = $profileCandidat->certifications()->findOrFail($certification->id);
        }catch (\Exception $exception){
            throw $exception;
        }
         $validated = $request->validated();
         $certification->certificat = $validated['certificat'];
         $certification->save();
         return $certification;
    }

    public function deleteCertification(Experience $certification, ProfileCandidat $profileCandidat)
    {
        try {
            $certification = $profileCandidat->experiences()->findOrFail($certification->id);
        }catch (\Exception $exception){
            throw $exception;
        }
        return $certification->delete();
    }
}
