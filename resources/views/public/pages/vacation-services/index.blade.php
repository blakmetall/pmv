@extends('layouts.public-master')

@section('main-content')

    @include('public.pages.partials.content-top')

    @php
    $title = __('Vacation Services');
    @endphp

    @include('public.pages.partials.main-content-start')

    <div class="panel-display panel-1col clearfix">
        <div class="panel-panel panel-col">
            <div>
                <div class="panel-pane pane-custom pane-1">

                    <div class="pane-content">
                        <p>Let us make your perfect Getaway in Puerto Vallarta, Nuevo Vallarta, Riviera
                            Nayarit and Mazatlán, México!</p>
                        <p>We focus on providing accommodations tailored to meet your specific needs,
                            our vacation rental professionals are committed to setting the standard and
                            exceeding the expectations of today's traveler.</p>
                        <p>If you're looking to rent an apartment, condominium, villa or private estate;
                            whether it's oceanfront or right in the middle of the bustling nightlife,
                            Palmera Vacations will find the right accommodations to fit your needs.</p>
                        <p>Our innovative website leads you through easy, no-nonsense steps from start
                            to finish. Browse through our wide-range of vacation properties or even make
                            a reservation, book &amp; pay online! Don't see exactly what you're looking
                            for? Not to worry! We will find it through our extensive network of local
                            real estate partners, or if you find yourself in the neighborhood, come on
                            by our office!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('public.pages.partials.main-content-end')


    @include('public.pages.partials.footer')

@endsection
