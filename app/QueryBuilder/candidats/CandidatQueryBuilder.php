<?php

namespace App\QueryBuilder\candidats;

use App\Enums\StatusUser;
use Illuminate\Database\Eloquent\Builder;

class CandidatQueryBuilder extends Builder
{

    public function candidtas($value)
    {
        $this->whereHas("user", fn($query) => $query->where("status", StatusUser::active))
            ->whereHas("competences", fn($query) => $query->where("libelle", "like", "%{$value}%"))
            ->whereHas("certifications", fn($query) => $query->where("titre", "like", "%{$value}%"))
            ->whereHas("experiences", fn($query) => $query->where("organisme", "like", "%{$value}%"))
            ->get();
    }

}
