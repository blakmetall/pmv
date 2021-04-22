@php
    $_current_lang = LanguageHelper::current();
    $isLoggedIn = Auth::id();
@endphp

<div class="region region-navigation">
    <section id="block-locale-language" class="block block-locale clearfix">


        <ul class="language-switcher-locale-url">
            @if($isLoggedIn)
                <li class="en first"><a
                    href="/system"
                    class="language-link"
                    xml:lang="en">{{ __('Dashboard') }}</a></li>
            @else
                <li class="en first"><a
                    href="/login"
                    class="language-link"
                    xml:lang="en">{{ __('Login') }}</a></li>
            @endif

            <li class="en first" {{ $_current_lang->id == 1 ? 'active' : '' }}><a
                    href="{{ route('language.update', ['en']) }}"
                    class="language-link {{ $_current_lang->id == 1 ? 'active' : '' }}"
                    xml:lang="en">{{ __('English') }}</a></li>

            <li class="es last {{ $_current_lang->id == 2 ? 'active' : '' }}"><a
                    href="{{ route('language.update', ['es']) }}"
                    class="language-link {{ $_current_lang->id == 2 ? 'active' : '' }}"
                    xml:lang="es">{{ __('Spanish') }}</a></li>
        </ul>
    </section>
</div>
