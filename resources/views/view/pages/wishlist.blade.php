@extends('view.layouts.app')
@section('content')
    <section class="parallax-window" data-parallax="scroll" data-image-src="img/header_bg.jpg" data-natural-width="1400" data-natural-height="470">
        <div class="parallax-content-1 opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.6)">
            <div class="animated fadeInDown">
                <h1>{{__("Wishlist page title")}}</h1>
                <p>{{__("Wishlist page subtitle")}}</p>
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
                    <li><a >{{__("Wishlist")}}</a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- Position -->


        <div class="container margin_60">

            <div class="row">

                <!--End aside -->
                <div class="col-lg-12">
                    <div class="strip_all_tour_list wow fadeIn" data-wow-delay="0.1s">
                        <div class="row">
                            <div class="col-lg-4 col-md-4 position-relative">
                                <div class="wishlist_close">-</div>
                                <div class="img_list">
                                    <a href="single_tour.html">
                                        <div class="ribbon popular"></div><img src="img/tour_box_1.jpg" alt="Image">
                                        <div class="short_info"><i class="icon_set_1_icon-4"></i>Museums </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="tour_list_desc">
                                    <div class="rating"><i class="icon-smile voted"></i><i class="icon-smile  voted"></i><i class="icon-smile  voted"></i><i class="icon-smile  voted"></i><i class="icon-smile"></i><small>(75)</small>
                                    </div>
                                    <h3><strong>Arch Triomphe</strong> tour</h3>
                                    <p>Lorem ipsum dolor sit amet, quem convenire interesset ut vix, ad dicat sanctus detracto vis. Eos modus dolorum ex, qui adipisci maiestatis inciderint no, eos in elit dicat.....</p>
                                    <ul class="add_info">
                                        <li>
                                            <div class="tooltip_styled tooltip-effect-4">
                                                <span class="tooltip-item"><i class="icon_set_1_icon-83"></i></span>
                                                <div class="tooltip-content">
                                                    <h4>Schedule</h4>
                                                    <strong>Monday to Friday</strong> 09.00 AM - 5.30 PM
                                                    <br>
                                                    <strong>Saturday</strong> 09.00 AM - 5.30 PM
                                                    <br>
                                                    <strong>Sunday</strong> <span class="label label-danger">Closed</span>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="tooltip_styled tooltip-effect-4">
                                                <span class="tooltip-item"><i class="icon_set_1_icon-41"></i></span>
                                                <div class="tooltip-content">
                                                    <h4>Address</h4> Musée du Louvre, 75058 Paris - France
                                                    <br>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="tooltip_styled tooltip-effect-4">
                                                <span class="tooltip-item"><i class="icon_set_1_icon-97"></i></span>
                                                <div class="tooltip-content">
                                                    <h4>Languages</h4> English - French - Chinese - Russian - Italian
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="tooltip_styled tooltip-effect-4">
                                                <span class="tooltip-item"><i class="icon_set_1_icon-27"></i></span>
                                                <div class="tooltip-content">
                                                    <h4>Parking</h4> 1-3 Rue Elisée Reclus
                                                    <br> 76 Rue du Général Leclerc
                                                    <br> 8 Rue Caillaux 94923
                                                    <br>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="tooltip_styled tooltip-effect-4">
                                                <span class="tooltip-item"><i class="icon_set_1_icon-25"></i></span>
                                                <div class="tooltip-content">
                                                    <h4>Transport</h4>
                                                    <strong>Metro: </strong>Musée du Louvre station (line 1)
                                                    <br>
                                                    <strong>Bus:</strong> 21, 24, 27, 39, 48, 68, 69, 72, 81, 95
                                                    <br>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2">
                                <div class="price_list">
                                    <div><sup>$</sup>39*<span class="normal_price_list">$99</span><small>*Per person</small>
                                        <p><a href="single_tour.html" class="btn_1">Details</a>
                                        </p>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!--End strip -->

                    <div class="strip_all_tour_list wow fadeIn" data-wow-delay="0.1s">
                        <div class="row">
                            <div class="col-lg-4 col-md-4 position-relative">
                                <div class="wishlist_close">-</div>
                                <div class="img_list">
                                    <a href="single_hotel.html">
                                        <div class="ribbon top_rated"></div><img src="img/hotel_2.jpg" alt="Image">
                                        <div class="short_info"><i class="icon_set_1_icon-6"></i>Hotel</div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="tour_list_desc">
                                    <div class="score">Superb<span>9.0</span>
                                    </div>
                                    <div class="rating"><i class="icon-star voted"></i><i class="icon-star  voted"></i><i class="icon-star  voted"></i><i class="icon-star  voted"></i><i class="icon-star-empty"></i>
                                    </div>
                                    <h3><strong>Hotel</strong> Mariott</h3>
                                    <p>Lorem ipsum dolor sit amet, quem convenire interesset ut vix, ad dicat sanctus detracto vis. Eos modus dolorum...</p>
                                    <ul class="add_info">
                                        <li>
                                            <a href="javascript:void(0);" class="tooltip-1" data-bs-placement="top" title="Free Wifi"><i class="icon_set_1_icon-86"></i></a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" class="tooltip-1" data-bs-placement="top" title="Plasma TV with cable channels"><i class="icon_set_2_icon-116"></i></a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" class="tooltip-1" data-bs-placement="top" title="Swimming pool"><i class="icon_set_2_icon-110"></i></a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" class="tooltip-1" data-bs-placement="top" title="Fitness Center"><i class="icon_set_2_icon-117"></i></a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" class="tooltip-1" data-bs-placement="top" title="Restaurant"><i class="icon_set_1_icon-58"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2">
                                <div class="price_list">
                                    <div><sup>$</sup>39*<span class="normal_price_list">$99</span><small>*From/Per night</small>
                                        <p><a href="single_hotel.html" class="btn_1">Details</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--End strip -->

                    <div class="strip_all_tour_list wow fadeIn" data-wow-delay="0.1s">
                        <div class="row">
                            <div class="col-lg-4 col-md-4 position-relative">
                                <div class="wishlist_close">-</div>
                                <div class="img_list">
                                    <a href="single_transfer.html">
                                        <div class="ribbon top_rated"></div><img src="img/transfer_3.jpg" alt="Image">
                                    </a>
                                    <div class="short_info"><i class="icon_set_1_icon-26"></i>Transfer</div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="tour_list_desc">
                                    <div class="rating"><i class="icon-smile voted"></i><i class="icon-smile  voted"></i><i class="icon-smile  voted"></i><i class="icon-smile  voted"></i><i class="icon-smile"></i><small>(75)</small>
                                    </div>
                                    <h3><strong>Orly Airport</strong> group</h3>
                                    <p>Lorem ipsum dolor sit amet, quem convenire interesset ut vix, ad dicat sanctus detracto vis. Eos modus dolorum ex, qui adipisci maiestatis inciderint no, eos in elit dicat.....</p>
                                    <ul class="add_info">
                                        <li>
                                            <div class="tooltip_styled tooltip-effect-4">
                                                <span class="tooltip-item"><i class="icon_set_1_icon-70"></i></span>
                                                <div class="tooltip-content">
                                                    <h4>Passengers</h4> Up to 40 passengers.
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="tooltip_styled tooltip-effect-4">
                                                <span class="tooltip-item"><i class="icon_set_1_icon-6"></i></span>
                                                <div class="tooltip-content">
                                                    <h4>Pick up</h4> Hotel pick up or different place with an extra cost.
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="tooltip_styled tooltip-effect-4">
                                                <span class="tooltip-item"><i class="icon_set_1_icon-13"></i></span>
                                                <div class="tooltip-content">
                                                    <h4>Accessibility</h4> On request accessibility available.
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="tooltip_styled tooltip-effect-4">
                                                <span class="tooltip-item"><i class="icon_set_1_icon-22"></i></span>
                                                <div class="tooltip-content">
                                                    <h4>Pet allowed</h4> On request pet allowed.
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="tooltip_styled tooltip-effect-4">
                                                <span class="tooltip-item"><i class="icon_set_1_icon-33"></i></span>
                                                <div class="tooltip-content">
                                                    <h4>Baggage</h4> Large baggage drop available.
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2">
                                <div class="price_list">
                                    <div><sup>$</sup>39*<span class="normal_price_list">$99</span><small>*From/Per person</small>
                                        <p><a href="single_transfer.html" class="btn_1">Details</a>
                                        </p>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!--End strip -->

                    <div class="strip_all_tour_list wow fadeIn" data-wow-delay="0.7s">
                        <div class="row">
                            <div class="col-lg-4 col-md-4 position-relative">
                                <div class="wishlist_close">-</div>
                                <div class="img_list">
                                    <a href="single_tour.html">
                                        <div class="ribbon top_rated"></div><img src="img/tour_box_5.jpg" alt="Image">
                                        <div class="short_info"><i class="icon_set_1_icon-44"></i>Historic Building</div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="tour_list_desc">
                                    <div class="rating"><i class="icon-smile voted"></i><i class="icon-smile  voted"></i><i class="icon-smile  voted"></i><i class="icon-smile  voted"></i><i class="icon-smile"></i><small>(75)</small>
                                    </div>
                                    <h3><strong>Pantheon</strong> tour</h3>
                                    <p>Lorem ipsum dolor sit amet, quem convenire interesset ut vix, ad dicat sanctus detracto vis. Eos modus dolorum ex, qui adipisci maiestatis inciderint no, eos in elit dicat.....</p>
                                    <ul class="add_info">
                                        <li>
                                            <div class="tooltip_styled tooltip-effect-4">
                                                <span class="tooltip-item"><i class="icon_set_1_icon-83"></i></span>
                                                <div class="tooltip-content">
                                                    <h4>Schedule</h4>
                                                    <strong>Monday to Friday</strong> 09.00 AM - 5.30 PM
                                                    <br>
                                                    <strong>Saturday</strong> 09.00 AM - 5.30 PM
                                                    <br>
                                                    <strong>Sunday</strong> <span class="label label-danger">Closed</span>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="tooltip_styled tooltip-effect-4">
                                                <span class="tooltip-item"><i class="icon_set_1_icon-41"></i></span>
                                                <div class="tooltip-content">
                                                    <h4>Address</h4> Musée du Louvre, 75058 Paris - France
                                                    <br>
                                                    <a href="#">View on map</a>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="tooltip_styled tooltip-effect-4">
                                                <span class="tooltip-item"><i class="icon_set_1_icon-97"></i></span>
                                                <div class="tooltip-content">
                                                    <h4>Languages</h4> English - French - Chinese - Russian - Italian
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="tooltip_styled tooltip-effect-4">
                                                <span class="tooltip-item"><i class="icon_set_1_icon-27"></i></span>
                                                <div class="tooltip-content">
                                                    <h4>Parking</h4> 1-3 Rue Elisée Reclus
                                                    <br> 76 Rue du Général Leclerc
                                                    <br> 8 Rue Caillaux 94923
                                                    <br>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="tooltip_styled tooltip-effect-4">
                                                <span class="tooltip-item"><i class="icon_set_1_icon-25"></i></span>
                                                <div class="tooltip-content">
                                                    <h4>Transport</h4>
                                                    <strong>Metro: </strong>Musée du Louvre station (line 1)
                                                    <br>
                                                    <strong>Bus:</strong> 21, 24, 27, 39, 48, 68, 69, 72, 81, 95
                                                    <br>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2">
                                <div class="price_list">
                                    <div><sup>$</sup>49*<span class="normal_price_list">$59</span><small>*Per person</small>
                                        <p><a href="single_tour.html" class="btn_1">Details</a>
                                        </p>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!--End strip -->

                    <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-center">
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                    <span class="sr-only">Previous</span>
                                </a>
                            </li>
                            <li class="page-item active"><span class="page-link">1</span>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
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
