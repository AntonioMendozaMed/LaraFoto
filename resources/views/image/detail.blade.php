@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        
        <div class="col-md-10">
            @include('includes.message')
            
                <div class="card pub_image">
                  <div class="card-header">
                      @if($image->user->image)
                          <div class="container-avatar">
                              <img src="{{ route('user.avatar', ['filename'=>$image->user->image]) }}"  />
                          </div>
                      @endif

                      <div class="data-user">
                          {{ $image->user->name . ' ' . $image->user->surname }}
                          <span class="nickname">
                              {{' | @' . $image->user->nick }} 
                          </span>
                      </div>
                  </div>

                  <div class="card-body">
                     <div class="image-container image-detail">
                         <img src="{{ route('image.file', ['filename'=>$image->image_path]) }}" alt="">
                     </div>
                     
                     <div class="description">
                          <span class="nickname"> {{ '@'. $image->user->nick }}</span>
                          <p>{{ $image->description }}</p>
                     </div>
                     <div class="likes">
                         <img src="{{ asset('img/heart-gray.ico')}}" alt="">
                     </div>
                     <div class="comments ml-5 mb-5">
                         <a href="" class="btn btn-default btn-sm">Comentarios ({{ count($image->comments) }})</a>
                         <hr>
                         <form method="POST" action="{{ route('comment.save') }}">
                           @csrf

                           <input type="hidden" name="image_id" value="{{$image->id}}">
                           <p>
                             <textarea name="content" id="" cols="10" rows="10" class="form-control" required=""></textarea>
                              @error('content')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                              @enderror
                           </p>
                           <button type="submit" class="btn btn-primary">Enviar</button>
                         </form>

                         <hr>

                         @foreach($image->comments as $comment)
                          <div class="comment mt-3">
                            
                            <span class="nickname"> {{ '@'. $comment->user->nick }}</span>
                            <span class="nickname date">{{ ' | '.\FormatTime::LongTimeFilter($comment->created_at) }}</span>
                            <p>
                                {{ $comment->content }} <br>

                              <!-- El botón ELIMINAR aparecerá únicamente al dueño de la foto o al dueño del comentario -->
                              @if(Auth::check() && ($comment->user_id == Auth::user()->id || $comment->image->user_id == $user->id))
                                <a class="btn btn-sm btn-outline-danger" href="{{ route('comment.delete', ['id'=> $comment->id]) }}">
                                  Eliminar
                                </a>
                              @endif
                            </p>
                          </div>
                         @endforeach
                     </div>
                  </div>
              </div>
            
        </div>
        

    </div>
</div>
@endsection
