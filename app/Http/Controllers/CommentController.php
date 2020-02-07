<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
//use App\Image;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function save(Request $request){

    	//Validación
    	$validate = $this->validate($request, [
    		'image_id' => 'integer|required',
    		'content' => 'string|required'
    	]);

    	//Recoger Datos
    	$user = \Auth::user();
    	$image_id = $request->input('image_id');
    	$content = $request->input('content');

    	//Asigno los valores a mi nuevo objeto a guardar
    	$comment = new Comment();
    	$comment->user_id = $user->id;
    	$comment->image_id = $image_id;
    	$comment->content = $content;
		//$image = Image::find($image_id);
    	//Guardar en la BD
    	$comment->save();

    	//Rerdireccion
    	return redirect()->route('image.detail', ['id' => $image_id] )
    						->with([
    							'message' => 'Tu comentario ha sido enviado'
    						]);

    }

    public function delete($id){
    	//Conseguir datos del usuario logeado
    	$user = \Auth::user();

    	//Conseguir objeto del comentario
    	$comment = Comment::find($id);

    	//Comprobar si soy el dueño del comentario o de la publicacion
    	if($user && ($comment->user_id == $user->id || $comment->image->id == $user->id)){
    		$comment->delete();

    		return redirect()->route('image.detail', ['id' => $comment->image->id] )
    						->with([
    							'message' => 'Tu comentario ha sido eliminado correctamente'
    						]);
    	}else{

    		return redirect()->route('image.detail', ['id' => $comment->image->id] )
    						->with([
    							'message' => 'El comentario no ha sido eliminado. ERROR DESCONOCIDO'
    						]);

    	}
    }
}
