<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certification extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'profile_candidat_id',
        'titre', 'organisme',
        'dateObtention'
    ];

    public function profileCandidat()
    {
        return $this->belongsTo(ProfileCandidat::class);
    }
}
