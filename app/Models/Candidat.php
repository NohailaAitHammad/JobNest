<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Candidat extends Model
{
    protected $fillable = ["user_id", "certifications", "deleted_at"];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
