<!-- State Edit Modal -->
<div class="modal fade" id="editCityModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">{{ __('Edit State') }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.city.edit') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="city_id" id="city_id" value="">

                <div class="modal-body">
                    <x-form.text :title="__('State')" :type="__('text')" :name="'city'" :id="'city_name'"
                        :placeholder="__('Enter State name')" />
                    <div class="single-input">
                        <label class="label-title mt-3">{{ __('Select Country') }}</label>
                        <select name="country" id="country_id" class="form-control select22-country">
                            <option value="">{{ __('Select Country') }}</option>
                            @foreach ($all_countries as $data)
                                <option value="{{ $data->id }}">{{ $data->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="single-input mb-3">
                        <label class="label-title mt-3">{{ __('Select City') }}</label>
                        <select name="state" id="state_id" class="form-control get_country_state select22-state">
                            <option value="">{{ __('Select City') }}</option>
                        </select>
                        <span class="info_msg"></span>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary mt-4"
                        data-bs-dismiss="modal">{{ __('Close') }}</button>
                    <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4 edit_city">{{ __('Update') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
