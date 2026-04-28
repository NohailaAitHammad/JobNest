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
    public function getAllCertification(ProfileCandidat $profileCandidat)
    {
        return $profileCandidat->certifications;
    }

    public function addCertification(CertificationRequest $request, ProfileCandidat $profileCandidat)
    {
        $validated  = $request->validated();
        return  $profileCandidat->certifications()->create($validated);

    }

//    public function showCertification(Certification $certification, ProfileCandidat $profileCandidat)
//    {
//        try {
//            $certification = $profileCandidat->certifications()->findOrFail($certification->id);
//        }catch (\Exception $exception){
//            throw $exception;
//        }
//        return $certification;
//    }

        public function updateCertification(CertificationRequest $request, Certification $certification, ProfileCandidat $profileCandidat)
    {
        try {
            $certification = $profileCandidat->certifications()->findOrFail($certification->id);
        }catch (\Exception $exception){
            throw $exception;
        }
         $validated = $request->validated();
         $certification->update($validated);
         return $profileCandidat;
    }

    public function deleteCertification(Certification $certification, ProfileCandidat $profileCandidat)
    {
        try {
            $certification = $profileCandidat->certifications()->findOrFail($certification->id);
        }catch (\Exception $exception){
            throw $exception;
        }
         $certification->delete();
        return true;
    }
}
