<div class="panel-pane pane-custom pane-3">
    <h2 class="pane-title">What We Offer</h2>
    <div class="pane-content">
        <div class="row offers-block">
            <div class="col-xs-4">
                <img src="http://palmeravacations.com/sites/default/files/images/vr.jpg" width="100%" />
                <h5>{{ $vsPage->translate()->title }}</h5>
                {!! getSubstring(removeImage(removeP($vsPage->translate()->description)), 150) !!}<br><br>
                <a href="{{ route('public.vacation-services') }}" title="{{ __('READ MORE') }}"
                    class="read-more">{{ __('READ MORE') }}</a>
            </div>
            <div class="col-xs-4">
                <img src="http://palmeravacations.com/sites/default/files/images/pm.jpg" width="100%" />
                <h5>{{ $pmPage->translate()->title }}</h5>
                {!! getSubstring(removeImage(removeP($pmPage->translate()->description)), 150) !!}<br><br>
                <a href="{{ route('public.property-management') }}" title="{{ __('READ MORE') }}"
                    class="read-more">{{ __('READ MORE') }}</a>
            </div>
            <div class="col-xs-4">
                <img src="http://palmeravacations.com/sites/default/files/images/cs.jpg" width="100%" />
                <h5>{{ $csPage->translate()->title }}</h5>
                {!! getSubstring(removeImage(removeP($csPage->translate()->description)), 150) !!}<br><br>
                <a href="{{ route('public.concierge-services') }}" title="{{ __('READ MORE') }}"
                    class="read-more">{{ __('READ MORE') }}</a>
            </div>
        </div>
    </div>
</div>
