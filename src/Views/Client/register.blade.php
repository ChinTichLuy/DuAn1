@extends('layouts.master')
@section('title', 'Register')
@section('content')
<div class="page-header">
    <div class="container d-flex flex-column align-items-center">
        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ routeClient('') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Register
                    </li>
                </ol>
            </div>
        </nav>
        <h1>Register</h1>
    </div>
</div>
<div class="container login-container">
    <div class="col-lg-12 mx-auto">
        <div class="d-flex justify-content-center align-items-center">
            <div style="width: 30%">
                <form action="{{ routeClient('auth/register') }}" method="POST">
                    <div>
                        <label>
                            Name
                            <span class="required">*</span>
                        </label>
                        <input type="text" class="form-input form-wide" name="name"
                            value="{{ getOldValue('name') }}" required>
                        <div class="text-danger fst-italic">
                            {{ error('name') }}
                        </div>
                    </div>
                    <div>
                        <label for="register-email">
                            Email address
                            <span class="required">*</span>
                        </label>
                        <input type="email" name="email" class="form-input form-wide" id="register-email"
                            value="{{ getOldValue('email') }}" required />
                        <div class="text-danger fst-italic">
                            {{ error('email') }}
                        </div>
                    </div>
                    <div>
                        <label for="register-password">
                            Password
                            <span class="required">*</span>
                        </label>
                        <input type="password" name="password" class="form-input form-wide" id="register-password"
                            required />
                        <div class="text-danger fst-italic">
                            {{ error('password') }}
                        </div>
                    </div>
                    <div class="form-footer">
                        <a href="{{ routeClient('auth/login') }}" class="text-black-50 fs-3">Login</a>
                    </div>
                    <div class="form-footer mb-2">
                        <button type="submit" class="btn btn-dark btn-md w-100 mr-0">
                            Register
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection