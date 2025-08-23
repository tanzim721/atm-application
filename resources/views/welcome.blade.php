@extends('layouts.atm')

@section('title', 'ATM - Insert Card')

@section('header', 'Welcome to ATM')

@section('content')
<div class="text-center mb-4">
    <i class="fas fa-credit-card fa-4x text-primary mb-3"></i>
    <h4>Please Insert Your Card</h4>
    <p class="text-muted">Enter your card details to continue</p>
</div>

<form method="POST" action="{{ route('atm.authenticate') }}" id="atmForm">
    @csrf
    <div class="mb-3">
        <label for="card_number" class="form-label">Card Number</label>
        <input type="text" class="form-control form-control-lg" id="card_number" name="card_number" 
               placeholder="1234 5678 9012 3456" maxlength="19" required>
    </div>

    <div class="mb-3">
        <label for="pin" class="form-label">PIN</label>
        <input type="password" class="form-control form-control-lg" id="pin" name="pin" 
               placeholder="****" maxlength="4" required>
    </div>

    <button type="submit" class="btn btn-primary btn-atm">
        <i class="fas fa-sign-in-alt"></i> Insert Card & Enter PIN
    </button>
</form>

<div class="text-center mt-4">
    <small class="text-muted">
        <a href="{{ route('auth.register') }}">Don't have an account? Register here</a>
    </small>
</div>
@endsection

@section('scripts')
<script>
    // Format card number input
    document.getElementById('card_number').addEventListener('input', function (e) {
        let value = e.target.value.replace(/\s+/g, '').replace(/[^0-9]/gi, '');
        let formattedValue = value.match(/.{1,4}/g)?.join(' ') || value;
        e.target.value = formattedValue;
    });

    // Only allow numbers for PIN
    document.getElementById('pin').addEventListener('input', function (e) {
        e.target.value = e.target.value.replace(/[^0-9]/g, '');
    });
</script>
@endsection