@extends('layouts.atm')

@section('title', 'Account Login')

@section('header', 'Account Dashboard Login')

@section('content')
<div class="text-center mb-4">
    <i class="fas fa-user-circle fa-3x text-primary mb-3"></i>
    <h5>Access Your Account Dashboard</h5>
    <p class="text-muted">Login to manage your account settings</p>
</div>

<form method="POST" action="{{ route('auth.login.submit') }}">
    @csrf
    
    <div class="mb-3">
        <label for="email" class="form-label">Email Address</label>
        <input type="email" class="form-control form-control-lg" id="email" name="email" value="{{ old('email') }}" required>
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control form-control-lg" id="password" name="password" required>
    </div>

    <div class="form-check mb-3">
        <input class="form-check-input" type="checkbox" id="remember" name="remember">
        <label class="form-check-label" for="remember">
            Remember me
        </label>
    </div>

    <button type="submit" class="btn btn-primary btn-atm">
        <i class="fas fa-sign-in-alt"></i> Login to Dashboard
    </button>

    <div class="text-center mt-4">
        <small class="text-muted">
            <a href="{{ route('atm.welcome') }}">Use ATM</a> | 
            <a href="{{ route('auth.register') }}">Create New Account</a>
        </small>
    </div>
</form>
@endsection