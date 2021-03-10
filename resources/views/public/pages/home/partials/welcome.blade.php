<div class="panel-pane pane-custom pane-1">
    <div class="pane-content">
        <div class="row">
            <div class="col-xs-8">
                {!! getSubstring(removeP($vsPage->translate()->description), 300) !!}
            </div>
            <div class="col-xs-4 text-right">
                <a href="{{ route('public.about') }}" title="{{ __('Learn More') }}"
                    class="btn btn-warning">{{ __('Learn More') }}</a>&nbsp;&nbsp;<a
                    href="{{ route('public.contact') }}" title="{{ __('Leave Message') }}" class="btn btn-primary"
                    style="margin-bottom: 5px;">{{ __('Leave Message') }}</a>
            </div>
        </div>
    </div>
</div>
