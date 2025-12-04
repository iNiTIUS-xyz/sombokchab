@extends('backend.admin-master')

@section('site-title')
    {{ __('Product Child-Category') }}
@endsection

@section('style')
    <x-media.css />
    <x-bulk-action.css />
@endsection

@section('content')
    @php
        $statuses = \App\Status::all();
    @endphp
    <div class="col-lg-12 col-ml-12">
        <div class="row">
            <div class="col-lg-12">
                <x-msg.error />
                <x-msg.flash />
                <div class="mb-4">
                    @can('add-category')
                        <a href="#1" data-bs-toggle="modal" data-bs-target="#child-category_create_modal"
                            class="cmn_btn btn_bg_profile">
                            {{ __('New Child Category') }}
                        </a>
                    @endcan
                </div>
                <div class="dashboard__card">
                    <div class="dashboard__card__header">
                        <h3 class="dashboard__card__title">{{ __('All Products Child-Categories') }}</h3>
                        <div class="dashboard__card__header__right">
                            @can('view-category')
                                <x-bulk-action.dropdown />
                            @endcan
                        </div>
                    </div>
                    <div class="dashboard__card__body mt-4">
                        <div class="table-responsive">
                            <table class="table table-default" id="dataTable">
                                <thead>
                                    @can('view-category')
                                        <x-bulk-action.th />
                                    @endcan
                                    <th>{{ __('ID') }}</th>
                                    <th>{{ __('Category Name') }}</th>
                                    <th>{{ __('Sub Category Name') }}</th>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Image') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </thead>
                                <tbody>
                                    @foreach ($all_child_category as $child_category)
                                        @php
                                            $category = $child_category->category?->name;
                                            $sub_category = $child_category->sub_category?->name;
                                        @endphp
                                        <tr>
                                            @can('view-category')
                                                <x-bulk-action.td :id="$child_category->id" />
                                            @endcan
                                            <td>{{ $all_child_category->perPage() * ($all_child_category->currentPage() - 1) + $loop->iteration }}
                                            </td>
                                            <td>{{ $category }}</td>
                                            <td>{{ $sub_category }}</td>
                                            <td>{{ $child_category->name }}</td>
                                            <td>
                                                <x-status-span :status="$child_category->status?->name" />
                                            </td>
                                            <td>
                                                <div class="attachment-preview">
                                                    <div class="img-wrap">
                                                        {!! \App\Http\Services\Media::render_image($child_category->image, 'thumb', class: 'w-100') !!}
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                @can('edit-category')
                                                    <a href="#1" title="{{ __('Edit') }}" data-bs-toggle="modal"
                                                        data-bs-target="#child-category_edit_modal"
                                                        class="btn btn-sm btn-primary btn-xs mb-2 me-1 child-category_edit_btn"
                                                        data-id="{{ $child_category->id }}"
                                                        data-name="{{ $child_category->name }}"
                                                        data-slug="{{ $child_category->slug }}"
                                                        data-status="{{ $child_category->status_id }}"
                                                        data-imageid="{!! $child_category->image_id !!}"
                                                        data-image="{{ \App\Http\Services\Media::render_image($child_category->image, render_type: 'path') }}"
                                                        data-category-id="{{ $child_category->category_id }}"
                                                        data-sub-category-id="{{ $child_category->sub_category_id }}">
                                                        <i class="ti-pencil"></i>
                                                    </a>
                                                @endcan
                                                @can('delete-category')
                                                    <x-table.btn.swal.delete :route="route(
                                                        'admin.child-category.delete',
                                                        $child_category->id,
                                                    )" />
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="child-category-pagination">{{ $all_child_category->links() }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @can('edit-category')
        <div class="modal fade" id="child-category_edit_modal" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content custom__form">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('Update Child Category') }}</h5>
                        <button type="button" class="close" data-bs-dismiss="modal"><span>×</span></button>
                    </div>
                    <form action="{{ route('admin.child-category.update') }}" method="post">
                        <input type="hidden" name="id" id="child-category_id">
                        <div class="modal-body">
                            @csrf
                            <div class="form-group">
                                <label for="edit_name">{{ __('Name') }}</label>
                                <input type="text" class="form-control" id="edit_name" name="name"
                                    placeholder="{{ __('Enter name') }}">
                            </div>
                            {{-- <div class="form-group">
                                <label for="edit_slug">{{ __('Slug') }}</label>
                                <input type="text" class="form-control" id="edit_slug" name="slug"
                                    placeholder="{{ __('Slug') }}">
                            </div> --}}
                            <div class="form-group edit-category-wrapper">
                                <label for="category">{{ __('Category') }}</label>
                                <select class="form-control" id="edit_category_id" name="category_id">
                                    <option>{{ __('Select Category') }}</option>
                                    @foreach ($all_category as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group edit-sub-category-wrapper">
                                <label for="category">{{ __('Sub Category') }}</label>
                                <select class="form-control" id="edit_sub_category" name="sub_category_id">
                                    <option>{{ __('Select Sub Category') }}</option>
                                    {{-- @foreach ($sub_categories as $sub_category) --}}
                                    {{-- <option value="{{ $category->id }}">{{ $category->name }}</option> --}}
                                    {{-- @endforeach --}}
                                </select>
                            </div>

                            <div class="form-group edit-status-wrapper">
                                <label for="edit_status">{{ __('Status') }}</label>
                                <select name="status_id" class="form-control" id="edit_status">
                                    @foreach ($statuses as $status)
                                        <option value="{{ $status->id }}">{{ $status->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <x-media-upload :title="__('Image')" :name="'image_id'" :dimentions="'200x200'" />
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                data-bs-dismiss="modal">{{ __('Close') }}</button>
                            <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endcan

    @can('add-category')
        <div class="modal fade" id="child-category_create_modal" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content custom__form">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('Add Child Category') }}</h5>
                        <button type="button" class="close" data-bs-dismiss="modal"><span>×</span></button>
                    </div>
                    <form action="{{ route('admin.child-category.new') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="create-name">{{ __('Name') }}</label>
                                <input type="text" class="form-control" id="create-name" name="name"
                                    placeholder="{{ __('Enter name') }}">
                            </div>

                            {{-- <div class="form-group">
                                <label for="create-slug">{{ __('Slug') }}</label>
                                <input type="text" class="form-control" id="create-slug" name="slug"
                                    placeholder="{{ __('Slug') }}">
                            </div> --}}

                            <div class="form-group category-wrapper">
                                <label for="category_id">{{ __('Category') }}</label>
                                <select class="form-control" id="create_category_id" name="category_id">
                                    <option>{{ __('Select Category') }}</option>
                                    @foreach ($all_category as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group create-sub-category-wrapper">
                                <label for="category">{{ __('Sub Category') }}</label>
                                <select class="form-control" id="create_sub_category" name="sub_category_id">
                                    <option>{{ __('Select Sub Category') }}</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="status">{{ __('Status') }}</label>
                                <select name="status_id" class="form-control" id="status">
                                    @foreach ($statuses as $status)
                                        <option value="{{ $status->id }}">{{ $status->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <x-media-upload :title="__('Image')" :name="'image_id'" :dimentions="'200x200'" />
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                data-bs-dismiss="modal">{{ __('Close') }}</button>
                            <button type="submit" class="btn btn-primary">{{ __('Add') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endcan
    <x-media.markup />
@endsection

@section('script')
    <script>
        $(document).ready(function() {

            // Auto-slug generator
            $('#create-name, #create-slug').on('keyup', function() {
                let title_text = $(this).val();
                $('#create-slug').val(convertToSlug(title_text));
            });

            $('#edit_name, #edit_slug').on('keyup', function() {
                let title_text = $(this).val();
                $('#edit_slug').val(convertToSlug(title_text));
            });

            // Load Sub Categories on Create Modal
            $(document).on("change", "#create_category_id", function() {
                let category_id = $(this).val();
                $.ajax({
                    url: '{{ route('admin.subcategory.all') }}/of-category/select/' + category_id,
                    type: 'GET',
                    data: {
                        _token: '{{ csrf_token() }}',
                        "category_id": category_id
                    },
                    success: function(data) {
                        $("#create_sub_category").html(data.option);
                        $(".create-sub-category-wrapper .list").html(data.list);
                        $(".create-sub-category-wrapper span.current").html(
                            "Select Sub Category");
                    }
                });
            });

            // Load Sub Categories on Edit Modal when category changes
            $(document).on("change", "#edit_category_id", function() {
                let category_id = $(this).val();
                $.ajax({
                    url: '{{ route('admin.subcategory.all') }}/of-category/select/' + category_id,
                    type: 'GET',
                    data: {
                        _token: '{{ csrf_token() }}',
                        "category_id": category_id
                    },
                    success: function(data) {
                        $("#edit_sub_category").html(data.option);
                        $(".edit-sub-category-wrapper .list").html(data.list);
                        $(".edit-sub-category-wrapper span.current").html(
                            "Select Sub Category");
                    }
                });
            });

            // Open Edit Modal with data
            $(document).on('click', '.child-category_edit_btn', function() {
                let el = $(this);
                let modal = $('#child-category_edit_modal');

                // Get data
                let id = el.data('id');
                let name = el.data('name');
                let slug = el.data('slug');
                let status = el.data('status');
                let category_id = el.data('category-id');
                let sub_category_id = el.data('sub-category-id');
                let image = el.data('image');
                let imageid = el.data('imageid');

                // Fill basic fields
                modal.find('#child-category_id').val(id);
                modal.find('#edit_name').val(name);
                modal.find('#edit_slug').val(slug);
                modal.find('#edit_category_id').val(category_id);
                modal.find('#edit_status').val(status);

                // Load sub categories for selected category and set sub_category_id
                $.ajax({
                    url: '{{ route('admin.subcategory.all') }}/of-category/select/' + category_id,
                    type: 'GET',
                    data: {
                        _token: '{{ csrf_token() }}',
                        "category_id": category_id
                    },
                    success: function(data) {
                        $("#edit_sub_category").html(data.option);
                        $(".edit-sub-category-wrapper .list").html(data.list);

                        // Set selected sub category
                        $("#edit_sub_category").val(sub_category_id);
                    }
                });

                // Image preview
                if (imageid != '') {
                    modal.find('.media-upload-btn-wrapper .img-wrap').html(
                        '<div class="attachment-preview"><div class="thumbnail"><div class="centered"><img class="avatar user-thumb" src="' +
                        image + '" > </div></div></div>'
                    );
                    modal.find('.media-upload-btn-wrapper input').val(imageid);
                    modal.find('.media-upload-btn-wrapper .media_upload_form_btn').text('Change Image');
                }

                // Finally, show the modal
                modal.modal('show');
            });

        });
    </script>

    <x-media.js />
    <x-table.btn.swal.js />
    @can('view-category')
        <x-bulk-action.js :route="route('admin.child-category.bulk.action')" />
    @endcan
@endsection
