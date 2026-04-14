<?php

namespace App\Http\Services;

use App\Http\Requests\RecruteurRequest;
use App\Models\ProfileRecruteur;
use App\Models\User;
use Illuminate\Http\Client\Request;

class RecruteurService
{

    public function createProfileRecruteur(User $user)
    {
        return (ProfileRecruteur::create(['user_id' => $user->id]));
    }

    public function getProfile(ProfileRecruteur $profileRecruteur){
        return ProfileRecruteur::where("id", $profileRecruteur->id)->with(["user"])->first();
    }

    public function updateProfile(RecruteurRequest $request, ProfileRecruteur $profileRecruteur)
    {
        $validated = $request->validated();
        $profileRecruteur->update($validated);
        return $profileRecruteur->load(["user", "entreprise"]);
    }

    public function deleteProfileRecruteur(Request $request, ProfileRecruteur $profileRecruteur)
    {
        if(auth()->id() !== $profileRecruteur->user_id){
            return response()->json([
                "success" => false,
                "message" => "Unauthorized"
            ], 403);
        }
        $profileRecruteur->delete();
        return $request->user()->currentAccessToken()->delete();
    }
}
