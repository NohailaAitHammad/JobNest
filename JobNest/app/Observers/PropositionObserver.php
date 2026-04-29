<?php

namespace App\Observers;

use App\Models\Proposition;
use App\Notifications\PropositionNotification;

class PropositionObserver
{
    public function created(Proposition $proposition)
    {
        $candidat = $proposition->candidat;
        $recruteurName = $proposition->recruteur->firstName;

        $message = "You received a new proposal from $recruteurName !";

        $candidat->notify(new PropositionNotification($message, 'new_proposal', $proposition->id));
    }

    public function updated(Proposition $proposition)
    {
        if ($proposition->isDirty('status')) {
            $recruteur = $proposition->recruteur;
            $candidatName = $proposition->candidat->firstName;
            $status = $proposition->status->value;

            $message = "The candidate $candidatName has $status your proposal.";

            $recruteur->notify(new PropositionNotification($message, 'status_changed', $proposition->id));
        }
    }
}
