@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        
        <div class="col-md-8">
           <h1>Mis Imágenes Favoritas</h1>
            
            @foreach($likes as $like)
            	{{ $like->user_id }}
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
