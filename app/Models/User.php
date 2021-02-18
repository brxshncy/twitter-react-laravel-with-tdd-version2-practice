<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;


class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function tweets()
    {
        return $this->hasMany(Tweet::class);
    }

    public function followings()
    {

        return $this->belongsToMany(User::class, 'follow_user', 'user_id', 'follow_user_id');

    }

    public function followers()
    {

        return $this->belongsTo(User::class, 'follow_user', 'follow_user_id', 'user_id');

    }

    public function isFollowing(User $user) {
         
        return !! $this->followings()->where('follow_user_id', $user->id)->count();

    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
