@if (session()->has('msg'))
    <div class="alert alert-{{ session('type')  }} alert-dismissible fade show" role="alert">
        {!! session('msg') !!}
        <button type="button" class="close btn-sm btn-warning text-danger" data-bs-dismiss="alert">
            X
        </button>
    </div>
@endif
