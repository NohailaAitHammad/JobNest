<?php

namespace App\Http\Services;

use App\Http\Requests\ProfileCandidatRequest;
use App\Models\ProfileCandidat;
use App\Models\User;
use Symfony\Component\HttpKernel\Profiler\Profile;

class CandidatService
{
    public function getProfile(ProfileCandidat $profileCandidat)
    {
        return $profileCandidat->load("user");
    }

    public function createProfileCandidat(User $user)
    {
        return ProfileCandidat::create(['user_id' => $user->id])->load("user");
    }

    public function updateProfile(ProfileCandidatRequest $request, ProfileCandidat $profileCandidat)
    {
        $validated = $request->validated();
        $profileCandidat->update($validated);
        return $profileCandidat->load("user");
    }

    public function toggleVisibility()
    {

    }

    public function addExperience()
    {

    }

    public function deleteExperience()
    {

    }

    public function addCertification()
    {

    }

    public function deleteCertification()
    {

    }

    public function addCompetence()
    {

    }

    public function removeCompetence()
    {

    }

    public function getDashboardStats()
    {

    }
}
