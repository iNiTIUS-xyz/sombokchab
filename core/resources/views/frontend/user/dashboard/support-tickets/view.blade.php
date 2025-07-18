@extends('frontend.frontend-page-master')
@section('page-title')
    {{ __('Support Ticket Details') }}
@endsection
@section('style')
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


        /* support ticket  */

        .reply-message-wrap {
            padding: 20px;
            background-color: unset;
            border: 1px solid var(--border-two);
            border-radius: 10px
        }

        .gig-message-start-wrap {
            margin-block: 24px;
            background-color: unset;
            border: 1px solid var(--border-two);
            padding: 20px;
            border-radius: 10px
        }

        .all-message-wrap {
            border-radius: 10px
        }

        .all-message-wrap .alert {
            border-radius: 7px;
            margin: 0;
        }

        .all-message-wrap .alert :not(:last-child) {
            margin-bottom: 10px;
        }

        .single-message-item {
            background-color: #e7ebec5b;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            margin-right: 80px;
        }

        .reply-message-wrap .title {
            font-size: 22px;
            line-height: 32px;
            margin-bottom: 24px;
            font-weight: 600;
        }

        .single-message-item.customer {
            background-color: #f0f0f0f;
            text-align: left;
            margin-right: 0;
        }

        .single-message-item .message-content {
            color: #000 !important;
        }

        .single-message-item .message-content a {
            text-decoration: underline !important;
            color: var(--blue-color) !important;
        }

        .reply-message-wrap .title {
            font-size: 22px;
            line-height: 32px;
            margin-bottom: 40px;
            font-weight: 600;
        }

        .gig-message-start-wrap .boxed-btn {
            padding: 8px 10px;
        }

        .reply-message-wrap .boxed-btn {
            padding: 8px 20px;
            font-size: 14px;
            font-weight: 500;
        }

        .reply-message-wrap textarea:focus {
            outline: none;
            box-shadow: none;
        }

        .reply-message-wrap textarea {
            border: 1px solid #e2e2e2;
        }

        .gig-message-start-wrap .title {
            font-size: 20px;
            line-height: 30px;
            margin-bottom: 24px;
            font-weight: 600;
        }

        .single-message-item .thumb .title {
            font-size: 16px;
            font-weight: 600;
            text-transform: uppercase;
            width: 40px;
            height: 40px;
            line-height: 40px;
            background-color: #c7e5ec;
            display: inline-block;
            border-radius: 5px;
            text-align: center;
        }

        .single-message-item .title {
            font-size: 16px;
            line-height: 20px;
            margin: 10px 0 0px 0;
        }

        .single-message-item .time {
            display: block;
            font-size: 13px;
            margin-bottom: 20px;
            font-weight: 500;
            font-style: italic;
        }

        .single-message-item .thumb i {
            display: block;
            width: 100%;
        }

        .single-message-item.customer .thumb .title {
            background-color: #efd2d2;
        }

        .single-message-item .top-part {
            display: flex;
            /* margin-bottom: 25px; */
        }

        .single-message-item .top-part .content {
            flex: 1;
            margin-left: 15px;
        }


        .single-message-item .message-content .anchor-btn {
            /* border-bottom: 1px solid var(--main-color-one); */
            /* color: var(--main-color-one); */
            display: inline-block;
            text-decoration: underline !important;
        }

        .all-message-wrap.msg-row-reverse {
            display: flex;
            flex-direction: column-reverse;
            position: relative;
        }

        .load_all_conversation:focus {
            outline: none;
        }

        .load_all_conversation {
            border: none;
            background-color: #111D5C;
            border-radius: 30px;
            font-size: 14px;
            line-height: 20px;
            padding: 10px 30px;
            color: #fff;
            cursor: pointer;
            /* text-transform: capitalize; */
            position: absolute;
            top: -20px;
            left: 50%;
            transform: translateX(-50%);
            font-weight: 500;
        }

        .single-message-item ol,
        .single-message-item ul {
            padding-left: 15px;
        }

        /* .anchor-btn {
            color: #345990;
            text-decoration: underline;
            margin: 5px 0;
        } */
    </style>
