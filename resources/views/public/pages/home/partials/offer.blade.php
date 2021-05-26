<div class="panel-pane pane-custom pane-3 pt-3">
    <h2 class="pane-title mb-5 pb-3">{{ __('What We Offer') }}</h2>

    <div class="pane-content">
        <div class="row-fluid offers-block">
            <div class="col-xs-12 col-sm-6 col-md-4 pl-0 mb-5">
                <img src="{{ asset('assets/public/images/vr.jpg') }}" width="100%" class="mb-3" />
                
                <h5>{{ $vsPage->translate()->title }}</h5>
                {!! getSubstring(removeImage(removeP($vsPage->translate()->description)), 150) !!}
                
                <br><br>
                
                <a href="{{ route('public.vacation-services', [App::getLocale()]) }}" class="btn btn-primary btn-xs" role="button">
                    {{ __('READ MORE') }}
                </a>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4 pl-0 mb-5">
                <img src="{{ asset('assets/public/images/pm.jpg') }}" width="100%" class="mb-3"/>
                
                <h5>{{ $pmPage->translate()->title }}</h5>
                {!! getSubstring(removeImage(removeP($pmPage->translate()->description)), 150) !!}
                
                <br><br>
                
                <a href="{{ route('public.property-management', [App::getLocale()]) }}" class="btn btn-primary btn-xs" role="button">
                    {{ __('READ MORE') }}
                </a>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4 pl-0 mb-5">
                <img src="{{ asset('assets/public/images/cs.jpg') }}" width="100%" class="mb-3" />
                
                <h5>{{ $csPage->translate()->title }}</h5>
                {!! getSubstring(removeImage(removeP($csPage->translate()->description)), 150) !!}
                
                <br><br>
                
                <a href="{{ route('public.concierge-services', [App::getLocale()]) }}" class="btn btn-primary btn-xs" role="button">
                    {{ __('READ MORE') }}
                </a>
            </div>
        </div>
    </div>
</div>
