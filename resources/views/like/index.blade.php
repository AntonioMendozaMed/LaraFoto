@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        
        <div class="col-md-8">
        	<div class="mt-2 mb-4">
        		<h3 class="title">Mis Imágenes Favoritas</h3>
        		<hr>
        	</div>
           
            
            @foreach($likes as $like)
            	@include('includes.image', ['image'=>$like->image])
            @endforeach
        </div>

        <!-- PAGINACION -->
        
        <div class="col-md-8 justify-content-center">
            <div class="clearfix">
                
            </div> 
        </div>
        

    </div>
</div>
@endsection
