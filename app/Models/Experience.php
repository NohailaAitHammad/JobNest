<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'id',
        'profile_candidat_id',
        'poste', 'entreprise',
        'description',
        'dateDebut', 'dateFin'
    ];

    public function profileCandidat()
    {
        return $this->belongsTo(ProfileCandidat::class);
    }
}
