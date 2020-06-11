@if(session()->has('message'))
    <div class="alert alert-info alert-dismissible fade show mx-lg-5 mx-2 mb-5" role="alert">
        <p class="mb-0">{{session()->get('message')}}</p>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
