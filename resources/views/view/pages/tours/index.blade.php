@extends('view.layouts.app')
@section('content')
    <section class="parallax-window" data-parallax="scroll" data-image-src="img/parallax_bg_1.jpg" data-natural-width="1400" data-natural-height="470">
        <div class="parallax-content-1 opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.6)">
            <div class="animated fadeInDown">
                <h1>{{__("Tours page title")}}</h1>
                <p>{{__("Tours page sub title")}}</p>
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
                    <li><a >{{__("Tours")}}</a>
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

                <div class="">

                    <div id="tools">
                        <div class="row justify-content-between">
                            <div class="col-md-3 col-sm-4">
                                <div class="styled-select-filters">
                                    <select name="sort_price" id="sort_price">
                                        <option value="" {{ request('sort') == '' ? 'selected' : '' }}>{{ __("Sort by price") }}</option>
                                        <option value="lower" {{ request('sort') == 'price' && request('order') == 'asc' ? 'selected' : '' }}>{{ __("Lowest price") }}</option>
                                        <option value="higher" {{ request('sort') == 'price' && request('order') == 'desc' ? 'selected' : '' }}>{{ __("Highest price") }}</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!--End tools -->

                    <div class="cardGrid">
                        @include('view.layouts.includes.partials._tours')
                    </div>




                    @include('view.layouts.includes.partials._pagination', ['paginator' => $tours])

                    <!-- end pagination-->

                </div>
                <!-- End col lg 9 -->
            </div>
            <!-- End row -->
        </div>
        <!-- End container -->
    </main>
    <!-- End main -->
@endsection

@push('styles')
<style>
.card_description {
    color: #666;
    font-size: 14px;
    line-height: 1.4;
    margin-top: 8px;
    margin-bottom: 0;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const sortSelect = document.getElementById('sort_price');
    
    if (sortSelect) {
        sortSelect.addEventListener('change', function() {
            const selectedValue = this.value;
            let sortBy = 'datetime';
            let order = 'asc';
            
            if (selectedValue === 'lower') {
                sortBy = 'price';
                order = 'asc';
            } else if (selectedValue === 'higher') {
                sortBy = 'price';
                order = 'desc';
            }
            
            // Update URL with sort parameters
            const url = new URL(window.location);
            url.searchParams.set('sort', sortBy);
            url.searchParams.set('order', order);
            
            // Reload page with new parameters
            window.location.href = url.toString();
        });
    }
});
</script>
@endpush
