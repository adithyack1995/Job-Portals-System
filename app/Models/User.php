<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRoles;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'last_name',
        'profile_image_path',
        'phone_number',
        'city',
        'is_email_verified',
        'is_active',
        'zipcode',
        'remember_token'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected function FullName(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => "{$this->name} {$this->last_name}",
        );
    }

    public function scopeJobSeekers($query)
    {
        return $query->whereHas('roles', function ($q) {
            $q->where('name', 'job seeker');
        });
    }

    public function userFile()
    {
        return $this->hasOne(UserFile::class,'user_id');
    }
}
