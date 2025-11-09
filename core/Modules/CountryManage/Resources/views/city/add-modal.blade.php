<!-- State Edit Modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content custom__form">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">{{ __('Add City') }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.city.all') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label class="label-title mt-3">
                            {{ __('Country') }}
                            <span class="text-danger">*</span>
                        </label>
                        <select name="country" id="country" class="form-select" required="">
                            <option value="">{{ __('Select Country') }}</option>
                            @foreach ($all_countries as $data)
                                <option value="{{ $data->id }}">{{ $data->name }}</option>
                            @endforeach
                        </select>
                        <span class="info_msg"></span>
                    </div>

                    <div class="form-group">
                        <label class="label-title">
                            {{ __('Province') }}
                            <span class="text-danger">*</span>
                        </label>
                        <select name="state" id="state" class="form-select" required="">
                            <option value="">{{ __('Select Province') }}</option>
                            @foreach ($all_states as $state)
                                <option value="{{ $state->id }}">{{ $state->name }}</option>
                            @endforeach
                        </select>
                        <span class="info_msg"></span>
                    </div>

                    <div class="form-group">
                        <label class="label-title">
                            {{ __('City') }}
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control" name="city" id="city"
                            placeholder="Enter City Name" required="">
                        <span class="info_msg"></span>
                    </div>

                    <div class="form-group">
                        <label class="label-title">{{ __('Publish Status') }}</label>
                        <select name="status" id="status" class="form-select">
                            <option value="publish">{{ __('Publish') }}</option>
                            <option value="draft">{{ __('Unpublish') }}</option>
                        </select>
                        <span class="info_msg"></span>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary mt-4"
                        data-bs-dismiss="modal">{{ __('Close') }}</button>
                    <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4 add_city">{{ __('Add') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
