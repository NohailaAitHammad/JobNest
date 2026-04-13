<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfileRecruteur extends Model
{
    protected $fillable = [
        'user_id', 'imageURL', 'ville',
        'telephone', 'poste'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function entreprise()
    {
        return $this->hasOne(Entreprise::class);
    }
}
