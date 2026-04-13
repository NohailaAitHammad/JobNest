<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfileCandidat extends Model
{
    protected $fillable = [
        'user_id', 'imageURL', 'ville',
        'telephone', 'cv_url',
        'portfolio_url', 'est_visible'
    ];

    protected $casts = [
        'est_visible' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function competences()
    {
        return $this->belongsToMany(Competence::class)
            ->withPivot('niveau');
    }

    public function experiences()
    {
        return $this->hasMany(Experience::class);
    }

    public function certifications()
    {
        return $this->hasMany(Certification::class);
    }
}
