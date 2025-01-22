@extends('view.layouts.app')
@section('content')
    <section class="parallax-window" data-parallax="scroll" data-image-src="img/parallax_bg_1.jpg" data-natural-width="1400" data-natural-height="470">
        <div class="parallax-content-1 opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.6)">
            <div class="animated fadeInDown">
                <h1>{{__("Contact page title")}}</h1>
                <p>{{__("Contact page sub title")}}</p>
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
                    <li><a >{{__("Contact")}}</a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- End Position -->

        <div class="container margin_60">
            <div class="row">
                <div class="col-md-8">
                    <div class="form_title">
                        <h3><strong><i class="icon-pencil"></i></strong>{{__("Fill the form below")}}</h3>
                        <p>
                            {{__("Mussum ipsum cacilds, vidis litro abertis.")}}
                        </p>
                    </div>
                    <div class="step">

                        <div id="message-contact"></div>
                        <form method="post" action="assets/contact.php" id="contactform">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>{{__("First Name")}}</label>
                                        <input type="text" class="form-control" id="name_contact" name="name_contact" placeholder="{{__("Enter Name")}}">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>{{__("Last Name")}}</label>
                                        <input type="text" class="form-control" id="lastname_contact" name="lastname_contact" placeholder="{{__("Enter Last Name")}}">
                                    </div>
                                </div>
                            </div>
                            <!-- End row -->
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>{{__("Email")}}</label>
                                        <input type="email" id="email_contact" name="email_contact" class="form-control" placeholder="{{__("Enter Email")}}">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>{{__("Phone")}}</label>
                                        <input type="text" id="phone_contact" name="phone_contact" class="form-control" placeholder="{{__("Enter Phone number")}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>{{__("Message")}}</label>
                                        <textarea rows="5" id="message_contact" name="message_contact" class="form-control" placeholder="{{__("Write your message")}}" style="height:200px;"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">

                                    <input type="submit" value="Submit" class="btn_1" id="submit-contact">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- End col-md-8 -->

                <div class="col-md-4">
                    <div class="box_style_1">
                        <span class="tape"></span>
                        <h4>{{__("Address")}} <span><i class="icon-pin pull-right"></i></span></h4>
                        <p>
                            {!! $companyInfo->address !!}
                        </p>
                        <hr>

                        <ul id="contact-info">
                            @if(!empty($companyInfo->phone))
                                <li><a href="tel:{{ preg_replace('/[\s-]/', '', $companyInfo->phone) }}">{{ $companyInfo->phone }}</a></li>
                            @endif
                            @if(!empty($companyInfo->phone_2))
                                <li><a href="tel:{{ preg_replace('/[\s-]/', '', $companyInfo->phone_2) }}">{{ $companyInfo->phone_2 }}</a></li>
                            @endif
                            <li><a href="mailto:{{$companyInfo->email}}">{{$companyInfo->email}}</a>
                            </li>
                        </ul>
                    </div>
                    @include('view.layouts.includes.partials._info_center')
                </div>
                <!-- End col-md-4 -->
            </div>
            <!-- End row -->
        </div>
        <!-- End container -->

        <div id="map_contact">
            {!! $companyInfo->map !!}
        </div>
        <!-- end map-->

    </main>
    <!-- End main -->
@endsection
