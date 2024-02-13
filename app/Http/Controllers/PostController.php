<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //Todo tiene que estar protegudo -usar modificadores de acceso

    public function __construct()
    {
        //todo esto tiene que estar protegido la ruta de localhost:/muro
        //se le pasa auth para verificar que el usuario este autenticado
        $this->middleware('auth');
    } 

    public function index(User $user){
      /*   //identificar que usuario esta autenticado actualmente
        //laravel todo lo va guardando en user
        dd(auth()->user()); */
       
        return view('dashboard', [
            'user' => $user
        ] );
    }

    public function create()
    {
        return view('posts.create');
    }

}
