@extends('admin.auth.head')

@section('title')
    Login
@endsection
@section('content')
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <!-- Register -->
                <div class="card">
                    <div class="card-body">
                        <!-- Logo -->
                        <a href="/">
                            <div class="app-brand justify-content-center">
                                <span class="app-brand-logo demo">
                                    <img src="../assets1/img/logo3.png" alt="Logo" class="img-fluid me-2"
                                        style="max-width: 35px;">
                                </span>
                                <span class="app-brand-text demo text-body fw-bolder">{{ config('app.name') }}</span>
                            </div>
                        </a>
                        <!-- /Logo -->
                        <h4 class="mb-4 text-center">Welcome! Please Log In to Continue 👋</h4>
                        <form id="formAuthentication" class="mb-3" action="{{ route('login-proses') }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label for="login" class="form-label">Email Or Username</label>
                                <input type="text" class="form-control" id="login" name="login"
                                    placeholder="Enter your login" value="{{ old('login') }}" required />
                                @error('login')
                                    <div class="text-sm text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3 form-password-toggle">
                                <div class="d-flex justify-content-between">
                                    <label for="password" class="form-label">Password</label>
                                    <a href="{{route('forgot')}}">
                                        <small>Forgot Password?</small>
                                    </a>
                                </div>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" class="form-control" name="password"
                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                        aria-describedby="password" required />
                                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                </div>
                                @error('password')
                                    <div class="text-sm text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-primary d-grid w-100" type="submit">Sign in</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /Register -->
            </div>
        </div>
    </div>
@endsection
