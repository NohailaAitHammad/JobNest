<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Domaine extends Model
{
    use SoftDeletes;
    protected $fillable = ["nomDomaine", "deleted_at"];

    public function entreprises()
    {
        return $this->belongsToMany(Entreprise::class);
    }
}
