<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProfileView extends Model
{
    use SoftDeletes;

    public $timestamps = false;

    protected $fillable = [
        'id',
        'candidat_id',
        'recruteur_id',
        'viewed_at'
    ];

    protected $casts = [
        'viewed_at' => 'datetime',
    ];

    public function candidat()
    {
        return $this->belongsTo(User::class, 'candidat_id');
    }

    public function recruteur()
    {
        return $this->belongsTo(User::class, 'recruteur_id');
    }
}
