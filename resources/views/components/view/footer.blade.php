<footer class="revealed">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <h3>{{__("Need help?")}}</h3>
                <a href="tel:{{ preg_replace('/\D/', '', $companyInfo->phone) }}" id="phone">{{ $companyInfo->phone }}</a>
                <a href="mailto:{{ $companyInfo->email }}" id="email_footer">{{ $companyInfo->email }}</a>
                <div>
                    <img src="{{asset("assets/view/img/payments.png")}}" width="231" height="30" alt="Image" class="img-fluid">
                </div>
            </div>
            <div class="col-md-5">
                <h3>{{__("Links")}}</h3>
                <ul>
                    <li>
                        <a href="{{route("view.home")}}"> {{__("Home")}} </a>
                    </li>
                    <li>
                        <a href="{{route("view.tours")}}" class="show-submenu">{{__("Tours")}}</a>
                    </li>

                    <li>
                        <a href="{{route("view.transfers")}}" class="show-submenu">{{__("Tranfers")}}</a>
                    </li>

                    <li>
                        <a href="{{route("view.contact")}}" class="show-submenu">{{__("Contact")}}</a>
                    </li>

                    <li>
                        <a href="{{route("view.privacy_policy")}}" class="show-submenu">{{__("Privacy policy")}}</a>
                    </li>
                    <li>
                        <a href="{{route("view.terms_of_use")}}" class="show-submenu">{{__("Terms of use")}}</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-2">
                <h3>{{__("Languages")}}</h3>
                <div class="styled-select">
                    @foreach($languages as $language)
                    <a hreflang="{{ $language->lang_code }}" href="{{ LaravelLocalization::getLocalizedURL($language->lang_code, null, [], true) }}" style="color: inherit; text-decoration: none;">
                        {{ strtoupper($language->lang_code) }}
                    </a>
                    @if (!$loop->last)
                    -
                    @endif
                    @endforeach
                </div>
            </div>
        </div><!-- End row -->
        <div class="row">
            <div class="col-md-12">
                <div id="social_footer">
                    <ul>
                        @if(!empty($companyInfo->instagram))
                            <li><a href="{{ $companyInfo->instagram }}" target="_blank"><i class="bi bi-instagram"></i></a></li>
                        @endif
                        @if(!empty($companyInfo->whatsapp_phone))
                            <li><a href="https://wa.me/{{ preg_replace('/\D/', '', $companyInfo->whatsapp_phone) }}" target="_blank"><i class="bi bi-whatsapp"></i></a></li>
                        @endif
                        @if(!empty($companyInfo->facebook))
                            <li><a href="{{ $companyInfo->facebook }}" target="_blank"><i class="bi bi-facebook"></i></a></li>
                        @endif
                        @if(!empty($companyInfo->twitter))
                            <li><a href="{{ $companyInfo->twitter }}" target="_blank"><i class="bi bi-twitter-x"></i></a></li>
                        @endif
                        @if(!empty($companyInfo->youtube))
                            <li><a href="{{ $companyInfo->youtube }}" target="_blank"><i class="bi bi-youtube"></i></a></li>
                        @endif
                    </ul>

                    <p>© {{ $companyInfo->getTranslation('copyright_text', app()->getLocale()) }} {{ now()->year }}</p>
                </div>
            </div>
        </div><!-- End row -->
    </div><!-- End container -->
</footer><!-- End footer -->
