@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h1 class="text-center">All posts</h1>
                    </div>

                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            @foreach($posts as $post)
                                <li class="list-group-item">
                                    <a href="{{route('post', $post->id)}}" class="text-secondary">{{$post->title}}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
