<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //al tener solo un metodo get entonces lo puede llamar con este metodo ques un parecido al contructor se llama inmediatamente
    public function __invoke()
    { //obtener a quienes seguimos pluck(este solo trae el campo que necesitamos)
        $ids = auth()->user()->following->pluck('id')->toArray();

        //obtener los post de los usuarios que seguimos whereIn(este filtra un areglo) where solo revisa un valor
        $posts = Post::whereIn('user_id', $ids)->latest()->paginate(20);

        return view('home', [
            'posts' => $posts
        ]);
    }
}
