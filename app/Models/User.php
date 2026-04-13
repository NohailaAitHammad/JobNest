<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\StatusUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'firstName', 'lastName', 'email',
        'password', 'status', 'banned_at', 'role_id'
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'status'    => StatusUser::class,
            'banned_at' => 'datetime',
        ];
    }

    public function role() :BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function profileCandidat()
    {
        return $this->hasOne(ProfileCandidat::class);
    }

    public function profileRecruteur()
    {
        return $this->hasOne(ProfileRecruteur::class);
    }

    public function propositionsEnvoyees()
    {
        return $this->hasMany(Proposition::class, 'recruteur_id');
    }

    public function propositionsRecues()
    {
        return $this->hasMany(Proposition::class, 'candidat_id');
    }

    public function profilesVus()
    {
        return $this->hasMany(ProfileView::class, 'recruteur_id');
    }

    public function vues()
    {
        return $this->hasMany(ProfileView::class, 'candidat_id');
    }

    // Helpers
    public function hasRole(string $role): bool
    {
        return $this->roles()->where('role', $role)->exists();
    }

    public function isCandidat(): bool
    {
        return $this->hasRole('condidat');
    }

    public function isRecruteur(): bool
    {
        return $this->hasRole('recruteur');
    }

    public function isAdmin(): bool
    {
        return $this->hasRole('admin');
    }

    public function isBanned(): bool
    {
        return $this->status === StatusUser::banni;
    }


}
