<div class="d-flex justify-content-between">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#basic-info"
                type="button" role="tab" aria-controls="basic-info" aria-selected="true">Basic</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#address" type="button"
                role="tab" aria-controls="address" aria-selected="false">Address</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#shop-info" type="button"
                role="tab" aria-controls="shop-info" aria-selected="false">Shop Info</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="bank-tab" data-bs-toggle="tab" data-bs-target="#bank-info" type="button"
                role="tab" aria-controls="bank-info" aria-selected="false">Bank Info</button>
        </li>
    </ul>
</div>

<div class="tab-content mt-3" id="myTabContent">

    <!-- Basic Info -->
    <div class="tab-pane fade show active" id="basic-info" role="tabpanel" aria-labelledby="home-tab">
        <div class="row">
            <div class="col-lg-6">
                <div class="card mb-3 shadow-sm">
                    <div class="card-body">
                        <p><strong>Vendor Name:</strong> {{ $vendor->owner_name }}</p>
                        <p><strong>Business Name:</strong> {{ $vendor->business_name }}</p>
                        <p><strong>Username:</strong> {{ $vendor->username }}</p>
                        <p><strong>Business Category:</strong> {{ $vendor?->business_type?->name }}</p>
                        <p><strong>Description:</strong> {{ $vendor->description }}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="mb-3">
                    <strong>Logo:</strong>
                    <div class="border rounded p-2 mt-1 text-center">
                        {!! \App\Http\Services\Media::render_image($vendor?->vendor_shop_info?->logo, size: 'full') !!}
                    </div>
                </div>
                <div class="mb-3">
                    <strong>Cover Photo:</strong>
                    <div class="border rounded p-2 mt-1 text-center">
                        {!! \App\Http\Services\Media::render_image($vendor?->vendor_shop_info?->cover_photo, size:
                        'full') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Address -->
    <div class="tab-pane fade" id="address" role="tabpanel" aria-labelledby="profile-tab">
        <div class="card shadow-sm">
            <div class="card-body">
                <p><strong>Country:</strong> {{ $vendor?->vendor_address?->country?->name }}</p>
                <p><strong>Province:</strong> {{ $vendor?->vendor_address?->state?->name }}</p>
                <p><strong>City:</strong> {{ $vendor?->vendor_address?->city?->name }}</p>
                <p><strong>Zip Code:</strong> {{ $vendor?->vendor_address?->zip_code }}</p>
                <p><strong>Address:</strong> {{ $vendor?->vendor_address?->address }}</p>
            </div>
        </div>
    </div>

    <!-- Shop Info -->
    <div class="tab-pane fade" id="shop-info" role="tabpanel" aria-labelledby="contact-tab">
        <div class="card shadow-sm">
            <div class="card-body">
                <p><strong>Location:</strong> {{ $vendor?->vendor_shop_info?->location }}</p>
                <p><strong>Number:</strong> {{ $vendor?->vendor_shop_info?->number }}</p>
                <p><strong>Email:</strong> {{ $vendor?->vendor_shop_info?->email }}</p>
                <p><strong>Facebook:</strong> {{ $vendor?->vendor_shop_info?->facebook_url }}</p>
                <p><strong>Website:</strong> {{ $vendor?->vendor_shop_info?->website_url }}</p>
            </div>
        </div>
    </div>

    <!-- Bank Info -->
    <div class="tab-pane fade" id="bank-info" role="tabpanel" aria-labelledby="bank-tab">
        <div class="card shadow-sm">
            <div class="card-body">
                <p><strong>Name:</strong> {{ $vendor?->vendor_bank_info?->bank_name }}</p>
                <p><strong>Email:</strong> {{ $vendor?->vendor_bank_info?->bank_email }}</p>
                <p><strong>Bank Code:</strong> {{ $vendor?->vendor_bank_info?->bank_code }}</p>
                <p><strong>Account Number:</strong> {{ $vendor?->vendor_bank_info?->account_number }}</p>
            </div>
        </div>
    </div>

</div>