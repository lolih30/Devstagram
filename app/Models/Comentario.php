<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'post_id',
        'comentario'
    ];

    //relacion inversa y crear la relacion
    //cada comentario tiene un usuario que los esta creando
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
