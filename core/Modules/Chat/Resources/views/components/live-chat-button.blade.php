@if(moduleExists('Chat') && $product->vendor_id)
    <div class="chatContact__btnWrapper mt-3">
        <div class="chatContact__btn"
             data-is-user-logged-in="{{ auth("web")->check() ?? false }}"
             data-vendor-id="{{ $product->vendor?->id }}"
             data-vendor-name="{{ $product->vendor?->business_name }}"
             data-vendor-logo="{{ render_image($product->vendor?->logo, render_type: 'path') }}"
             id="open-chat{{ $from == 'product' ? '-product' : '' }}">
            <i class="las la-comment"></i> {{ __("Chat") }}
        </div>
    </div>
@endif
