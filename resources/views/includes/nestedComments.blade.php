@foreach($comments as $nestedComment)
    <div class="card ml-2 my-1">
        <div class="card-body">
            <p><strong>{{$nestedComment->title}}</strong></p>
            <p class="card-subtitle mb-2 text-muted">author: {{$nestedComment->author}}
                , {{$nestedComment->created_at->diffForHumans()}}</p>
            <p>{{$nestedComment->text}}</p>

            <div class="d-flex justify-content-between">
                @if($nestedComment->comments->first())
                    <p>replies:</p>
                @endif
                @auth
                    <button class="btn btn-primary mb-2" type="button" data-toggle="collapse"
                            data-target="#writeComment{{$nestedComment->id}}" aria-expanded="false"
                            aria-controls="writeComment{{$nestedComment->id}}">
                        Reply
                    </button>
                @endauth
            </div>
            @auth
                <div class="collapse" id="writeComment{{$nestedComment->id}}">
                    <form method="POST" action="{{action('CommentController@reply', $nestedComment->id)}}">
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
        @if($loop->depth < 5)
            @include('includes.nestedComments', ['comments' => $nestedComment->comments])
        @else
            <comments v-bind:replies="{{json_encode($nestedComment->comments)}}" author="{{Auth::user() ? Auth::user()->name : null}}"></comments>
        @endif
    </div>
@endforeach
