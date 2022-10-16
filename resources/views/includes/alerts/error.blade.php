@if (Session::has('error'))
    <div class="row mr-2 m1-2">

        <button type="text" class="btn btn-lg btn-block btn-outline-danger m-2" id="type-error">
            {{ Session::get('error') }}
        </button>
    </div>

@endif


