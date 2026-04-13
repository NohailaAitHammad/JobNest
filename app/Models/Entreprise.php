<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entreprise extends Model
{
    protected $fillable = [
        'user_id', 'nom', 'ville',
        'dateCreation', 'nombreEmployees',
        'description'
    ];

    public function recruteur()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function domaines()
    {
        return $this->belongsToMany(Domaine::class);
    }
}
