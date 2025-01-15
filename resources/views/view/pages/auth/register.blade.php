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
                                    <label>Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Name">
                                </div>

                                <div class="form-group">
                                    <label>Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email">
                                </div>

                                <div class="form-group">
                                    <label>Phone</label>
                                    <input type="text" class="form-control" name="phone" value="{{ old('phone') }}" placeholder="Phone (Optional)">
                                </div>

                                <div class="form-group">
                                    <label>Password <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control" name="password" placeholder="Password">
                                </div>

                                <div class="form-group">
                                    <label>Confirm Password <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password">
                                </div>

                                <button type="submit" class="btn_full">Create an account</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
