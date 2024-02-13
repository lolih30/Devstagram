<?php

namespace App\Http\Controllers;


use App\Models\User;
use Faker\Guesser\Name;
use Psy\Readline\Userland;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class RegisterController extends Controller
{

    public function index()
    {
        return view('auth.register');
    }


    public function store(Request $request)
    {
        //funcion de laravel para mostrar informacion y luego detener la ejecucion
        /* dd($request);
      /*  dd($request->get('username')); */




        //modificar el request no hacer eso a menos que sea la ultima forma para agregar add
        $request->request->add(['username' => Str::slug($request->username)]);


        //validacion de formularios
        $this->validate($request, [
            'name' => 'required|max:30',
            'username' => 'required|unique:users|min:3|max:20',
            'email' => 'required|unique:users|email|max:60',
            'password' => 'required| confirmed|min:6 '

        ]);

        //crear nuevos registros es lo mismo a inser into usuarios
        //insertar en la base de datos
        //areglo asociativo se puede colocar asi tambien
        //  /*  dd($request->get('username')); */
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        /*      //Autenticar un usuario helper auth
     //crea el usuario pero llena tambien 
     //el objeto de autenticacion
    
     auth()->attempt([
      'email'=>$request->email,
      'password'=>$request->password,
     ]);
 */
        //otra forma de autenticar el usuario
        auth()->attempt($request->only('email', 'password'));



        //redireccionar al usuario se usa un helper que se llama redirect
        return redirect()->route('posts.index');
    }
}
