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

    public function addCertification(CertificationRequest $request, ProfileCandidat $profileCandidat)
    {
        $validated  = $request->validated();
        $profileCandidat->certifications()->create($validated);

        return $profileCandidat->load(["competences", "experiences", "certifications"]);
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

        public function updateCertification(CertificationRequest $request, Certification $certification, ProfileCandidat $profileCandidat)
    {
        try {
            $certification = $profileCandidat->certifications()->findOrFail($certification->id);
        }catch (\Exception $exception){
            throw $exception;
        }
         $validated = $request->validated();
         $certification->update($validated);
         return $profileCandidat->load(["competences", "experiences", "certifications"]);
    }

    public function deleteCertification(Certification $certification, ProfileCandidat $profileCandidat)
    {
        try {
            $certification = $profileCandidat->certifications()->findOrFail($certification->id);
        }catch (\Exception $exception){
            throw $exception;
        }
         $certification->delete();
        return $profileCandidat->load(["competences", "experiences", "certifications"]);
    }
}
