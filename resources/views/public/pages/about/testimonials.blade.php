@extends('layouts.public-master')

@section('main-content')

    @include('public.pages.partials.content-top')

    @php
    $title = __('TESTIMONIALS');
    @endphp

    @include('public.pages.partials.main-content-start')

    <div class="panel-display panel-1col clearfix">
        <div class="panel-panel panel-col">
            <div>
                <div class="panel-pane pane-block pane-views-testimonials-block-1">
                    <div class="pane-content">
                        <div
                            class="view view-testimonials view-id-testimonials view-display-id-block_1 view-testimonials-list view-dom-id-594d2da053ff9b498c40076f9d818f4d">
                            <div class="view-content">
                                <table class="views-view-grid cols-1">
                                    <tbody>
                                        <tr class="row-1 row-first">
                                            <td class="col-1 col-first">

                                                <div class="views-field views-field-body">
                                                    <div class="field-content">
                                                        <a href="/testimonial/36">
                                                            <p>Deluxe property in great area. At the top of the Nicaragua
                                                                hill. Views from the unit's balcony include both bay and
                                                                city. Views from rooftop sun terrace and pool are even more
                                                                delightful. This unit has everything you could possibly
                                                                need. Can not think of anything the property does not offer.
                                                            </p>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="views-field views-field-title"> <span class="field-content">Mark
                                                        Kirkwood</span> </div>
                                                <div class="views-field views-field-field-company-location">
                                                    <div class="field-content">USA</div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="row-2">
                                            <td class="col-1 col-first">
                                                <div class="views-field views-field-body">
                                                    <div class="field-content">
                                                        <a href="/testimonial/35">
                                                            <p>The apartment very well located and in very good condition
                                                                with everything you need for a very pleasant stay.</p>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="views-field views-field-title"> <span
                                                        class="field-content">Victor Coronel</span> </div>
                                                <div class="views-field views-field-field-company-location">
                                                    <div class="field-content">Mexico</div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="row-3">
                                            <td class="col-1 col-first">
                                                <div class="views-field views-field-body">
                                                    <div class="field-content">
                                                        <a href="/testimonial/34">
                                                            <p>We have used Palmera as our property manager for the last
                                                                several years. It has been a great experience, as everyone
                                                                there has been very professional and addresses the issues
                                                                that come up very promptly and effectively. It can be quite
                                                                a headache to own a second residence that you are often away
                                                                from for long stretches of time.</p>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="views-field views-field-title"> <span
                                                        class="field-content">Scott Knutson</span> </div>
                                                <div class="views-field views-field-field-company-location">
                                                    <div class="field-content">Property Owner</div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="row-4">
                                            <td class="col-1 col-first">
                                                <div class="views-field views-field-body">
                                                    <div class="field-content">
                                                        <a href="/testimonial/33">
                                                            <p>Spacious. Convenient. Relaxing.</p>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="views-field views-field-title"> <span
                                                        class="field-content">Kevin Thornton</span> </div>
                                                <div class="views-field views-field-field-company-location">
                                                    <div class="field-content">Orlando, FL</div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="row-5 row-last">
                                            <td class="col-1 col-first">
                                                <div class="views-field views-field-body">
                                                    <div class="field-content">
                                                        <a href="/testimonial/32">
                                                            <p>I do not have to tell you how much I appreciate all of the
                                                                efforts of the Palmera Vacations team. You make owning a
                                                                home in PV easy.</p>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="views-field views-field-title"> <span
                                                        class="field-content">Harvey Malinsky</span> </div>
                                                <div class="views-field views-field-field-company-location">
                                                    <div class="field-content">Toronto, ON</div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="text-center">
                                <ul class="pagination">
                                    <li class="active"><span>1</span></li>
                                    <li><a title="Go to page 2" href="/testimonials?page=1">2</a></li>
                                    <li><a title="Go to page 3" href="/testimonials?page=2">3</a></li>
                                    <li><a title="Go to page 4" href="/testimonials?page=3">4</a></li>
                                    <li class="next"><a title="Go to next page" href="/testimonials?page=1">next ›</a></li>
                                    <li class="pager-last"><a title="Go to last page" href="/testimonials?page=3">last »</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('public.pages.partials.main-content-end')

    @include('public.pages.partials.footer')

@endsection
