@extends('layouts.public-master')

@section('main-content')

    @include('public.pages.partials.content-top')

    @php
    $title = __('PUERTO VALLARTA HISTORY');
    @endphp

    @include('public.pages.partials.main-content-start')

    <div class="panel-display panel-1col clearfix">
        <div class="panel-panel panel-col">
            <div>
                <div class="panel-pane pane-custom pane-1">
                    <div class="pane-content">
                        <div class="pv-history">
                            <p><img src="http://palmeravacations.com/sites/default/files/images/puerto-vallarta-1.jpg"
                                    class="pull-right">Puerto Vallarta was not originally created for modern tourism. Puerto
                                Vallarta enjoys a definite history of its own. The original population, as recent
                                discoveries and archeological studies show, was of various tribes of Aztec Indians. They
                                developed cultural and commercial relations along the Pacific coast. Puerto Vallarta was
                                part of the pre-Columbian indigenous kingdom of Xalisco. The ancient people took advantage
                                of the fertile lands of the Valley of Banderas. The sea was overlooked as the main resource.
                                Even today, Puerto Vallarta is not a bustling shipping port. Puerto Vallarta's port
                                facilities serve only cruise ships and recreational craft.</p>

                            <p>The Bahía de Banderas (Bay of Banderas) and the Valle de Banderas (Valley of Banderas) were
                                named by the Spanish when Hernan Cortez's nephew was traveling in this area. He encountered
                                several native warriors with banners and outfits made of colorful bird feathers. The
                                Spaniards had flags with the Spanish Herald and the Virgin Mary apparently shone the metal
                                with the sunlight and the reflection drove them off. The town that is now Puerto Vallarta
                                first began when the enterprising Guadalupe Sanchez established a trading post on the banks
                                of Rio Cuale to supply salt to the gold and silver mines in the mountains toward
                                Guadalajara. The ore was loaded into ships waiting in the bay. The three offshore rock
                                formations south of town were navigational landmarks from earlier times. The original name
                                of the early municipality was Puerto de las Peñas, named for the prominent rocks. Puerto
                                Vallarta was named after Don Ignacio Luis Vallarta a well-known governor of the State of
                                Jalisco.</p>

                            <p><img src="http://palmeravacations.com/sites/default/files/images/puerto-vallarta-3.jpg"
                                    class="pull-left">The Spanish expeditions started in the beginning of the 15th Century
                                in the Sierra Madre Occidental Mountains that surround the Valley of Banderas. They
                                discovered mines that were exploited later in the century. The mineral was moved by mules
                                and donkeys ashore, to be transported to Spain. The town began to grow peacefully; the
                                people started fishing as a way of living. Slowly the area changed from a small ranch to a
                                small very attractive town.</p>

                            <p>In 1918, a U.S. company, The Montgomery Corporation, was established in the north of Vallarta
                                with a big banana plantation mainly for exportation. The area grew very quickly. The Company
                                produced pre-built houses and a railroad to easily bring the product from the farm to the
                                coast. Punta Mita, the northern point of the Bay, was known for its oysters and pearls found
                                in that area.</p>

                            <p>Puerto Vallarta has been somewhat isolated by the surrounding Sierra Madre mountains and the
                                lack of bridges over the rivers. There were no direct roads leading to the town until 1966
                                when the land around was leveled for building an international airport. By 1970 Puerto
                                Vallarta was fully accessible by land, sea and air and Puerto Vallarta began to shape into a
                                leading tourism destination.</p>

                            <p><img src="http://palmeravacations.com/sites/default/files/images/puerto-vallarta-2.jpg"
                                    class="pull-right">Today Vallarta has grown as a modern city with more than 15,000
                                occupations. It has been modernized but at the same time has kept the old Mexican flavor
                                intact. Natural beauty is well preserved and there are many projects going on to maintain
                                the beauty of the surroundings. Puerto Vallarta has many attractive things to offer. You
                                will find mountains, forests, rivers, and history, but the best thing is the warmth and
                                kindness of the people.</p>

                            <p>Puerto Vallarta was known as "Puerto Las Peñas" from 1851 until 1918 when it was designated
                                as a municipality and received the official name of "Puerto Vallarta". This was the name
                                chosen in honor of Don Ignacio L. Vallarta, a reputable representative of the State of
                                Jalisco at the time. For 30 years this small village remained a fishing village.</p>

                            <p>International attention was first drawn to Puerto Vallarta after American director John
                                Huston discovered the natural beauties of the town by reading written descriptions from
                                travelers. This prompted Mr. Huston to visit Puerto Vallarta and the result was the filming
                                of the movie "Night of the Iguana" in nearby Mismaloya. The film featured Richard Burton,
                                Ava Gardner and Deborah Kerr.</p>

                            <p>Puerto Vallarta has experienced massive growth in the northern part of town, including the
                                Marina Vallarta and Nuevo Vallarta areas. Tennis courts, health clubs, golf courses and a
                                large marina with up-to-date facilities make Puerto Vallarta a truly world class
                                destination.</p>

                            <p>As Mexico's largest bay, Puerto Vallarta is perfectly positioned in its center and is one of
                                the most beautiful bays in the world. We've certainly come a long way from a sleepy little
                                fishing village. Puerto Vallarta was destined to become a highly desirable international
                                resort with some 3,700,000 tourists visiting last year alone.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('public.pages.partials.main-content-end')

    @include('public.pages.partials.footer')

@endsection
