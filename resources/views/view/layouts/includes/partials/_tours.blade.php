@foreach($tours as $tour)
    @if($tour->getTranslation("title", app()->getLocale()))
        <div class="col-lg-4 col-md-6 wow zoomIn" data-wow-delay="0.1s">
            <div class="tour_container">
                @if($tour->is_popular)
                    <div class="ribbon_3 popular"><span>Popular</span></div>
                @elseif($tour->is_top_rated)
                    <div class="ribbon_3"><span>Top rated</span></div>
                @endif
                <div class="img_container">
                    <a href="{{route('view.tours.view', ['id' => $tour->id, 'slug' => \Illuminate\Support\Str::slug($tour->title)])}}">
                        <img src="{{ getImage($tour->img) }}" width="800" height="533" class="img-fluid" alt="{{ $tour->title }}">
                        @if($tour->discount)
                            <div class="badge_save">Save<strong>{{ $tour->discount }}%</strong></div>
                        @endif
                        <div class="short_info">
                            <i class="{{ $tour->icon }}"></i>{{ $tour->category }}<span class="price"><sup>$</sup>{{ $tour->price }}</span>
                        </div>
                    </a>
                </div>
                <div class="tour_title">
                    <h3><strong>{{ $tour->getTranslation("title", app()->getLocale()) }}</strong></h3>
                </div>
            </div>
        </div>
    @endif
@endforeach
