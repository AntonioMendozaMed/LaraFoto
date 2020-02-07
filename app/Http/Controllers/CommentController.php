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
}
