@extends('view.layouts.app')

@section('content')
    <main>
        <section id="hero" class="login">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-4 col-lg-5 col-md-6 col-sm-8">
                        <div id="login">
                            <div class="text-center">
                                <img src="{{ asset('assets/img/logo_sticky.png') }}" alt="Image" width="160" height="34">
                            </div>
                            <hr>

                            <!-- Success Mesajı (Yaşıl) -->
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <!-- Warning Mesajı (Sarı) -->
                            @if (session('warning'))
                                <div class="alert alert-warning">
                                    {{ session('warning') }}
                                </div>
                            @endif

                            <form action="{{ route('view.auth.register') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label>{{__("Name")}} <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="{{__("Name")}}">
                                </div>

                                <div class="form-group">
                                    <label>{{__("Email")}} <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="{{__("Email")}}">
                                </div>

                                <div class="form-group">
                                    <label>{{__("Phone")}}</label>
                                    <input type="text" class="form-control" name="phone" value="{{ old('phone') }}" placeholder="{{__("Phone")}} ({{__("Optional")}})">
                                </div>

                                <div class="form-group">
                                    <label>{{__("Password")}} <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control" name="password" placeholder="{{__("Password")}}">
                                </div>

                                <div class="form-group">
                                    <label>{{__("Confirm Password")}} <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control" name="password_confirmation" placeholder="{{__("Confirm Password")}}">
                                </div>

                                <button type="submit" class="btn_full">{{__("Create an account")}}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
