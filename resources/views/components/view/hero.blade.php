<section id="search_container">
    <div id="search">
        <ul class="nav nav-tabs">
            <li><a href="#tours" data-bs-toggle="tab" class="active show">{{__("Tours")}}</a></li>
            {{-- <li><a href="#transfers" data-bs-toggle="tab">{{__("Transfers")}}</a></li> --}}
        </ul>

        <div class="tab-content">
            <div class="tab-pane active show" id="tours">
                <h3>{{__("Search Tours in Paris")}}</h3>
                <form method="GET" action="{{ route('view.tours') }}">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{__("Search terms")}}</label>
                                <input type="text" class="form-control" name="search" placeholder="{{__('Type your search terms')}}" value="{{ request('search') }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{__("Date Range")}}</label>
                                <input type="text" class="form-control date-range-picker" id="date_range" name="date_range" placeholder="{{__('Select date range')}}" readonly value="{{ request('date_range') }}">
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-md-6">
                        <div class="form-group">
                            <label>Things to do</label>
                            <select class="ddslick" name="category">
                                <option value="0" data-imagesrc="img/icons_search/all_tours.png" selected="">All tours</option>
                                <option value="1" data-imagesrc="img/icons_search/sightseeing.png">City sightseeing</option>
                                <option value="2" data-imagesrc="img/icons_search/museums.png">Museum tours</option>
                                <option value="3" data-imagesrc="img/icons_search/historic.png">Historic Buildings</option>
                                <option value="4" data-imagesrc="img/icons_search/walking.png">Walking tours</option>
                                <option value="5" data-imagesrc="img/icons_search/eat.png">Eat & Drink</option>
                                <option value="6" data-imagesrc="img/icons_search/churches.png">Churces</option>
                                <option value="7" data-imagesrc="img/icons_search/skyline.png">Skyline tours</option>
                            </select>
                        </div>
                    </div> --}}
                </div>
                <!-- End row -->
                {{-- <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label><i class="icon-calendar-7"></i> Date</label>
                            <input class="date-pick form-control" type="text">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label><i class=" icon-clock"></i> Time</label>
                            <input class="time-pick form-control" value="12:00 AM" type="text">
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-3 col-6">
                        <div class="form-group">
                            <label>Adults</label>
                            <div class="numbers-row">
                                <input type="text" value="1" id="adults" class="qty2 form-control" name="adults">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-3 col-6">
                        <div class="form-group">
                            <label>Children</label>
                            <div class="numbers-row">
                                <input type="text" value="0" id="children" class="qty2 form-control" name="children">
                            </div>
                        </div>
                    </div>

                </div> --}}
                <!-- End row -->
                <hr>
                <button class="btn_1 green"><i class="icon-search"></i>{{__("Search now")}}</button>
            </div>
            <!-- End rab -->

            {{-- <div class="tab-pane" id="transfers">
                <h3>Search Transfers in Paris</h3>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="select-label">Pick up location</label>
                            <div class="styled-select-common">
                                <select>
                                    <option value="orly_airport">Orly airport</option>
                                    <option value="gar_du_nord">Gar du Nord Station</option>
                                    <option value="hotel_rivoli">Hotel Rivoli</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="select-label">Drop off location</label>
                            <div class="styled-select-common">
                                <select>
                                    <option value="orly_airport">Orly airport</option>
                                    <option value="gar_du_nord">Gar du Nord Station</option>
                                    <option value="hotel_rivoli">Hotel Rivoli</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End row -->
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label><i class="icon-calendar-7"></i> Date</label>
                            <input class="date-pick form-control" type="text">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label><i class=" icon-clock"></i> Time</label>
                            <input class="time-pick form-control" value="12:00 AM" type="text">
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-3">
                        <div class="form-group">
                            <label>Adults</label>
                            <div class="numbers-row">
                                <input type="text" value="1" id="adults" class="qty2 form-control" name="quantity">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-9">
                        <div class="form-group">
                            <div class="radio_fix me-3">
                                <label class="container_radio">
                                    <input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option1">One Way
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="radio_fix">
                                <label class="container_radio">
                                    <input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">Return
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    </div>
                    <!-- End row -->
                    <hr>
                    <button type="submit" class="btn_1 green"><i class="icon-search"></i>Search now</button>
                </form>
            </div> --}}

        </div>
    </div>
</section>
<!-- End hero -->

@push('styles')
<style>
#search_container .form-group {
    margin-bottom: 15px;
}

#search_container .row {
    margin-bottom: 20px;
}

#search_container .btn_1 {
    margin-top: 10px;
}
</style>
@endpush

@push('scripts')
<script>
$(document).ready(function() {
    // Initialize date range picker
    $('.date-range-picker').daterangepicker({
        autoUpdateInput: false,
        locale: {
            cancelLabel: 'Clear',
            format: 'MM/DD/YYYY'
        }
    });

    $('.date-range-picker').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
    });

    $('.date-range-picker').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
    });
});
</script>
@endpush
