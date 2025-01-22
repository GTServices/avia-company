@extends('view.layouts.app')
@section('content')

    <section class="parallax-window" data-parallax="scroll" data-image-src="img/parallax_bg_1.jpg" data-natural-width="1400" data-natural-height="470">
        <div class="parallax-content-1 opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.6)">
            <div class="animated fadeInDown">
                <h1>{{__("Transfers page title")}}</h1>
                <p>{{__("Transfers page sub title")}}</p>
            </div>
        </div>
    </section>
    <!-- End section -->

    <main>

        <div id="position">
            <div class="container">
                <ul>
                    <li><a href="{{route("view.home")}}">{{__("Home")}}</a>
                    </li>
                    <li><a >{{__("Transfers")}}</a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- Position -->

        <div class="collapse" id="collapseMap">
            <div id="map" class="map"></div>
        </div>
        <!-- End Map -->


        <div class="container margin_60">

            <div class="row">

                <div class="col-lg-9 marginCenter">

                    <div id="tools">
                        <div class="row justify-content-between">
                            <div class="col-md-3 col-sm-4">
                                <div class="styled-select-filters">
                                    <select name="sort_price" id="sort_price">
                                        <option value="" selected="">{{ __("Sort by price") }}</option>
                                        <option value="lower">{{ __("Lowest price") }}</option>
                                        <option value="higher">{{ __("Highest price") }}</option>

                                    </select>
                                </div>
                            </div>


                        </div>
                    </div>
                    <!--/tools -->

                    @include('view.layouts.includes.partials._transfers')




                    @include('view.layouts.includes.partials._pagination', ['paginator' => $transfers])
                    <!-- end pagination-->

                </div>
                <!-- End col lg-9 -->
            </div>
            <!-- End row -->
        </div>
        <!-- End container -->
    </main>
    <!-- End main -->
@endsection
