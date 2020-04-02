<!-- Footer Start -->
<div class="flex-grow-1"></div>
<div class="app-footer mb-2">
    <div class="footer-bottom d-flex flex-column flex-sm-row align-items-center">
        <div class="d-flex align-items-center">
            <div>
                <p class="m-0">
                    &copy; {{ date('Y', strtotime('now')) }} {{ env('APP_NAME') }}. 
                    {{ __('All rights reserved.') }}
                </p>
            </div>
        </div>
    </div>
</div>
@if ($errors->any())
    <div class="alert alert-danger error-msg" role="alert" style="position: absolute; right: 0;">
        <ul style="display: inline-block; margin-bottom: 0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button class="close" type="button" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
@endif
<!-- footer end -->
