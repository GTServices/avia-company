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

                            <!-- Validasiya və Mesajlar -->
                            @if (session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form method="POST" action="{{ route('view.auth.password.reset_password') }}">
                                @csrf

                                <input type="hidden" name="email" value="{{ $email }}">
                                <input type="hidden" name="code" value="{{ $code }}">

                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" class="form-control" name="password" placeholder="Enter new password" required>
                                </div>

                                <div class="form-group">
                                    <label>Confirm Password</label>
                                    <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm new password" required>
                                </div>

                                <button type="submit" class="btn_full">Reset Password</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
