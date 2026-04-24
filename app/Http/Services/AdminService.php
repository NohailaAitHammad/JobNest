<?php

namespace App\Http\Services;

use App\Enums\StatusUser;
use App\Http\Resources\ProfileRecruteurResource;
use App\Models\ProfileCandidat;
use App\Models\ProfileRecruteur;
use App\Models\Proposition;
use App\Models\User;

class AdminService
{

    public function toggleUserStatus(User $user): User
    {
        //$user = User::findOrFail($userId);
        $user->update(['status' => !$user->status]);
        return $user->fresh();
    }

    public function deleteUser(User $user): void
    {
        $user->delete();
    }

    public function getStats(): array
    {
        return [
            'total_users'        => User::count(),
            'total_candidates'   => ProfileCandidat::count(),
            'total_recruiters'   => ProfileRecruteur::count(),
            'total_propositions' => Proposition::count(),
            'accepted_props'     => Proposition::where('status', 'accepted')->count(),
            'rejected_props'     => Proposition::where('status', 'rejected')->count(),
            'pending_props'      => Proposition::where('status', 'pending')->count(),
            'visible_profiles'   => ProfileCandidat::where('status', StatusUser::active)->count(),
        ];
    }
}
