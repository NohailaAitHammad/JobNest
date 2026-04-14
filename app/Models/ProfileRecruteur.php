<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProfileRecruteur extends Model
{
    use SoftDeletes;
    protected $fillable = ['id',
        'user_id', 'imageURL', 'ville',
        'telephone', 'poste', 'entreprise_id'
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
