<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Sign In</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/logo/favicon.ico') }}">

    <!-- page css -->

    <!-- Core css -->
    <link rel="stylesheet" href="{{ asset('assets/css/app.min.css') }}">
</head>


<body>
    <div class="auth-full-height d-flex flex-row align-items-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="m-2">
                                <div class="d-flex justify-content-center mt-3">
                                    <div class="text-center logo">
                                        <img alt="logo" class="img-fluid"
                                            src="{{ asset('assets/images/logo/logo-fold.png') }}" style="height: 70px;">
                                    </div>
                                </div>
                                <div class="text-center mt-3">
                                    <h3 class="fw-bolder">
                                        {{ __('form/login.sign-in') }}
                                    </h3>
                                    <p class="text-muted">
                                        {{ __('form/login.sign-in-description') }}
                                    </p>
                                </div>

                                {{-- Login form --}}
                                <form action="{{ route('login.post') }}" method="post">
                                    @csrf

                                    {{-- Email --}}
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="floatingEmail">Email</label>
                                        <input name="email" class="form-control @error('email') is-invalid @enderror"
                                            id="floatingEmail" placeholder="name@example.com"
                                            value="{{ old('email', '') }}" />
                                        @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    {{-- Password --}}
                                    <div class="mb-3">
                                        <label class="form-label d-flex justify-content-between">
                                            <span>
                                                {{ __('form/login.password') }}
                                            </span>
                                            <a href="" class="text-primary font">
                                                {{ __('form/login.password-forget') }}
                                            </a>
                                        </label>
                                        <div class="form-group input-affix flex-column">
                                            <label class="d-none" for="floatingPassword">Password</label>
                                            <input name="password" formcontrolname="password" class="form-control"
                                                type="password" id="floatingPassword">
                                            <i class="suffix-icon feather cursor-pointer text-dark icon-eye"
                                                ng-reflect-ng-class="icon-eye"></i>
                                        </div>
                                    </div>

                                    {{-- Submit button --}}
                                    <button type="submit" class="btn btn-primary w-100">
                                        {{ __('form/login.login-button') }}
                                    </button>
                                </form>

                                {{-- Login platform message --}}
                                <div class="divider">
                                    <span class="divider-text text-muted">
                                        {{ __('form/login.login-with') }}
                                    </span>
                                </div>
                                <div class="row">
                                    <div class="col px-1">
                                        <button class="btn btn-outline-secondary w-100">
                                            <img src="{{ asset('assets/images/thumbs/thumb-1.png') }}" alt=""
                                                style="max-width: 20px;">
                                        </button>
                                    </div>
                                    <div class="col px-1">
                                        <button class="btn btn-outline-secondary w-100">
                                            <img src="{{ asset('assets/images/thumbs/thumb-2.png') }}" alt=""
                                                style="max-width: 20px;">
                                        </button>
                                    </div>
                                    <div class="col px-1">
                                        <button class="btn btn-outline-secondary w-100">
                                            <img src="{{ asset('assets/images/thumbs/thumb-3.png') }}" alt=""
                                                style="max-width: 20px;">
                                        </button>
                                    </div>
                                </div>
                                <div class="text-center mt-4">
                                    <p class="text-muted">
                                        {{ __('form/login.new-user') }}
                                        <a href="register">
                                            {{ __('form/login.sign-up-now') }}
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Core Vendors JS -->
    <script src="{{ asset('assets/js/vendors.min.js') }}"></script>

    <!-- page js -->

    <!-- Core JS -->
    <script src="{{ asset('assets/js/app.min.js') }}"></script>

</body>

</html>
