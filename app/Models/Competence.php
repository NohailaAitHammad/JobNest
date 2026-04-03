<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Competence extends Model
{
    use SoftDeletes;
    protected $fillable = ['libelle', 'deleted_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
