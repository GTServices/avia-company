@extends('view.layouts.app')
@section('content')
    <x-view.hero />
    <main>
        <div class="container margin_60">

            <div class="main_title">
                <h2>{!! __("Paris <span>Top</span> Tours") !!}</h2>
                <p>{{__("Tours_subtitle")}}</p>
            </div>

            <div class="row">
                @include('view.layouts.includes.partials._tours')
            </div>


            <p class="text-center nopadding mt-3">
                <a href="{{route('view.tours')}}" class="btn_1 medium"><i class="icon-eye-7"></i>{{__("View all tours")}} ({{$toursCount}}) </a>
            </p>
        </div><!-- End container -->

    </main>
    <!-- End main -->
@endsection
