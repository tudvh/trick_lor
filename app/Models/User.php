<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';

    protected $fillable = ['full_name', 'avatar', 'avatar_public_id', 'email', 'username', 'password', 'role', 'google_id', 'status', 'verification_token', 'last_email_sent_at'];

    protected $hidden = ['password', 'verification_token', 'last_email_sent_at'];

    public function posts()
    {
        return $this->hasMany(Post::class, 'author_id', 'id');
    }

    public function postViews()
    {
        return $this->hasMany(PostView::class, 'user_id', 'id');
    }

    public function hasPassword()
    {
        return $this->password != null;
    }
}
