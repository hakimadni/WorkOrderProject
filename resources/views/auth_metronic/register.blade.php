@extends('layout.masterauth')

@section('title', 'Register')

@section('content')
    <div class="d-flex flex-column flex-root">
        <div class="d-flex flex-column flex-lg-row flex-column-fluid">
            <div class="d-flex flex-column flex-lg-row-auto w-xl-600px positon-xl-relative" style="background-color: #0f1014">
                <div class="d-flex flex-column position-xl-fixed top-0 bottom-0 w-xl-600px scroll-y">
                    <div class="d-flex flex-row-fluid flex-column text-center p-10 pt-lg-20">
                        <a href="/" class="py-9 mb-5">
                            <img alt="Logo" src="{{ asset('media/Logo MMS.png') }}" class="h-200px" />
                        </a>
                        <h1 class="fw-bolder fs-2qx pb-5 pb-md-10 text-light">Welcome to Kim Boilerplate</h1>
                        <p class="fw-bold fs-2 text-light">Monitor Our Dashboard<br />with one stop portal</p>
                    </div>
                </div>
            </div>
            <div class="d-flex flex-column flex-lg-row-fluid py-10" style="background-color: #15171c">
                <div class="d-flex flex-center flex-column flex-column-fluid">
                    <div class="w-lg-500px p-10 p-lg-15 mx-auto">
                        @if (Session::has('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ Session::get('error') }}
                            </div>
                        @endif

                        @if (Session::has('success'))
                            <div class="alert alert-success" role="alert">
                                {{ Session::get('success') }}
                            </div>
                        @endif

                        <form class="form w-100" novalidate="novalidate" action="{{ route('register.post') }}"
                            method="POST">
                            @csrf
                            <div class="text-center mb-10">
                                <h1 class="text-light mb-3">Register to Kim Boilerplate</h1>
                                <div class="text-light fw-bold fs-4">Already have an account?
                                    <a href="{{ route('login') }}" class="link-primary fw-bolder">Sign In</a>
                                </div>
                            </div>
                            <div class="fv-row mb-10">
                                <label class="form-label fs-6 fw-bolder text-light">Name</label>
                                <input class="form-control form-control-lg form-control-solid" type="text" name="name"
                                    autocomplete="off" placeholder="Name" value="{{ old('name') }}" />
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="fv-row mb-10">
                                <label class="form-label fs-6 fw-bolder text-light">Email</label>
                                <input class="form-control form-control-lg form-control-solid" type="email" name="email"
                                    autocomplete="off" placeholder="name@example.com" value="{{ old('email') }}" />
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="fv-row mb-10">
                                <div class="d-flex flex-stack mb-2">
                                    <label class="form-label fw-bolder text-light fs-6 mb-0">Password</label>
                                    <a href="{{ route('password.request') }}" class="link-primary fs-6 fw-bolder">Forgot
                                        Password?</a>
                                </div>
                                <input class="form-control form-control-lg form-control-solid" type="password"
                                    name="password" autocomplete="off" />
                                @error('password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-lg btn-primary w-100 mb-5">
                                    <span class="indicator-label">Continue</span>
                                    <span class="indicator-progress">Please wait... <span
                                            class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
