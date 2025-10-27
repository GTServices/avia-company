@extends('view.layouts.app')
@section('content')

    <section class="parallax-window" data-parallax="scroll" data-image-src="img/single_tour_bg_1.jpg" data-natural-width="1400" data-natural-height="470">
        <div class="parallax-content-2">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <h1>{{$tour->title}}</h1>
                    </div>
                    <div class="col-md-4">
                        <div id="price_single_main">
                            <span><sup>$</sup>{{$tour->price}}</span>
                        </div>
                    </div>
                </div>
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
                    <li><a href="{{route("view.tours")}}">{{__("Tours")}}</a>
                    </li>
                    <li><a >{{$tour->title}}</a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- End Position -->

        <div class="container margin_60">
            <div class="row">
                <div class="col-lg-8" id="single_tour_desc">

                    <div class="row">
                        {!! $tour->desc !!}
                    </div>

                </div>
                <!--End  single_tour_desc-->

                <aside class="col-lg-4">
                    <div class="box_style_1 expose">
                        <h3 class="inner">- {{__("Booking")}} -</h3>
                        
                        @if($tour->datetime)
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label><i class="icon-calendar-7"></i> {{__("Date")}}</label>
                                    <input class="form-control" type="text" value="{{ \Carbon\Carbon::parse($tour->datetime)->format('d.m.Y') }}" readonly>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label><i class=" icon-clock"></i> {{__("Time")}}</label>
                                    <input class="form-control" type="text" value="{{ \Carbon\Carbon::parse($tour->datetime)->format('H:i') }}" readonly>
                                </div>
                            </div>
                        </div>
                        @endif
                        
                        <a class="btn_full" href="cart.html">{{__("Book now")}}</a>
                    </div>
                    <!--/box_style_1 -->

                    {{-- @include('view.layouts.includes.partials._info_center') --}}
                </aside>
            </div>
            <!--End row -->
        </div>
        <!--End container -->

        <div id="overlay"></div>
        <!-- Mask on input focus -->

    </main>
    <!-- End main -->
@endsection
