@extends('view.layouts.app')

@section('content')
    <main>
        <section id="hero" class="login">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-4 col-lg-5 col-md-6 col-sm-8">
                        <div id="login">
                            <div class="text-center">
                                <img src="{{ asset('assets/view/img/logo_sticky.png') }}" alt="Image" width="160" height="34">
                            </div>
                            <hr>

                            <!-- Success Mesajı -->
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <!-- Warning Mesajı -->
                            @if (session('warning'))
                                <div class="alert alert-warning">
                                    {{ session('warning') }}
                                </div>
                            @endif

                            <!-- Error Mesajı -->
                            @if (session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif

                            <!-- Validasiya Xətaları -->
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form method="POST" action="{{ route('view.auth.login') }}">
                                @csrf
                                <div class="form-group">
                                    <label>{{__("Email")}}</label>
                                    <input type="email" name="email" class="form-control" placeholder="{{__("Email")}}" required>
                                </div>
                                <div class="form-group">
                                    <label>{{__("Password")}}</label>
                                    <input type="password" name="password" class="form-control" placeholder=">{{__("Password")}}" required>
                                </div>
                                <p class="small">
                                    <a href="{{ route('view.auth.password.forgot') }}">{{__("Forgot Password?")}}</a>
                                </p>
                                <button type="submit" class="btn_full">{{__("Sign in")}}</button>
                                <a href="{{ route('view.auth.register') }}" class="btn_full_outline">{{__("Register")}}</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
