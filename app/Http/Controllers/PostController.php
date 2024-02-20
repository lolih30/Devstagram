<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    //Todo tiene que estar protegudo -usar modificadores de acceso

    public function __construct()
    {
        //todo esto tiene que estar protegido la ruta de localhost:/muro
        //se le pasa auth para verificar que el usuario este autenticado
        $this->middleware('auth')->except(['show', 'index']);
    } 

    public function index(User $user){
      /*   //identificar que usuario esta autenticado actualmente
        //laravel todo lo va guardando en user
        dd(auth()->user()); */

    //filtrar las publicaciones del usuario
      //  $posts = Post::where('user_id', $user->id)->paginate(3);

    //otro tipo de paginacion 
    $posts = Post::where('user_id', $user->id)->latest()->simplePaginate(20);


        return view('dashboard', [
            'user' => $user,
            'posts' => $posts,
        ] );
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request){
        $this->validate($request, [
            'titulo' => 'required| max:255',
            'descripcion' => 'required',
            'imagen' => 'required'
        ]);

    /*     Post::create([
            'titulo' =>$request->titulo,
            'descripcion' =>$request->descripcion,
            'imagen' => $request->imagen,
            'user_id' => auth()->user()->id
        ]);
 */
   /*      //otra forma de crear registros
        $post = new Post();
        $post->titulo = $request->titulo;
        $post->descripcion = $request->descripcion;
        $post->imagen = $request->imagen;
        $post->user_id = auth()->user()->id;
        $post->save();
 */

 //almacenando post en una relacion
$request->user()->posts()->create([
    'titulo' =>$request->titulo,
    'descripcion' =>$request->descripcion,
    'imagen' => $request->imagen,
    'user_id' => auth()->user()->id
]);

        return redirect()->route('posts.index', auth()->user()->username);
    }
//mostrar nada mas un post
    public function show(User $user, Post $post){
        return view('posts.show', [
            'post' => $post,
            'user' => $user
        ]);
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();

        //eliminar la imagen

        $imagen_path = public_path('uploads/' .$post->imagen);

        if(File::exists($imagen_path)){
            unlink($imagen_path);
            
        }

        return redirect()->route('posts.index', auth()->user()->username);
    }

}
