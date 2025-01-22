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

                            <!-- Validasiya Xətaları -->
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <span>{{ $error }}</span>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form method="POST" action="{{ route('view.auth.password.send_reset_request') }}">
                                @csrf

                                <div class="form-group">
                                    <label>{{__("Email")}}</label>
                                    <input type="email" name="email" class="form-control" placeholder="{{__("Email")}}" value="{{ old('email') }}" required>
                                </div>

                                <button type="submit" class="btn_full">{{__("Send Password Reset Code")}}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
