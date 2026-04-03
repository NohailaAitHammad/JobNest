<?php

namespace App\Http\Services;

use App\Http\Requests\CertificationRequest;
use App\Models\Experience;

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

    public function showCertification(Experience $certification)
    {
        try {
            Experience::findOrFail($certification->id);
        }catch (\Exception $exception){
            throw $exception;
        }
        return $certification;
    }

    public function updateCertification(CertificationRequest $request, Experience $certification)
    {
        try {
            Experience::findOrFail($certification->id);
        }catch (\Exception $exception){
            throw $exception;
        }
         $validated = $request->validated();
         $certification->certificat = $validated['certificat'];
         $certification->save();
         return $certification;
    }

    public function deleteCertification(Experience $certification)
    {
        try {
            Experience::findOrFail($certification->id);
        }catch (\Exception $exception){
            throw $exception;
        }

        return $certification->delete();

    }
}
