<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    //ese User es el modelo, request porque guarda informacion osea envia una solicitud
    //user persona que estamos siguiendo
    public function store(User $user){
        //attcch es una relacion de muchos a muchos con a misma tabla
       $user->followers()->attach(auth()->user()->id);

       return back();
    }

    public function destroy(User $user){
        
        $user->followers()->detach(auth()->user()->id);
       return back();
    }
}
