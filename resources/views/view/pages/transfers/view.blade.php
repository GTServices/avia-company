@extends('view.layouts.app')
@section('content')
    <section class="parallax-window" data-parallax="scroll" data-image-src="img/transfer_top.jpg" data-natural-width="1400" data-natural-height="470">
        <div class="parallax-content-2">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <h1>{{$transfer->title}}</h1>
                    </div>
                    <div class="col-md-4">
                        <div id="price_single_main">
                           <span><sup>$</sup>{{$transfer->price}}</span>
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
                    <li><a href="{{route("view.transfers")}}">{{__("Transfers")}}</a>
                    </li>
                    <li><a >{{$transfer->title}}</a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- End Position -->

        <div class="container margin_60">
            <div class="row">
                <div class="col-lg-8" id="single_tour_desc">



                    <div class="row">

                        <div class="col-lg-9">
                          {!! $transfer->description !!}
                        </div>
                    </div>

                </div>
                <!--End  single_tour_desc-->

                <aside class="col-lg-4">
                    <div class="box_style_1 expose">
                        <h3 class="inner">- {{__("Booking")}} -</h3>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label><i class="icon-calendar-7"></i> {{__("Date")}}</label>
                                    <input class="date-pick form-control" type="text">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label><i class="icon-clock"></i> {{__("Time")}}</label>
                                    <input class="time-pick form-control" value="12:00 AM" type="text">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>{{__("Nəfər")}}</label>
                                    <div class="numbers-row">
                                        <input type="text" value="1" id="adults" class="qty2 form-control" name="quantity">
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="form-group">
                            <label>{{__("Qalxış aeroportu")}}</label>
                            <div class="styled-select-common">
                                <select id="address" name="address">
                                    <option value="Orly Airport" selected="">Orly Airport</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>{{__("Eniş aeroportu")}}</label>
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
                                    {{__("Total amount")}}
                                </td>
                                <td class="text-end">
                                    3x $52
                                </td>
                            </tr>
                            <tr class="total">
                                <td>
                                    {{__("Total cost")}}
                                </td>
                                <td class="text-end">
                                    $154
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <a class="btn_full" href="cart_transfer.html">{{__("Book now")}}</a>
                        <a class="btn_full_outline" href="#"><i class=" icon-heart"></i> {{__("Add to whislist")}}</a>
                    </div>
                    <!--/box_style_1 -->

                 @include('view.layouts.includes.partials._info_center')
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
