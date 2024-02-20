<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descripcion',
        'imagen',
        'user_id',
    ];

    public function user(){
        return $this->belongsTo(User::class)->select(['name', 'username']);
    }
    //crear relacion para el post y mostrar los comentarios
    //un post tendra multiple comentarios pero un comentario solo tendra un dueño
    public function comentarios()
        { //De esta forma un post tendra multiples comentarios
            return $this->hasMany(Comentario::class);
        }

    public function likes()
        {
            return $this->hasMany(Like::class);
        }


        //ver si un usuario ya le dio me gusta evitar likes duplicados
        public function checkLike(User $user)
            {
                return $this->likes->contains('user_id', $user->id);
            }

    }

