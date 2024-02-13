<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;


class ImagenController extends Controller
{
    public function store(Request $request){
    

        //indentificar que archivo estoy subiendo
        $imagen = $request->file('file');

        //este codigo genera un id unico para cada una de las imagenes 
        $nombreImagen = Str::uuid() . "." . $imagen->extension();

        //intancia de intervation image
        $imagenServidor = Image::make($imagen);
        //cortar la imagen de 1000*1000
        $imagenServidor->fit(1000,1000);

        //crear la ruta
        $imagenPath = public_path('uploads') . '/' . $nombreImagen;
        //guardar la imagen en el servidor y que lo mueva a esa ruta
        $imagenServidor->save($imagenPath);

        //construimos una respuesta retornamos imagen y esta en public uploads
        return response()->json(['imagen' => $nombreImagen]);
    }
}
