<?php

namespace App\Models;

use App\Enums\Niveau;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ProfileCandidatCompetence extends Pivot
{
    protected $fillable = ["profile_candidat_id", "competence_id", "niveau", "deleted_at"];

    protected $casts = ["niveau" => Niveau::class];
}
