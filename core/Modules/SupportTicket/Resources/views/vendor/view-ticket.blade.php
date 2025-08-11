@extends('vendor.vendor-master')
@section('site-title')
    {{ __('Ticket Details') }}
@endsection
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/backend/css/dropzone.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/backend/css/media-uploader.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/backend/css/summernote-bs4.css') }}">
    <style>
        .priority-status.bg-low{

        }

        .priority-status.bg-low {
        background-color: var(--updatedOffer-bg-1);
        border:1px solid var(--updatedOffer-bg-1);
        color: var(--black);
        }

        .priority-status.bg-medium {
        background-color: var(--section-bg);
        border:1px solid var(--section-bg);
        color: var(--black);
        }

        .priority-status.bg-high {
        background-color: var(--main-color-two);
        border:1px solid var(--main-color-two);
        color: var(--black);
        }

        .priority-status.bg-urgent {
        background-color: var(--delete-color);
        border:1px solid var(--delete-color);
        color: var(--white);
        }

    </style>
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12">
        <div class="row">
            <div class="col-lg-12">
                <x-msg.flash />
                <x-msg.error />
                <div class="dashboard__card">
                    <div class="dashboard__card__header">
                        <h4 class="dashboard__card__title">{{ __('Support Ticket Details') }}</h4>
                        <div class="btn-wrapper">
                            <a class="cmn_btn btn_bg_profile"
                                href="{{ route('vendor.support.ticket.all') }}">{{ __('All Tickets') }}</a>
                        </div>
                    </div>
                    <div class="dashboard__card__body mt-4">
                        <div class="gig-chat-message-heading">
                            <div class="gig-order-info">
                                <ul>
                                    <li><strong>{{ __('Ticket ID:') }}</strong> {{ $ticket_details->id }}</li>
                                    <li><strong>{{ __('Title:') }}</strong> {{ $ticket_details->title }}</li>
                                    <li><strong>{{ __('Subject:') }}</strong> {{ $ticket_details->subject }}</li>
                                    <li><strong>{{ __('Description:') }}</strong> {{ $ticket_details->description }}</li>
                                    <li><strong>{{ __('Status:') }}</strong> 
                                        <span
                                            class="badge status-{{ $ticket_details->status }} {{ $ticket_details->status == 'close' ? __('bg-danger') : __('bg-primary') }}">
                                            {{ ucfirst($ticket_details->status == 'close' ? __('Closed') : __($ticket_details->status)) }}
                                        </span>
                                    </li>
                                    <li><strong>{{ __('Priority:') }}</strong> 
                                        <span class="badge priority-status {{ $ticket_details->priority }} bg-{{ $ticket_details->priority }}">
                                            {{ ucfirst($ticket_details->priority) }}
                                        </span>
                                    </li>
                                    <li><strong>{{ __('User:') }}</strong>
                                        {{ $ticket_details->user->name ?? __('anonymous') }}</li>
                                    <li><strong>{{ __('Support Category:') }}</strong>
                                        {{ $ticket_details->department->name ?? __('anonymous') }}</li>
                                    @if ($ticket_details->admin_id)
                                        <li><strong>{{ __('Admin:') }}</strong>
                                            {{ $ticket_details->admin->name ?? __('anonymous') }}</li>
                                    @endif
                                </ul>
                            </div>
                            <div class="gig-message-start-wrap">
                                <h2 class="title">{{ __('Conversation') }}</h2>
                                <div class="all-message-wrap @if ($q == 'all') msg-row-reverse @endif">
                                    @if ($q == 'all' && count($all_messages) > 1)
                                        <form action="" method="get">
                                            <input type="hidden" value="all" name="q">
                                            <button class="load_all_conversation"
                                                type="submit">{{ __('load all message') }}</button>
                                        </form>
                                    @endif
                                    @forelse($all_messages as $msg)
                                        <div class="single-message-item @if ($msg->type == 'vendor') customer @endif">
                                            <div class="top-part">
                                                <div class="thumb">
                                                    <span class="title">
                                                        @if ($msg->type == 'customer')
                                                            {{ substr($ticket_details->user->name ?? 'U', 0, 1) }}
                                                        @elseif($msg->type == 'vendor')
                                                            {{ substr($ticket_details->vendor->name ?? 'V', 0, 1) }}
                                                        @else
                                                            {{ substr($ticket_details->admin->name ?? 'A', 0, 1) }}
                                                        @endif
                                                    </span>
                                                    @if ($msg->notify == 'on')
                                                        <i class="fas fa-envelope mt-2"
                                                            title="{{ __('Notified by email') }}"></i>
                                                    @endif
                                                </div>
                                                <div class="content">
                                                    <h6 class="title">
                                                        @if ($msg->type == 'customer')
                                                            {{ $ticket_details->user->name ?? 'U' }}
                                                        @elseif($msg->type == 'vendor')
                                                            {{ $ticket_details->vendor->name ?? 'V' }}
                                                        @else
                                                            {{ $ticket_details->admin->name ?? 'A' }}
                                                        @endif
                                                    </h6>
                                                    <span class="time">{{ date_format($msg->created_at, 'd M Y H:i:s') }}
                                                        | {{ $msg->created_at->diffForHumans() }}</span>
                                                </div>
                                            </div>
                                            <div class="content">
                                                <div class="message-content">
                                                    {!! $msg->message !!}
                                                </div>
                                                @if ($msg->attachment)
                                                    @if (file_exists('assets/uploads/ticket/' . $msg->attachment))
                                                        <a href="{{ asset('assets/uploads/ticket/' . $msg->attachment) }}"
                                                            download class="anchor-btn">
                                                            <strong>File: </strong>
                                                            <span class="text-info">
                                                                {{ $msg->attachment }}
                                                            </span>
                                                        </a>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                    @empty
                                        <p class="alert alert-warning">{{ __('no message found') }}</p>
                                    @endforelse
                                </div>
                            </div>
                            @if($ticket_details->status !== 'close')
                            <div class="reply-message-wrap ">
                                <h5 class="title">
                                    {{ __('Reply') }}
                                </h5>
                                <form action="{{ route('vendor.support.ticket.send.message') }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" value="{{ $ticket_details->id }}" name="ticket_id">
                                    <input type="hidden" value="vendor" name="user_type">
                                    <div class="form-group mt-4">
                                        <label for="">
                                            {{ __('Message') }}
                                            <span class="text-danger">*</span>
                                        </label>
                                        <textarea name="message" class="form-control d-none" cols="30" rows="5" placeholder="Enter Message"></textarea>
                                        <div class="summernote"></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="file">
                                            {{ __('File') }}
                                        </label>
                                        <input type="file" name="file">
                                        <small class="info-text d-block text-danger">
                                            {{ __('Max file size 200mb, only zip, png, gif, jpg, jpeg, pdf, docx, doc, odd file is allowed') }}
                                        </small>
                                    </div>
                                    <div class="form-group d-flex align-items-baseline gap-3">
                                        <input type="checkbox" name="send_notify_mail" id="send_notify_mail">
                                        <label for="send_notify_mail">{{ __('Notify Via Mail') }}</label>
                                    </div>
                                    <button class="btn-primary btn btn-md" type="submit">{{ __('Send Message') }}</button>
                                </form>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('backend.partials.media-upload.media-upload-markup')
@endsection
@section('script')
    <script src="{{ asset('assets/backend/js/summernote-bs4.js') }}"></script>
    <script src="{{ asset('assets/backend/js/dropzone.js') }}"></script>
    @include('backend.partials.media-upload.media-js')
    <script>
        $(document).ready(function() {
            $('.summernote').summernote({
                height: 200, //set editable area's height
                codemirror: { // codemirror options
                    theme: 'monokai'
                },
                callbacks: {
                    onChange: function(contents, $editable) {
                        $(this).prev('textarea').val(contents);
                    },
                    onPaste: function(e) {
                        let bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData)
                            .getData('text/plain');
                        e.preventDefault();
                        document.execCommand('insertText', false, bufferText);
                    }
                }
            });
        });
    </script>
@endsection
