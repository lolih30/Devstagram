<?php

namespace App\Http\Controllers;

use Faker\Guesser\Name;
use Illuminate\Http\Request;

class RegisterController extends Controller
{

    public function index()
    {
        return view('auth.register');
    }
    public function store(Request $request)
    { //funcion de laravel para mostrar infroamcion y luego detener la ejecucion
     /* dd($request);
      /*  dd($request->get('username')); */


      //validacion de formularios

      $this->validate($request,[
        'name' => 'required|min:5',

      ] );



      
    }

 
}
