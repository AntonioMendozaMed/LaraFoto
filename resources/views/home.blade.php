@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        
        <div class="col-md-8">
            @include('includes.message')
            @foreach($images as $image)
                <!-- Refactorzacion y reutilización del bloque de código que imprime la terjeta de imagen -->
                @include('includes.image', ['image'=>$image])
            @endforeach
        </div>

        <!-- PAGINACION -->
        
        <div class="col-md-8 justify-content-center">
            <div class="clearfix">
                {{ $images->links() }}
            </div> 
        </div>
        

    </div>
</div>
@endsection
