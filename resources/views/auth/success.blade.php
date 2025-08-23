@extends('layouts.atm')

@section('title', 'Account Created Successfully')

@section('header', 'Welcome to Our Bank!')

@section('content')
<div class="text-center">
    <i class="fas fa-check-circle fa-4x text-success mb-4"></i>
    <h4 class="text-success">Account Created Successfully!</h4>
    <p class="mb-4">Your bank account has been created and your ATM card is ready for use.</p>
    
    <div class="alert alert-info">
        <h6><i class="fas fa-info-circle"></i> Your Account Details</h6>
        <p><strong>Account Number:</strong> {{ session('account_number') }}</p>
        <p><strong>Card Number:</strong> {{ session('card_number') }}</p>
        <small class="text-muted">Please save these details securely. Your physical ATM card will be mailed to your address.</small>
    </div>

    <div class="d-grid gap-2">
        <a href="{{ route('atm.welcome') }}" class="btn btn-primary btn-atm">
            <i class="fas fa-credit-card"></i> Use ATM Now
        </a>
        <a href="{{ route('auth.login') }}" class="btn btn-outline-secondary">
            <i class="fas fa-tachometer-alt"></i> Go to Account Dashboard
        </a>
    </div>
</div>
@endsection