<?php

namespace App\Http\Services;

use App\Enums\StatusUser;
use App\Http\Requests\FilterCandidatsRequest;
use App\Http\Requests\RecruteurRequest;
use App\Models\ProfileCandidat;
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

    public function searchCandidats(array $filters)
    {
        $query =  ProfileCandidat::query()
            ->where('profile_candidats.est_visible', true)
            ->with(["user", "competences", "certifications", "experiences"]);

        if(!empty($filters["ville"])){
                $query->where('ville', $filters['ville']);
        }

        if(!empty($filters["status"])){
            $query->whereHas('user', function($q) use($filters){
                $q->where('status', $filters['status']);
            });
        }

        if(!empty($filters['competences']) && is_array($filters['competences'])){
            $query->whereHas('competences', function ($q) use($filters){
                $q->whereIn('competences.id', $filters['competences']);
            });
        }

//        if(!empty($filters['certifications']) && is_array($filters['certifications'])){
//            $query->whereHas('certifications', function ($q) use($filters){
//                $q->whereIn('certifications.id', $filters['certifications']);
//            });
//        }

        if(!empty($filters['niveau'])){
            $query->whereHas('competences', function ($q) use($filters){
                $q->where('niveau', $filters['niveau']);
            });
        }

//        if(!empty($filters['keywords'])){
//            $keywords = $filters['keywords'];
//            $query->where(function ($q) use($keywords){
//                $q->where("titre", "like", "%{$keywords}%");
//            });
//        }
        return $query
            ->orderBy('created_at', 'desc')
            ->paginate(5);
    }
}
