<!-- Footer Start -->
<div class="flex-grow-1"></div>
<div class="app-footer mb-2">
    <div class="footer-bottom d-flex flex-column flex-sm-row align-items-center">
        <div class="d-flex align-items-center">
            <div>
                <p class="m-0">
                    &copy; {{ date('Y', strtotime('now')) }} {{ env('APP_NAME') }}. 
                    Palmera Vacations; {{ __('All rights reserved.') }}
                </p>
            </div>
        </div>
    </div>
</div>
<!-- footer end -->
