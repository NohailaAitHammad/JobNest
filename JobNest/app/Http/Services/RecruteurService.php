<?php

namespace App\Http\Services;

use App\Enums\StatusUser;
use App\Http\Requests\FilterCandidatsRequest;
use App\Http\Requests\RecruteurRequest;
use App\Models\ProfileCandidat;
use App\Models\ProfileRecruteur;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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

        $user = $profileRecruteur->user;
        $userData = [];
        if (isset($validated['firstName'])) $userData['firstName'] = $validated['firstName'];
        if (isset($validated['lastName']))  $userData['lastName']  = $validated['lastName'];
        if (isset($validated['email']))     $userData['email']     = $validated['email'];

        if (!empty($userData)) {
            $user->update($userData);
        }


        if ($request->hasFile('imageURL')) {
            if ($profileRecruteur->imageURL && Storage::disk("public")->exists($profileRecruteur->imageURL)) {
                Storage::disk("public")->delete($profileRecruteur->imageURL);
            }
            $path = $request->file('imageURL')->store('recruteurs', 'public');
            $profileRecruteur->update(['imageURL' => $path]);
        }

        $profileData = array_intersect_key($validated, array_flip([
            'ville', 'telephone', 'poste'
        ]));
        $profileRecruteur->update($profileData);

        $entrepriseData = [
            'nom'              => $validated['nom'] ?? $profileRecruteur->entreprise->nom,
            'ville'            => $validated['ville'] ?? $profileRecruteur->entreprise->ville,
            'dateCreation'     => $validated['dateCreation'] ?? $profileRecruteur->entreprise->dateCreation,
            'nombreEmployees'  => $validated['nombreEmployees'] ?? $profileRecruteur->entreprise->nombreEmployees,
            'description'      => $validated['description'] ?? $profileRecruteur->entreprise->description,
        ];

        if (!$profileRecruteur->entreprise) {
            $profileRecruteur->entreprise()->create($entrepriseData);
        } else {
            $profileRecruteur->entreprise->update($entrepriseData);
        }

        if (isset($validated['domaine'])) {
            $profileRecruteur->entreprise->domaines()->sync($validated['domaine']);
        }

        return $profileRecruteur;
    }

    public function deleteProfileRecruteur(Request $request, ProfileRecruteur $profileRecruteur)
    {
        $profileRecruteur->delete();
        $profileRecruteur->user->delete();
        return true;
    }

    public function searchCandidats(array $filters)
    {
        $query = ProfileCandidat::query()
            ->where('est_visible', true)
            ->with(["user", "competences", "certifications", "experiences"]);

        $query->when($filters['ville'] ?? null, function ($q, $ville) {
            $q->where('ville', 'like', '%' . $ville . '%');
        });

        $query->when($filters['status'] ?? null, function ($q, $status) {
            $q->whereHas('user', function ($userQuery) use ($status) {
                $userQuery->where('status', $status);
            });
        });


        $competences = $filters['competences'] ?? null;
        if (!empty($competences) && is_array($competences)) {
            $query->whereHas('competences', function ($q) use ($competences) {
                $q->whereIn('competences.id', $competences);
            });
        }
        $query->when($filters['niveau'] ?? null, function ($q, $niveau) {
            $q->whereHas('competences', function ($compQuery) use ($niveau) {
                $compQuery->where('niveau', $niveau);
            });
        });

        return $query
            ->orderBy('created_at', 'desc')
            ->paginate(6);
    }
}
