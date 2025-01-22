<!-- Header================================================== -->
<header>
    <div id="top_line">
        <div class="container">
            <div class="row">
                <div class="col-6">
                    <i class="icon-phone"></i>
                    <strong>
                        <a style="color: white" href="tel:{{ preg_replace('/\D/', '', $companyInfo->phone) }}">
                            {{$companyInfo->phone}}
                        </a>
                    </strong>
                </div>

                <div class="col-6">
                    <ul id="top_links">
                        @if(Auth::check())
                        <li><a href="" id="user_link"><i style="font-size: 16px" class="fas fa-user-circle"></i> {{__("Profile")}}</a></li>
                        <li><a href="{{route("view.wishlist")}}" id="wishlist_link">{{__("Wishlist")}}</a></li>
                        <li>
                            <a href="javascript:void(0);" id="logout_link">
                                {{ __("Logout") }}
                            </a>
                        </li>
                        @else
                        <li><a href="#sign-in-dialog" id="access_link">{{__("Sign in")}}</a></li>

                        @endif
                        <li id="lang_top">
                            <i class="icon-globe-1"></i>
                            @foreach($languages as $language)
                            <a hreflang="{{ $language->lang_code }}" href="{{ LaravelLocalization::getLocalizedURL($language->lang_code, null, [], true) }}">
                                {{ strtoupper($language->lang_code) }}
                            </a>
                            @if (!$loop->last)
                            -
                            @endif
                            @endforeach
                        </li>

                    </ul>
                </div>
            </div><!-- End row -->
        </div><!-- End container-->
    </div><!-- End top line-->

    <div class=" container">
        <div class="row">
            <div class="col-3">
                <div id="logo_home">
                    <a style="width: 100px; display: block" href="{{route("view.home")}}" title="Avia company">
                        <img style="width: 100%;" src="{{getImage($companyInfo->image)}}">
                    </a>
                </div>
            </div>
            <nav class="col-9">
                <a class="cmn-toggle-switch cmn-toggle-switch__htx open_close" href="javascript:void(0);"><span>Menu mobile</span></a>
                <div class="main-menu">
                    <div id="header_menu">
                        <img src="{{getImage($companyInfo->image)}}" width="160" height="54" alt="Avia company">
                    </div>
                    <a href="#" class="open_close" id="close_in"><i class="icon_set_1_icon-77"></i></a>
                    <ul>
                        <li>
                            <a href="{{route("view.home")}}"> {{__("Home")}} </a>
                        </li>
                        <li>
                            <a href="{{route("view.about")}}"> {{__("About")}} </a>
                        </li>
                        <li>
                            <a href="{{route("view.tours")}}" class="show-submenu">{{__("Tours")}}</a>
                        </li>

                        <li>
                            <a href="{{route("view.transfers")}}" class="show-submenu">{{__("Transfers")}}</a>
                        </li>

                        <li>
                            <a href="{{route("view.contact")}}" class="show-submenu">{{__("Contact")}}</a>
                        </li>

                    </ul>
                </div><!-- End main-menu -->
                <ul id="top_tools">
                    <li>
                        <div class="dropdown dropdown-cart">
                            <a href="#0" data-bs-hover="dropdown" class="cart_bt"><i class="icon_bag_alt"></i><strong>3</strong></a>
                            <ul class="dropdown-menu" id="cart_items">
                                <li>
                                    <div class="image"><img src="img/thumb_cart_1.jpg" alt="image"></div>
                                    <strong><a href="#">Louvre museum</a>1x $36.00 </strong>
                                    <a href="#" class="action"><i class="icon-trash"></i></a>
                                </li>
                                <li>
                                    <div class="image"><img src="img/thumb_cart_2.jpg" alt="image"></div>
                                    <strong><a href="#">Versailles tour</a>2x $36.00 </strong>
                                    <a href="#" class="action"><i class="icon-trash"></i></a>
                                </li>
                                <li>
                                    <div class="image"><img src="img/thumb_cart_3.jpg" alt="image"></div>
                                    <strong><a href="#">Versailles tour</a>1x $36.00 </strong>
                                    <a href="#" class="action"><i class="icon-trash"></i></a>
                                </li>
                                <li>
                                    <div>Total: <span>$120.00</span></div>
                                    <a href="cart.html" class="button_drop">Go to cart</a>
                                    <a href="payment.html" class="button_drop outline">Check out</a>
                                </li>
                            </ul>
                        </div><!-- End dropdown-cart-->
                    </li>
                </ul>
            </nav>
        </div>
    </div><!-- container -->
</header><!-- End Header -->
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const logoutLink = document.getElementById('logout_link');

        logoutLink.addEventListener('click', function(event) {
            event.preventDefault(); // Prevent default action

            Swal.fire({
                title: '{{ __("Are you sure you want to log out?") }}',
                text: '{{ __("You will need to log in again to access your account.") }}',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '{{ __("Yes, log out!") }}',
                cancelButtonText: '{{ __("Cancel") }}',
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirect to the logout route
                    window.location.href = '{{ route('view.auth.logout') }}';
                }
            });
        });
    });
</script>
@endpush
