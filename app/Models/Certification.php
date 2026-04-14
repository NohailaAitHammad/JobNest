<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Certification extends Model
{
    //use SoftDeletes;

    public $timestamps = false;

    protected $fillable = [
        'id',
        'profile_candidat_id',
        'titre', 'organisme',
        'dateObtention'
    ];

    public function profileCandidat()
    {
        return $this->belongsTo(ProfileCandidat::class);
    }
}
