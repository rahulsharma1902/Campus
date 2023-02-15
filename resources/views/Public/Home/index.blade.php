@extends('Public.index')
@section('home')
<div class="container col-lg-6">
    @if($postData)
        @foreach($postData as $post)
       
        <div class="card">
            <div class="card-header"> {{$post->description ?? ''}}</div>
            <div class="card-body">
                <img src="{{asset('products_images')}}/{{$post->image}}" alt="" style='width: 100%; height: 20rem;'>
            </div>
            
            <div class="card-footer">
                <span>Post by : <b><?php print_r($post->name); ?></b> </span> <br>
                <span>{{(new Carbon\Carbon($post->created_at))->diffForHumans()}}</span>
            </div>
        </div>
        @endforeach
    @endif
</div>
@endsection