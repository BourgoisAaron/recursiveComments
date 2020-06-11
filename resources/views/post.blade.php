@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @include('includes.message')
                <div class="card pb-3">
                    <div class="card-header">
                        <h1 class="text-center">{{$post->title}}</h1>
                    </div>
                    <div class="card-body">
                        <p class="card-subtitle mb-2 text-muted">{{$post->created_at->diffForHumans()}}</p>
                        <p class="card-subtitle mb-2 text-muted">author: {{$post->author}}</p>
                        <p>{{$post->text}}</p>
                        <div class="d-flex justify-content-between">
                            @if($post->comments->first())
                                <p>comments:</p>
                            @endif
                            @auth
                                <button class="btn btn-primary mb-3" type="button" data-toggle="collapse"
                                        data-target="#writeComment" aria-expanded="false" aria-controls="writeComment">
                                    Write comment!
                                </button>
                            @endauth
                        </div>
                        @auth
                            <div class="collapse" id="writeComment">
                                <form method="POST" action="{{action('CommentController@store', $post->id)}}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="title">Title</label>
                                        <input type="text" class="form-control" id="title" name="title">
                                    </div>
                                    <div class="form-group">
                                        <label for="text">Comment</label>
                                        <textarea class="form-control" name="text" id="text" rows="4"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary mb-2">Submit</button>
                                </form>
                            </div>
                        @endauth
                    </div>


                    <comments v-bind:replies="{{json_encode($post->comments)}}" author="{{Auth::user() ? Auth::user()->name : null}}"></comments>

{{--                @foreach($post->comments as $comment)--}}
{{--                        <div class="card ml-2 my-1">--}}
{{--                            <div class="card-body">--}}
{{--                                <h2>{{$comment->title}}</h2>--}}
{{--                                <p class="card-subtitle mb-2 text-muted">author: {{$comment->author}}, {{$comment->created_at->diffForHumans()}}</p>--}}
{{--                                <p>{{$comment->text}}</p>--}}

{{--                                <div class="d-flex justify-content-between">--}}
{{--                                    @if($comment->comments->first())--}}
{{--                                        <p>replies:</p>--}}
{{--                                    @endif--}}
{{--                                    @auth--}}
{{--                                        <button class="btn btn-primary mb-2" type="button" data-toggle="collapse"--}}
{{--                                                data-target="#writeComment{{$comment->id}}" aria-expanded="false"--}}
{{--                                                aria-controls="writeComment{{$comment->id}}">--}}
{{--                                            Reply--}}
{{--                                        </button>--}}
{{--                                    @endauth--}}
{{--                                </div>--}}
{{--                                @auth--}}
{{--                                    <div class="collapse" id="writeComment{{$comment->id}}">--}}
{{--                                        <form method="POST"--}}
{{--                                              action="{{action('CommentController@reply', $comment->id)}}">--}}
{{--                                            @csrf--}}
{{--                                            <div class="form-group">--}}
{{--                                                <label for="title">Title</label>--}}
{{--                                                <input type="text" class="form-control" id="title" name="title">--}}
{{--                                            </div>--}}
{{--                                            <div class="form-group">--}}
{{--                                                <label for="text">Comment</label>--}}
{{--                                                <textarea class="form-control" name="text" id="text"--}}
{{--                                                          rows="4"></textarea>--}}
{{--                                            </div>--}}
{{--                                            <button type="submit" class="btn btn-primary mb-2">Submit</button>--}}
{{--                                        </form>--}}
{{--                                    </div>--}}
{{--                                @endauth--}}

{{--                            </div>--}}

{{--                            @include('includes.nestedComments', ['comments' => $comment->comments])--}}

{{--                            <comments v-bind:replies="{{json_encode($comment->comments)}}" author="{{Auth::user() ? Auth::user()->name : null}}"></comments>--}}


{{--                        </div>--}}
{{--                    @endforeach--}}

                </div>
            </div>
        </div>
    </div>
@endsection
