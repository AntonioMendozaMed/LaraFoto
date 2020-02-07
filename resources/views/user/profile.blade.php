@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        
        <div class="col-md-8">
        	<div class="profile-user">
        		
        			@if($user->image)
			          	<div class="container-avatar">
			            	<img src="{{ route('user.avatar', ['filename'=>$user->image]) }}"  />
			          	</div>
			        @endif
        		

        		<div class="user-info">
        			<h5 class="titile text-muted">{{ '@'.$user->nick }}</h3>
        			<h4 class="titile">{{ $user->name . ' ' . $user->surname}}</h4>
        			<p>
        				{{  'Se unió: '.\FormatTime::LongTimeFilter($user->created_at) }}
        			</p>
        			<hr>
        		</div>

        		
        	</div>
            @include('includes.message')
            @foreach($user->images as $image)
                <!-- Refactorzacion y reutilización del bloque de código que imprime la terjeta de imagen -->
                @include('includes.image', ['image'=>$image])
            @endforeach
        </div>

        <!-- PAGINACION -->
        
   <!-- 
   <div class="col-md-8 justify-content-center">
        <div class="clearfix">
            {{}}
        </div> 
    </div>
        -->

    </div>
</div>
@endsection
