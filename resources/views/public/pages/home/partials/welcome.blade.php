<div class="panel-pane pane-custom pane-1">
    <div class="pane-content">
        <div class="row">
            <div class="col-xs-12 mb-5">
                {!! getSubstring(removeP($vsPage->translate()->description), 300) !!}
            </div>
            <div class="col-xs-12">
                <a href="{{ route('public.about', [App::getLocale()]) }}" title="{{ __('Learn More') }}"
                    class="btn btn-warning mr-3">{{ __('Learn More') }}</a>
                <a
                    href="{{ route('public.contact', [App::getLocale()]) }}" title="{{ __('Leave Message') }}" class="btn btn-primary"
                    >{{ __('Leave Message') }}</a>
            </div>
        </div>
    </div>
</div>
