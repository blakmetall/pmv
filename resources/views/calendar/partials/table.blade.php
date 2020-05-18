<div class="main-content">
    <div class="breadcrumb">
        <h1>{{ __('Calendar') }}</h1>
    </div>
    <div class="separator-breadcrumb border-top"></div>
    <div class="row">
        <div class="col-md-3">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="create_event_wrap">
                        <div class="form-group">
                            <h4 for="newEvent">Filter Options</h4>
                        </div>
                        <div class="separator-breadcrumb border-top"></div>
                        @include('components.search-calendar', [
                            'url' => route('calendar')
                        ])
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card mb-4 o-hidden">
                <div class="card-body">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div><!-- end of main-content -->
    <script>
        var cleaning_services = {!! json_encode($cleaning_services->toArray(), JSON_HEX_TAG) !!};
    </script>
</div>
