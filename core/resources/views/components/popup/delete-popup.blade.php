<a tabindex="0" class="btn btn-danger btn-sm swal_delete_button" title="{{ __('Delete Data') }}">
    <i class="ti-trash"></i>
</a>
<form method='post' action='{{ $url }}' class="d-none">
    <input type='hidden' name='_token' value='{{ csrf_token() }}'>
    <br>
    <button type="submit" class="swal_form_submit_btn d-none"></button>
</form>
