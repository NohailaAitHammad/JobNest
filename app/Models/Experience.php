<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $fillable = ['certificat', "deleted_at"];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
