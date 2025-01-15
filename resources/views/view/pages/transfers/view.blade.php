@extends('view.layouts.app')
@section('content')
    <section class="parallax-window" data-parallax="scroll" data-image-src="img/transfer_top.jpg" data-natural-width="1400" data-natural-height="470">
        <div class="parallax-content-2">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <h1>Orly Airport</h1>
                        <span>Champ de Mars, 5 Avenue Anatole, 75007 Paris.</span>
                    </div>
                    <div class="col-md-4">
                        <div id="price_single_main">
                            from/per person <span><sup>$</sup>52</span>
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
                    <li><a href="#">Home</a>
                    </li>
                    <li><a href="#">Category</a>
                    </li>
                    <li>Page active</li>
                </ul>
            </div>
        </div>
        <!-- End Position -->

        <div class="container margin_60">
            <div class="row">
                <div class="col-lg-8" id="single_tour_desc">

                    <div id="single_tour_feat">
                        <ul>
                            <li><i class="icon_set_1_icon-29"></i>Up to 6 passengers</li>
                            <li><i class="icon_set_1_icon-6"></i>Hotel Pick up</li>
                            <li><i class="icon_set_1_icon-13"></i>Accessibiliy</li>
                            <li><i class="icon_set_1_icon-82"></i>144 Likes</li>
                            <li><i class="icon_set_1_icon-22"></i>Pet allowed</li>
                            <li><i class="icon_set_1_icon-33"></i>Large baggage</li>
                        </ul>
                    </div>

                    <div class="row">
                        <div class="col-lg-3">
                            <h3>Description</h3>
                        </div>
                        <div class="col-lg-9">
                            <p>
                                Lorem ipsum dolor sit amet, at omnes deseruisse pri. Quo aeterno legimus insolens ad. Sit cu detraxit constituam, an mel iudico constituto efficiendi. Eu ponderum mediocrem has, vitae adolescens in pro. Mea liber ridens inermis ei, mei legendos vulputate an, labitur tibique te qui.
                            </p>
                            <h4>What's include</h4>
                            <p>
                                Lorem ipsum dolor sit amet, at omnes deseruisse pri. Quo aeterno legimus insolens ad. Sit cu detraxit constituam, an mel iudico constituto efficiendi.
                            </p>
                            <div class="row">
                                <div class="col-md-6">
                                    <ul class="list_ok">
                                        <li>Lorem ipsum dolor sit amet</li>
                                        <li>No scripta electram necessitatibus sit</li>
                                        <li>Quidam percipitur instructior an eum</li>
                                        <li>Ut est saepe munere ceteros</li>
                                        <li>No scripta electram necessitatibus sit</li>
                                        <li>Quidam percipitur instructior an eum</li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <ul class="list_ok">
                                        <li>Lorem ipsum dolor sit amet</li>
                                        <li>No scripta electram necessitatibus sit</li>
                                        <li>Quidam percipitur instructior an eum</li>
                                        <li>No scripta electram necessitatibus sit</li>
                                    </ul>
                                </div>
                            </div>
                            <!-- End row  -->
                        </div>
                    </div>

                </div>
                <!--End  single_tour_desc-->

                <aside class="col-lg-4">
                    <div class="box_style_1 expose">
                        <h3 class="inner">- Booking -</h3>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label><i class="icon-calendar-7"></i> Date</label>
                                    <input class="date-pick form-control" type="text">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label><i class="icon-clock"></i> Time</label>
                                    <input class="time-pick form-control" value="12:00 AM" type="text">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Adults</label>
                                    <div class="numbers-row">
                                        <input type="text" value="1" id="adults" class="qty2 form-control" name="quantity">
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Children</label>
                                    <div class="numbers-row">
                                        <input type="text" value="0" id="children" class="qty2 form-control" name="quantity">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Pick up address</label>
                            <div class="styled-select-common">
                                <select id="address" name="address">
                                    <option value="Orly Airport" selected="">Orly Airport</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Drop off address</label>
                            <div class="styled-select-common">
                                <select id="address_2" name="addres_2">
                                    <option value="Gar du Nord Station">Gar du Nord Station</option>
                                    <option value="Place Concorde">Place Concorde</option>
                                    <option value="Hotel Rivoli">Hotel Rivoli</option>
                                </select>
                            </div>
                        </div>
                        <a class="btn_collapse" data-bs-toggle="collapse" href="#collapseForm" aria-expanded="false" aria-controls="collapseForm">
                            <i class="icon-plus-circled"></i>Return
                        </a> <small>(Optionally)</small>
                        <div class="collapse" id="collapseForm">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label><i class="icon-calendar-7"></i> Date</label>
                                        <input class="date-pick form-control" type="text">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label><i class=" icon-clock"></i> Time</label>
                                        <input class="time-pick form-control" value="12:00 AM" type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Adults</label>
                                        <div class="numbers-row">
                                            <input type="text" value="1" id="adults" class="qty2 form-control" name="quantity">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Children</label>
                                        <div class="numbers-row">
                                            <input type="text" value="0" id="children" class="qty2 form-control" name="quantity">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Pick up address</label>
                                <div class="styled-select-common">
                                    <select id="address_return" name="address_return">
                                        <option value="Gar du Nord Station" selected="">Gar du Nord Station</option>
                                        <option value="Place Concorde">Place Concorde</option>
                                        <option value="Hotel Rivoli">Hotel Rivoli</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Drop off address</label>
                                <div class="styled-select-common">
                                    <select id="address_return_2" name="address_return_2">
                                        <option value="Orly Airport" selected="">Orly Airport</option>
                                        <option value="Paris Central Station">Paris Central Station</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- End collapse form -->
                        <br>
                        <table class="table table_summary">
                            <tbody>
                            <tr>
                                <td>
                                    Adults
                                </td>
                                <td class="text-end">
                                    2
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Children
                                </td>
                                <td class="text-end">
                                    0
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Total amount
                                </td>
                                <td class="text-end">
                                    3x $52
                                </td>
                            </tr>
                            <tr class="total">
                                <td>
                                    Total cost
                                </td>
                                <td class="text-end">
                                    $154
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <a class="btn_full" href="cart_transfer.html">Book now</a>
                        <a class="btn_full_outline" href="#"><i class=" icon-heart"></i> Add to whislist</a>
                    </div>
                    <!--/box_style_1 -->

                    <div class="box_style_4">
                        <i class="icon_set_1_icon-90"></i>
                        <h4><span>Book</span> by phone</h4>
                        <a href="tel://004542344599" class="phone">+45 423 445 99</a>
                        <small>Monday to Friday 9.00am - 7.30pm</small>
                    </div>

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
