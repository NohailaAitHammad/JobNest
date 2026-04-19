<?php

namespace App\QueryBuilder\competences;

use Illuminate\Database\Eloquent\Builder;

class CompetenceQueryBuilder extends Builder
{

    public function competences($value)
    {
        $this->where("libelle", "like", "%{$value}%");

    }

}
