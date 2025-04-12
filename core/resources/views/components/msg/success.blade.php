@if (session()->has('msg'))
    <div class="alert alert-{{ session('type') ? session('type') : 'success' }} alert-dismissible fade show">
        {!! Purifier::clean(session('msg')) !!}
        <button type="button btn-sm" class="close" data-bs-dismiss="alert">X</button>
    </div>
@endif
