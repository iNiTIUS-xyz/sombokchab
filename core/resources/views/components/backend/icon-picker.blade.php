<div class="form-group">
    <label for="icon" class="d-block">
        {{ __('Icon') }}
        <span class="text-danger">*</span>
    </label>
    <div class="btn-group ">
        <button type="button" class="btn btn-primary iconpicker-component">
            <i class="fas fa-exclamation-triangle"></i>
        </button>
        <button type="button" class="icp icp-dd btn btn-primary dropdown-toggle" style="color: var(--white) !important;"
            data-selected="fas fa-exclamation-triangle" data-bs-toggle="dropdown">
            <span class="caret" style="color: var(--white) !important;"></span>
            <span class="sr-only">{{ __('Toggle Dropdown') }}</span>
        </button>
        <div class="dropdown-menu"></div>
    </div>
    <input type="hidden" class="form-control" id="icon" value="fas fa-exclamation-triangle" name="icon">
</div>