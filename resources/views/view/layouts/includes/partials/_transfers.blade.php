@foreach($transfers as $transfer)
    <!--one List Start -->
    <div class="strip_all_tour_list wow fadeIn" data-wow-delay="0.1s">
        <div class="row">
            <div class="col-lg-4 col-md-4 position-relative">
                <div class="wishlist">
                    @if($transfer->in_wishlist)
                        <!-- Əgər wishlistdədirsə -->
                        <div class="wishlist_close">-</div>
                    @else
                        <!-- Əgər wishlistdə deyilsə -->
                        <a class="tooltip_flip tooltip-effect-1" href="javascript:void(0);">+<span class="tooltip-content-flip"><span class="tooltip-back">Add to wishlist</span></span></a>
                    @endif
                </div>
                <div class="img_list">
                    <a href="{{route("view.transfers.view", ['id' => $transfer->id, 'slug' => \Illuminate\Support\Str::slug($transfer->title)])}}">
                        <img src="{{ getImage($transfer->image) }}" alt="{{ $transfer->title }}">
                    </a>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="tour_list_desc">
                    <h3 class="mt-3"><strong>{{ $transfer->title }}</strong> tour</h3>
                    <p>{!! Str::limit($transfer->description, 100) !!}</p>
                </div>
            </div>
            <div class="col-lg-2 col-md-2">
                <div class="price_list">
                    <div>
                        <sup>$</sup>{{ $transfer->price }}<small>*{{__("Per person")}}</small>
                        <p><a href="" class="btn_1">{{__("Details")}}</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--one List END -->
@endforeach
