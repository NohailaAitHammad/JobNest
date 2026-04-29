<?php

namespace App\Http\Services;

use App\Http\Requests\ExperienceRequest;
use App\Models\Experience;
use App\Models\ProfileCandidat;
use App\Models\User;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ExperienceService
{

    public function listExperiences(ProfileCandidat $profileCandidat)
    {
       return  $profileCandidat->experiences;
    }

    public function showExperience(Experience $experience, ProfileCandidat $profileCandidat)
    {
        try {
            $profileCandidat->experiences()->findOrFail($experience->id);
        }catch(NotFoundHttpException $exception){
            throw new $exception;
        }

        return $experience;
    }

    public function createExperience(ExperienceRequest $request,ProfileCandidat $profileCandidat)
    {
        $validated  = $request->validated();
         $profileCandidat->experiences()->create($validated);
         return ;
    }

    public function updateExperience(ExperienceRequest $request, Experience $experience, ProfileCandidat $profileCandidat)
    {
        $validated  = $request->validated();
        try {
            $experience =$profileCandidat->experiences()->findOrFail($experience->id);
        }catch (NotFoundHttpException $exception){
            throw new $exception;
        }
        $experience->update($validated);
        return $profileCandidat;
    }

    public function deleteExpereince(ProfileCandidat $profileCandidat, Experience $experience)
    {
        try {
            $profileCandidat->experiences()->findOrFail($experience->id);

        }catch(NotFoundHttpException $exception){
            throw new $exception;
        }
        return $experience->delete();
    }
}

