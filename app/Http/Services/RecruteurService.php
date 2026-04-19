<?php

namespace App\Http\Services;

use App\Http\Requests\RecruteurRequest;
use App\Models\ProfileRecruteur;
use App\Models\User;
use Illuminate\Http\Request;

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
//        $profileRecruteur->entreprise()->firstOrCreate(
//            [
//            "profile_recruteur_id" => $profileRecruteur->id
//        ], [
//                "nom" => $validated->nom,
//                "ville" => $validated->ville,
//                "dateCreation" => $validated->dateCreation,
//                "nombreEmployees" => $validated->nombreEmployees,
//                "description" => $validated->description]
//        );
        $recruteurData = [
            "imageURL" => $validated["imageURL"],
            "ville" => $validated["ville"],
            "telephone" => $validated["telephone"],
            "poste" => $validated["poste"]
        ];
        $profileRecruteur->update($recruteurData);
        $entrepriseData = [
            "nom" => $validated["nom"],
            "ville" => $validated['ville'],
            "dateCreation" => $validated['dateCreation'],
            "nombreEmployees" => $validated["nombreEmployees"],
            "description" => $validated["description"],
            "profile_recruteur_id" => $profileRecruteur->id,
        ];

        if(!$profileRecruteur->entreprise){
            $profileRecruteur->entreprise()->create($entrepriseData);
        }else {
            $profileRecruteur->entreprise()->update($entrepriseData);
        }
        $profileRecruteur->entreprise->domaines()->sync($validated["domaine"]);
        return $profileRecruteur->load(["user", "entreprise"]);
    }

    public function deleteProfileRecruteur(Request $request, ProfileRecruteur $profileRecruteur)
    {
        if(!$request->user()){
            return response()->json([
                "success" => false,
                "message" => "Unauthenticated"
            ], 401);
        }
        if(auth()->id() !== $profileRecruteur->user_id){
            return response()->json([
                "success" => false,
                "message" => "Unauthorized"
            ], 403);
        }

        $request->user()->currentAccessToken()->delete();

        $profileRecruteur->delete();
        return $request->user()->delete();
        //$profileRecruteur->delete();
        //return $request->user()->currentAccessToken()->delete();
    }
}
