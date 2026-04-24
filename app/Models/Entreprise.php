<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Entreprise extends Model
{
    use SoftDeletes;

    protected $fillable = ['id',
        'nom', 'ville',
        'dateCreation', 'nombreEmployees',
        'description', 'profile_recruteur_id'
    ];

    public function recruteur()
    {
        return $this->belongsTo(ProfileRecruteur::class, 'profile_recruteur_id');
    }

    public function domaines()
    {
        return $this->belongsToMany(Domaine::class);
    }
}
