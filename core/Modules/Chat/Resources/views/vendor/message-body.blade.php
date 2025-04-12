@foreach($data->messages as $message)
    <x-chat::vendor.message :$message :$data />
@endforeach