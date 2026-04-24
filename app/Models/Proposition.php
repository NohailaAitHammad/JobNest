<?php

namespace App\Models;

use App\Enums\StatusProp;
use App\Enums\TypeProp;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Proposition extends Model
{
    use SoftDeletes;

    protected $fillable = ['id',
        'recruteur_id', 'candidat_id',
        'titre', 'description',
        'type', 'duree', 'status'
    ];

    protected $casts = [
        'status' => StatusProp::class,
        'type'   => TypeProp::class,
    ];

    public function recruteur()
    {
        return $this->belongsTo(User::class, 'recruteur_id');
    }

    public function candidat()
    {
        return $this->belongsTo(User::class, 'candidat_id');
    }
}