@endsection
@section('content')
    <div class="error-page-content padding-120">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="dashboard__card support-ticket-summery-warp">
                        <div class="gig-chat-message-heading">
                            <div class="dashboard__card__header">
                                <h4 class="dashboard__card__title">{{ __('Support Ticket Details') }}</h4>
                                {{-- <a href="{{ route('user.home.support.tickets') }}"
                                    class="cmn_btn btn_bg_profile">{{ __('All Tickets') }}</a> --}}
                            </div>
                            <div class="dashboard__card__body custom__form mt-4">
                                <div class="gig-order-info">
                                    <ul>
                                        <li><strong>{{ __('Ticket ID:') }}</strong> {{ $ticket_details->id }}</li>
                                        <li><strong>{{ __('Order No:') }}</strong> {{ $ticket_details->order_id }}</li>
                                        <li><strong>{{ __('Subject:') }}</strong> {{ $ticket_details->title }} </li>
                                        <li><strong>{{ __('Status:') }}</strong> 
                                            <span
                                                class="badge status-{{ $ticket_details->status }} {{ $ticket_details->status == 'close' ? __('bg-danger') : __('bg-primary') }}">
                                                {{ ucfirst($ticket_details->status == 'close' ? __('Closed') : __($ticket_details->status)) }}
                                            </span>
                                        </li>
                                        {{-- <li><strong>{{ __('Priority:') }}</strong> 
                                            <span class="badge priority-status {{ $ticket_details->priority }} bg-{{ $ticket_details->priority }}">
                                                {{ ucfirst($ticket_details->priority) }}
                                            </span>
                                        </li> --}}
                                        <li>
                                            <strong>{{ __('Description:') }}</strong> {{ $ticket_details->description }}
                                        </li>
                                    </ul>
                                </div>
                                <div class="gig-message-start-wrap">
                                    <h2 class="dashboard__card__title mb-3">{{ __('All Conversation') }}</h2>
                                    <div class="all-message-wrap @if ($q == 'all') msg-row-reverse @endif">
                                        @if ($q == 'all' && count($all_messages) > 1)
                                            <form action="" method="get">
                                                <input type="hidden" value="all" name="q">
                                                <button class="load_all_conversation"
                                                    type="submit">{{ __('Load all messages') }}</button>
                                            </form>
                                        @endif
                                        @forelse($all_messages as $msg)
                                            <div
                                                class="single-message-item @if ($msg->type == 'customer') customer @endif">
                                                <div class="top-part">
                                                    <div class="thumb">
                                                        <span class="title">
                                                            @if ($msg->type == 'customer')
                                                                {{ substr($ticket_details->user->name ?? 'U', 0, 1) }}
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
                                                            @else
                                                                {{ $ticket_details->admin->name ?? 'A' }}
                                                            @endif
                                                        </h6>
                                                        <span class="time">
                                                            {{ date_format($msg->created_at, 'd M Y H:i:s') }}
                                                            | {{ $msg->created_at->diffForHumans() }}
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="content">
                                                    <div class="message-content">
                                                        {{-- {!! $msg->message !!} --}}
                                                        @if (!empty($msg->attachment) && file_exists(public_path('assets/uploads/ticket/' . $msg->attachment)))
                                                            <a href="{{ asset('assets/uploads/ticket/' . $msg->attachment) }}" download class="anchor-btn text-info">
                                                                <strong class="text-info">File:</strong>
                                                                <span class="text-info">{{ $msg->attachment }}</span>
                                                            </a>
                                                        @else
                                                            <span>{!! $msg->message ?: 'No message provided' !!}</span>
                                                        @endif
                                                    </div>
                                                    {{-- @if (file_exists('assets/uploads/ticket/' . $msg->attachment))
                                                        <a href="{{ asset('assets/uploads/ticket/' . $msg->attachment) }}"
                                                            download class="anchor-btn">
                                                            <strong class="text-info">File :</strong>
                                                            <span class="text-info">
                                                                {{ $msg->attachment }}
                                                            </span>
                                                        </a>
                                                    @endif --}}

                                                </div>
                                            </div>
                                        @empty
                                            <p class="alert alert-warning">{{ __('No message found') }}</p>
                                        @endforelse
                                    </div>
                                </div>
                                <div class="reply-message-wrap ">
                                    <x-msg.error />
                                    <x-msg.flash />
                                    <form action="{{ route('user.dashboard.support.ticket.message') }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" value="{{ $ticket_details->id }}" name="ticket_id">
                                        <input type="hidden" value="customer" name="user_type">
                                        <div class="form-group">
                                            <label for="">{{ __('Type your message here') }}</label>
                                            <textarea name="message" class="form-control d-none" cols="30" rows="5"></textarea>
                                            <div class="summernote"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="file">{{ __('File') }}</label>
                                            <input type="file" name="file">
                                            <small class="info-text d-block text-danger">
                                                {{ __('Max file size 200mb, only zip, png, gif, jpg, jpeg, pdf, docx, doc, odd file is allowed') }}
                                            </small>
                                        </div>
                                        <div class="form-group d-flex align-items-start gap-3">
                                            <input type="checkbox" name="send_notify_mail" id="send_notify_mail">
                                            <label for="send_notify_mail">{{ __('Notify via mail') }}</label>
                                        </div>
                                        <div class="btn-wrapper">
                                            <button type="submit" class="cmn_btn btn_bg_1 btn-success">
                                                {{ __('Send Message') }}
                                            </button>
                                            <a href="{{ route('user.home.support.tickets') }}"
                                                class="cmn_btn default-theme-btn"
                                                style="color: var(--white); background: var(--paragraph-color); border: 2px solid var(--paragraph-color);">
                                                {{ __('Back') }}
                                            </a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('assets/backend/js/summernote-bs4.js') }}"></script>
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
                },
                toolbar: [
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link']],
                ],
            });

        });
    </script>
@endsection
