@extends('view.layouts.app')
@section('content')
    <section class="parallax-window" data-parallax="scroll" data-image-src="img/header_bg.jpg" data-natural-width="1400" data-natural-height="470">
        <div class="parallax-content-1 opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.6)">
            <div class="animated fadeInDown">
                <h1>{{__("Terms of use page title")}}</h1>
                <p>{{__("Terms of use page subtitle")}}</p>
            </div>
        </div>
    </section>
    <!-- End Section -->

    <main>
        <div id="position">
            <div class="container">
                <ul>
                    <li><a href="{{route("view.home")}}">{{__("Home")}}</a>
                    </li>
                    <li><a >{{__("About")}}</a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- End Position -->

        <div class="container margin_60">

            <div class="main_title">
                <h2>{{__("Terms of use page section title")}}</h2>
                <p>{{__("Terms of use page section sub title")}}</p>
            </div>

            <div class="row">
                {!! $terms_of_use->rules !!}
            </div>

            <!-- End row -->
        </div>
        <!-- End container -->


    </main>
    <!-- End main -->
@endsection
