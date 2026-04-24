<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Competence extends Model
{
    use SoftDeletes;

    protected $fillable = ['id','libelle'];


    public function profileCandidats()
    {
        return $this->belongsToMany(ProfileCandidat::class)
            ->withPivot('niveau');
    }

}
