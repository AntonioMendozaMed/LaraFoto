<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Like;

class LikeController extends Controller
{
    //Para que toda accion sea restringida a todo usuario no identificado
    public function __construct(){
    	$this->middleware('auth');
    }

    public function index(){
    	$user = \Auth::user();
    	$likes = Like::where('user_id', $user->id)->orderBy('id', 'desc')->paginate(5);

    	return view('like.index', [
    		'likes' => $likes
    	]);
    }

    public function like($image_id){
    	//Recoger datos del usuario
    	$user = \Auth::user();

    	//Condicion para ver si ya existe el like
    	$isset_like = Like::where('user_id', $user->id)
    						->where('image_id', $image_id)
    						->count();

		// var_dump($isset_like);
		// die();

		if($isset_like == 0){
			$like = new Like();
	    	$like->user_id = $user->id;
	    	$like->image_id = $image_id;

	    	//Guardar
	    	$like->save();

	    	//Enviamos el objeto like en un arreglo json para después extraerlo en el front con javascript
	    	return response()->json([
	    		'like' => $like
	    	]);

		}else{
			return response()->json([
	    		'message' => 'El like ya existe'
	    	]);
		}

    	
    }

    public function dislike($image_id){
    	//Recoger datos del usuario
    	$user = \Auth::user();

    	//Condicion para ver si ya existe el like
    	$like = Like::where('user_id', $user->id)
    						->where('image_id', $image_id)
    						->first();

		// var_dump($isset_like);
		// die();

		if($like){

			//Eliminar like
	    	$like->delete();

	    	//Enviamos el objeto like en un arreglo json para después extraerlo en el front con javascript
	    	return response()->json([
	    		'like' => $like,
	    		'message' => 'Has dado dislike correctamente'
	    	]);

		}else{
			return response()->json([
	    		'message' => 'El like no existe'
	    	]);
		}


    }

    


}
