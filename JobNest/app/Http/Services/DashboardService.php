<?php

namespace App\Http\Services;

use App\Enums\StatusUser;
use App\Models\ProfileCandidat;
use App\Models\ProfileRecruteur;
use App\Models\Proposition;

class DashboardService
{

    public function candidateDashboard(ProfileCandidat $profileCandidat): array
    {
        //$profile = CandidateProfile::where('user_id', $userId)->first();
        return [
            'profile_complete'      => $this->isProfileComplete($profileCandidat),
            'total_experiences'     => $profileCandidat?->experiences()->count() ?? 0,
            'total_competences'     => $profileCandidat?->competences()->count() ?? 0,
            'total_certifications'  => $profileCandidat?->certifications()->count() ?? 0,
            'pending_propositions'  => Proposition::where('candidat_id', $profileCandidat->user_id)
                ->where('status', 'pending')->count(),
            'accepted_propositions' => Proposition::where('candidat_id', $profileCandidat->user_id)
                ->where('status', 'accepted')->count(),
            'is_visible'            => $profileCandidat?->est_visible,
        ];
    }


    public function recruiterDashboard(ProfileRecruteur $profileRecruteur): array
    {
        return [
            'total_propositions_sent' => Proposition::where('recruteur_id', $profileRecruteur->user_id)->count(),
            'pending'                 => Proposition::where('recruteur_id', $profileRecruteur->user_id)
                ->where('status', 'pending')->count(),
            'accepted' => Proposition::where('recruteur_id', $profileRecruteur->user_id)
                ->where('status', 'accepted')->count(),
            'rejected' => Proposition::where('recruteur_id', $profileRecruteur->user_id)
                ->where('status', 'rejected')->count(),
        ];
    }

    private function isProfileComplete(?ProfileCandidat $profileCandidat): bool
    {
        if (!$profileCandidat) return false;
        return  filled($profileCandidat->ville) &&  filled($profileCandidat->telephone) && filled($profileCandidat->imageURL) && filled($profileCandidat->portfolio_url) && filled($profileCandidat->cv_url);
    }

}
