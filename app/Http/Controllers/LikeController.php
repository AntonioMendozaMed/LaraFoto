<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LikeController extends Controller
{
    //Para que toda accion sea restringida a todo usuario no identificado
    public function __construct(){
    	$this->middleware('auth');
    }

    public function like($image_id){
    	//Recoger datos del usuario
    }

    public function dislike($image_id){

    }


}
