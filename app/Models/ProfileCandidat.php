<?php

namespace App\Models;

use App\QueryBuilder\candidats\CandidatQueryBuilder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProfileCandidat extends Model
{
    use SoftDeletes;

    protected $fillable = ['id',
        'user_id', 'imageURL', 'ville',
        'telephone', 'cv_url',
        'portfolio_url', 'est_visible',
        'image_url'
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

    public function newEloquentBuilder($query)
    {
        return new  CandidatQueryBuilder($query);
    }
}
