<?php

namespace App\Http\Services;

use App\Models\Entreprise;

class EntrepriseService
{

    public function getAllEntreprises()
    {
       return  Entreprise::all()->latest()->paginate(5);
    }

}
