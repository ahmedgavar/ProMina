@if (Session::has('success'))
    <div class="row mr-2 m1-2">

        <button type="text" class="btn btn-lg btn-block btn-outline-success m-2" id="type-error">
            {{ Session::get('success') }}
        </button>
    </div>

@endif


