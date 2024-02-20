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

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token'
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

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    //un usuario puede tener multiple like
    public function likes()
    {
        return $this->hasMany(Like::class);

    }

    //Almacena los seguidores de un usuario
        public function followers()
        {
            return $this->belongsToMany(User::class, 'followers', 'user_id', 'follow_id');
        }


    //almacenar los que seguimos
    public function following()
    {
        return $this->belongsToMany(User::class, 'followers', 'follow_id','user_id' );
    }

    //comprobar si un usuario ya sigue a otro

    public function siguiendo(User $user)
    {
        return $this->followers->contains($user->id);
    }



}
