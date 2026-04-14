<?php

namespace App\Models;

use App\Enums\Niveau;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProfileCandidatCompetence extends Pivot
{
    use SoftDeletes;

    protected $fillable = ['id',"profile_candidat_id", "competence_id", "niveau"];

    protected $casts = ["niveau" => Niveau::class];
}
