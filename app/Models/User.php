<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\User\UserRole;
use App\Enums\User\UserStatus;
use App\Traits\User\UserRelationship;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, UserRelationship;

    protected $table = 'users';

    protected $fillable = [
        'full_name',
        'avatar',
        'avatar_public_id',
        'email',
        'username',
        'password',
        'role',
        'google_id',
        'status',
        'verification_token',
        'last_email_sent_at',
    ];

    protected $hidden = [
        'password',
        'verification_token',
        'last_email_sent_at'
    ];

    protected $casts = [
        'thumbnails' => 'array',
        'thumbnails_custom' => 'array',
        'role' => UserRole::class,
        'status' => UserStatus::class,
    ];

    public function hasPassword()
    {
        return $this->password != null;
    }
}
