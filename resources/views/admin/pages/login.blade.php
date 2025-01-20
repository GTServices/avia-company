<!doctype html>
<html lang="ru" data-bs-theme="blue-theme">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Админ Панель | Вход</title>
    <!--favicon-->
    <link rel="icon" href="{{ asset('assets/admin/assets/images/favicon-32x32.png') }}" type="image/png">
    <!-- Loader -->
    <link href="{{ asset('assets/admin/assets/css/pace.min.css') }}" rel="stylesheet">
    <script src="{{ asset('assets/admin/assets/js/pace.min.js') }}"></script>
    <!-- Bootstrap CSS -->
    <link href="{{ asset('assets/admin/assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Main CSS -->
    <link href="{{ asset('assets/admin/assets/css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/admin/assets/css/responsive.css') }}" rel="stylesheet">
</head>

<body>

<div class="container my-5">
    <div class="card col-xl-6 col-lg-8 mx-auto rounded-4 overflow-hidden p-4">
        <div class="row g-4">
            <div class="col-12">
                <div class="card-body text-center">
                    <img src="{{ asset('assets/admin/assets/images/logo1.png') }}" class="mb-4" width="145" alt="Logo">
                    <h4 class="fw-bold">Добро пожаловать</h4>
                    <p class="mb-3">Введите свои данные для входа</p>
                    <form action="{{ route('admin.login') }}" method="POST" class="row g-3" novalidate>
                        @csrf
                        <div class="col-12">
                            <label for="email" class="form-label">Электронная почта</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="example@mail.com" required>
                            @error('email')
                            <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label for="password" class="form-label">Пароль</label>
                            <div class="input-group" id="show_hide_password">
                                <input type="password" name="password" class="form-control border-end-0 @error('password') is-invalid @enderror" id="password" placeholder="Введите пароль" required>
                                <a href="javascript:;" class="input-group-text bg-transparent"><i class="bi bi-eye-slash-fill"></i></a>
                            </div>
                            @error('password')
                            <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="remember" name="remember">
                                <label class="form-check-label" for="remember">Запомнить меня</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary w-100">Войти</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Plugins -->
<script src="{{ asset('assets/admin/assets/js/jquery.min.js') }}"></script>
<script>
    $(document).ready(function () {
        $("#show_hide_password a").on('click', function (event) {
            event.preventDefault();
            if ($('#show_hide_password input').attr("type") == "text") {
                $('#show_hide_password input').attr('type', 'password');
                $('#show_hide_password i').addClass("bi-eye-slash-fill");
                $('#show_hide_password i').removeClass("bi-eye-fill");
            } else {
                $('#show_hide_password input').attr('type', 'text');
                $('#show_hide_password i').removeClass("bi-eye-slash-fill");
                $('#show_hide_password i').addClass("bi-eye-fill");
            }
        });
    });
</script>
</body>
</html>
