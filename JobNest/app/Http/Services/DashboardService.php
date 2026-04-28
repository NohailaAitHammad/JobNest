<?php

namespace App\Http\Services;

use App\Enums\StatusProp;
use App\Enums\StatusUser;
use App\Models\ProfileCandidat;
use App\Models\ProfileRecruteur;
use App\Models\Proposition;

class DashboardService
{

    public function candidateDashboard(ProfileCandidat $profileCandidat): array
    {
        $user = $profileCandidat->user;
        return [
            'profile_complete'      => $this->isProfileComplete($profileCandidat),
            'total_experiences'     => $profileCandidat->experiences()->count() ?? 0,
            'total_competences'     => $profileCandidat->competences()->count() ?? 0,
            'total_certifications'  => $profileCandidat->certifications()->count() ?? 0,
            'pending_propositions'  => $user->propositionsRecues()
                                        ->where('status', StatusProp::pending->value)
                                        ->count(),
            'accepted_propositions' => $user->propositionsRecues()
                                        ->where('status', StatusProp::accepter->value)->count(),
            'is_visible'            => $profileCandidat?->est_visible,
        ];
    }


    public function recruiterDashboard(ProfileRecruteur $profileRecruteur): array
    {
        $user = $profileRecruteur->user;
        return [
            'total_propositions_sent' => $user->propositionsEnvoyees()->count(),
            'pending'                 => $user->propositionsEnvoyees()
                                        ->where('status', StatusProp::pending->value)->count(),
            'accepted' => $user->propositionsEnvoyees()
                            ->where('status', StatusProp::accepter->value)->count(),
            'rejected' => $user->propositionsEnvoyees()
                ->where('status', StatusProp::refuser->value)->count(),
        ];
    }

    private function isProfileComplete(?ProfileCandidat $profileCandidat): bool
    {
        if (!$profileCandidat) return false;
        return  filled($profileCandidat->ville)
            &&  filled($profileCandidat->telephone)
            && filled($profileCandidat->imageURL)
            && filled($profileCandidat->portfolio_url)
            && filled($profileCandidat->cv_url);
    }

}
