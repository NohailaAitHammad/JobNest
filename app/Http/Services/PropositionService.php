<?php

namespace App\Http\Services;

use App\Enums\StatusProp;
use App\Http\Requests\PropositionRequest;
use App\Models\ProfileCandidat;
use App\Models\Proposition;
use App\Models\User;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PropositionService
{

    public function getAllPropositionSendedByRecruteur(User $user)
    {
//        return Proposition::where("recruteur_id", $user->id)
//            ->with(['candidat', 'recruteur'])
//            ->latest()
//            ->get();
        return $user->propositionsEnvoyees;
    }

    public function getAllPropositionReceivedByCandidat(User $user)
    {
//        return Proposition::where("candidat_id", $user->id)
//            ->with('recruteur')
//            ->latest()
//            ->get();
        return $user->propositionsRecues;
    }

    public function sendPropositions(PropositionRequest $request,User $recruteur, User $candidat)
    {
        try {
            $candidat = User::where('id', $candidat->id)
                ->whereHas('profileCandidat', fn($q) => $q->where('est_visible', true))
                ->firstOrFail();
        }catch (NotFoundHttpException $exception){
            throw new $exception;
        }

        try {
            $recruteur = User::where('id', $recruteur->id)
                ->firstOrFail();
        }catch (NotFoundHttpException $exception){
            throw new $exception;
        }

        $exist = Proposition::where('recruteur_id', $recruteur->id)
                ->where('candidat_id', $candidat->id)
                ->exists();
        if($exist){
            throw new \Exception("Propositon deja envoyer a ce candidat");
        }

        $validated = $request->validated();
        $validated['recruteur_id'] = $recruteur->id;
        $validated['candidat_id'] = $candidat->id;
        $validated['status'] = "pending";

        $proposition = Proposition::create($validated);
         $proposition->load(['candidat', 'recruteur']);
         return $proposition;
    }

    public function accepte(Proposition $proposition)
    {
        if($proposition->status === StatusProp::accepter){
            throw new \Exception("Proposition deja accepter");

        }

        if($proposition->status === StatusProp::refuser){
            throw new \Exception("Proposition deja refuser");

        }
        if ($proposition->candidat->id !== auth()->id()){
            throw new \Exception("Candidat invalide de cette proposition");
        }

        $proposition->update(['status'=> StatusProp::accepter]);
        return $proposition;
    }

    public function refuser(Proposition $proposition)
    {
        if($proposition->status === StatusProp::accepter){
            throw new \Exception("Proposition deja accepter");
        }

        if($proposition->status === StatusProp::refuser){
            throw new \Exception("Proposition deja refuser");
        }
        if ($proposition->candidat->id !== auth()->id()){
            throw new \Exception("Candidat invalide de cette proposition");
        }

        $proposition->update(['status'=> StatusProp::refuser]);
        return $proposition;
    }

}
