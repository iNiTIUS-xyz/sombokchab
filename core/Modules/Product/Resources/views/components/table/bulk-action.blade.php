@php
    if (isset($permissions) && !auth('admin')->user()->can($permissions)) {
        return;
    }
@endphp


<div class="bulk-delete-wrapper d-flex mt-3">
    <select name="bulk_option" id="bulk_option">
        <option value="">{{ __('Bulk Action') }}</option>
        <option value="delete">{{ __('Delete') }}</option>
        @if (Route::is('admin.products.all') || Route::is('vendor.products.all'))
            <option value="active">{{ __('Active') }}</option>
            <option value="inactive">{{ __('Inactive') }}</option>
        @endif
    </select>
    <input type="hidden" value="{{ Route::is('admin.products.all') }}" id="isAdminOrVendor">
    <button class="btn btn-primary " id="bulk_delete_btn">{{ __('Apply') }}</button>
</div>
