<?php

namespace App\Http\Services;

use App\Http\Requests\ExperienceRequest;
use App\Models\Experience;
use App\Models\ProfileCandidat;
use App\Models\User;

class ExperienceService
{

    public function listExperiences(ProfileCandidat $profileCandidat)
    {
       return  $profileCandidat->experiences()->latest()->get();
    }

    public function showExperience(Experience $experience, ProfileCandidat $profileCandidat)
    {
        return $profileCandidat->experiences()->findOrFail($experience->id);
    }

    public function createExperience(ExperienceRequest $request,User $user)
    {
        $validated  = $request->validated();
        return $this->getProfileCandidat($user)->experiences()->create($validated);
    }

    public function updateExperience(ExperienceRequest $request, Experience $experience, User $user)
    {
        $validated  = $request->validated();
        $experience = $this->getProfileCandidat($user)->experiencesr()->findOrFail($experience->id);
        $experience->update($validated);
        return $experience->fresh();
    }

    public function deleteExpereince(User $user, Experience $experience)
    {
        $profileCandidat = $this->getProfileCandidat($user);
        $profileCandidat->experiences()->findOrFail($experience->id)->delete();
    }
}

