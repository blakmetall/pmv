<div class="content-bottom-container">
    <section class="content-bottom container">
        <div class="region region-content-bottom">
            <section id="block-views-testimonials-block" class="block block-views clearfix">
                <div class="view view-testimonials view-id-testimonials view-display-id-block view-testimonials-random">
                    <div class="view-content">
                        <table class="views-view-grid cols-3">
                            <tbody>
                                <tr>
                                    @foreach ($testimonials as $tindex => $testimonial)
                                        @php
                                            if ($tindex > 2) {
                                                break;
                                            }
                                        @endphp
                                        <td class="col-xs-4">
                                            <div class="views-field views-field-body">
                                                <div class="field-content">
                                                    <a
                                                        href="{{ route('public.about.testimonial', [App::getLocale(), $testimonial->testimonial_id]) }}">
                                                        {!! getSubstring($testimonial->description, 150) !!}
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="views-field views-field-title"> <span
                                                    class="field-content">{{ $testimonial->title }}</span> </div>
                                            @if ($testimonial->location)
                                                <div class="views-field views-field-field-company-location">
                                                    <div class="field-content">{{ $testimonial->location }}</div>
                                                </div>
                                            @endif
                                            @if ($testimonial->occupation)
                                                <div class="views-field views-field-field-company-location">
                                                    <div class="field-content">{{ $testimonial->occupation }}</div>
                                                </div>
                                            @endif
                                        </td>
                                    @endforeach
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>
    </section>
</div>
