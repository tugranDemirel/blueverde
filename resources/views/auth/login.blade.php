<!doctype html>
<html lang="en" class="light-theme">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Tuğran Demirel">
    <link rel="icon" href="{{ asset('assets/admin/images/favicon-32x32.png') }}" type="image/png"/>
    <!-- Bootstrap CSS -->
    <link href="{{ asset('assets/admin/css/bootstrap.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/admin/css/bootstrap-extended.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/admin/css/style.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/admin/css/icons.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <!-- loader-->
    <link href="{{ asset('assets/front/css/pace.min.css') }}" rel="stylesheet"/>

    <title>Giriş Yap</title>
</head>

<body>

<!--start wrapper-->
<div class="wrapper">

    <!--start content-->
    <main class="authentication-content">
        <div class="container-fluid">
            <div class="authentication-card">
                <div class="card shadow rounded-0 overflow-hidden">
                    <div class="row g-0">
                        <div class="col-lg-6 bg-login d-flex align-items-center justify-content-center">
                            <img src="{{ asset('assets/admin/images/error/login-img.jpg') }}" class="img-fluid" alt="">
                        </div>
                        <div class="col-lg-6">
                            <div class="card-body p-4 p-sm-5">
                                <h5 class="card-title">Giriş Yap</h5>
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <label for="inputEmailAddress" class="form-label">Email</label>
                                            <div class="ms-auto position-relative">
                                                <div
                                                    class="position-absolute top-50 translate-middle-y search-icon px-3">
                                                    <i class="bi bi-envelope-fill"></i></div>
                                                <input type="email" name="email"
                                                       class="form-control radius-30 ps-5 @error('email') is-invalid @enderror"
                                                       value="{{ old('email') }}"
                                                       id="inputEmailAddress" placeholder="Email Adresiniz">
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label for="inputChoosePassword" class="form-label">Şifre</label>
                                            <div class="ms-auto position-relative">
                                                <div
                                                    class="position-absolute top-50 translate-middle-y search-icon px-3">
                                                    <i class="bi bi-lock-fill"></i></div>
                                                <input type="password"
                                                       class="form-control radius-30 ps-5 @error('password') is-invalid @enderror" name="password"
                                                       required autocomplete="current-password"
                                                       id="inputChoosePassword" placeholder="Şifreniz">
                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="d-grid">
                                                <button type="submit" class="btn btn-primary radius-30">Giriş Yap
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <p class="mb-0">Hesabınız yok mu? Hemen <a
                                                    href="{{ route('register') }}">Kayıt Ol</a></p>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!--end page main-->

</div>
<!--end wrapper-->


<!--plugins-->
<script src="{{ asset('assets/admin/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/pace.min.js') }}"></script>


</body>

</html>
