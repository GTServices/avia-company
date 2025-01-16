<!-- Sign In Popup -->
<div id="sign-in-dialog" class="zoom-anim-dialog mfp-hide">
    <div class="small-dialog-header">
        <h3>Sign In</h3>
    </div>
    <form method="POST" action="{{ route('view.auth.login') }}">
        @csrf
        <div class="sign-in-wrapper">
            <a href="#0" class="social_bt facebook">Login with Facebook</a>
            <a href="#0" class="social_bt google">Login with Google</a>
            <div class="divider"><span>Or</span></div>

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

            <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control" name="email" id="email" required>
                <i class="icon_mail_alt"></i>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" name="password" id="password" required>
                <i class="icon_lock_alt"></i>
            </div>
            <div class="clearfix add_bottom_15">
                <div class="checkboxes float-start">
                    <label class="container_check">Remember me
                        <input type="checkbox" name="remember">
                        <span class="checkmark"></span>
                    </label>
                </div>
                <div class="float-end"><a href="{{route("view.auth.password.forgot")}}">Forgot Password?</a></div>
            </div>
            <div class="text-center"><input type="submit" value="Log In" class="btn_login"></div>
            <div class="text-center">
                Don’t have an account? <a href="{{ route('view.auth.register') }}">Sign up</a>
            </div>
        </div>
    </form>
</div>
<!-- /Sign In Popup -->
