<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Sign Up</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/logo/favicon.ico') }}">

    <!-- page css -->

    <!-- Core css -->
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet">

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
                                        <img alt="logo" class="img-fluid" src="assets/images/logo/logo-fold.png"
                                            style="height: 70px;">
                                    </div>
                                </div>
                                <div class="text-center mt-3">
                                    <h3 class="fw-bolder">
                                        {{ __('form/register.title') }}
                                    </h3>
                                    <p class="text-muted">
                                        {{ __('form/register.slogan') }}
                                    </p>
                                </div>

                                {{-- Register form --}}
                                <form action="{{ route('register.post') }}" method="post">
                                    @csrf

                                    {{-- Name --}}
                                    <div class="form-group mb-3">
                                        <label class="form-label">
                                            {{ __('form/register.name') }}
                                        </label>
                                        <input type="text"
                                            class="form-control no-validation-icon no-success-validation
                                            @error('name') is-invalid @enderror"
                                            name="name" placeholder="{{ __('form/register.name-placeholder') }}"
                                            id="floatingName" value="{{ old('name', '') }}">
                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    {{-- Email --}}
                                    <div class="form-group mb-3">
                                        <label class="form-label">
                                            {{ __('form/register.email') }}
                                        </label>
                                        <input type="email"
                                            class="form-control no-validation-icon no-success-validation @error('email') is-invalid @enderror"
                                            name="email" placeholder="{{ __('form/register.email-placeholder') }}"
                                            id="floatingEmail" value="{{ old('email', '') }}">
                                        @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    {{-- Password --}}
                                    <div class="form-group mb-3">
                                        <label class="form-label">
                                            {{ __('form/register.password') }}
                                        </label>
                                        <input type="password"
                                            class="form-control no-validation-icon no-success-validation @error('password') is-invalid @enderror"
                                            name="password"
                                            placeholder="{{ __('form/register.password-placeholder') }}"
                                            id="floatingPassword">
                                        @error('password')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    {{-- Password confirm --}}
                                    <div class="form-group mb-3">
                                        <label class="form-label">
                                            {{ __('form/register.password-confirm') }}
                                        </label>
                                        <input type="password"
                                            class="form-control no-validation-icon no-success-validation @error('password-confirm') is-invalid @enderror"
                                            name="password-confirm"
                                            placeholder="{{ __('form/register.password-confirm-placeholder') }}"
                                            id="floatingPasswordConfirm">
                                        @error('password-confirm')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    {{-- Register button --}}
                                    <button class="btn btn-primary d-block w-100" type="submit">
                                        {{ __('form/register.signup-button') }}
                                    </button>
                                </form>
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
