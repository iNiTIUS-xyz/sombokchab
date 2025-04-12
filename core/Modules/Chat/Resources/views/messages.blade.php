@php
    $messages = $data->messages;
    $user_image = render_image($data->user->profile_image, defaultImage: true);
    $vendor_image = render_image($data->vendor->logo, defaultImage: true);
@endphp

@foreach($messages as $message)
    <x-chat::user-message :$message :userimage="$user_image" :vendorimage="$vendor_image"/>
@endforeach