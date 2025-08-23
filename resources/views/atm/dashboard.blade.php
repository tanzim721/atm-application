@extends('layouts.atm')

@section('title', 'ATM - Main Menu')

@section('header', 'ATM Main Menu')

@section('content')
<div class="text-center mb-4">
    <h5>Welcome, {{ $account->user->name }}</h5>
    <p class="text-muted">Account: {{ $account->account_number }}</p>
    <div class="alert alert-info">
        <i class="fas fa-clock"></i> Session will expire in <span id="timer">15:00</span> minutes
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <button class="btn btn-outline-primary btn-atm">
            <i class="fas fa-eye"></i><br>Balance Inquiry
        </button>
    </div>
    <div class="col-md-6 mb-3">
        <button class="btn btn-outline-success btn-atm">
            <i class="fas fa-money-bill-wave"></i><br>Cash Withdrawal
        </button>
    </div>
    <div class="col-md-6 mb-3">
        <button class="btn btn-outline-info btn-atm">
            <i class="fas fa-plus-circle"></i><br>Cash Deposit
        </button>
    </div>
    <div class="col-md-6 mb-3">
        <button class="btn btn-outline-warning btn-atm">
            <i class="fas fa-exchange-alt"></i><br>Fund Transfer
        </button>
    </div>
    <div class="col-md-6 mb-3">
        <button class="btn btn-outline-secondary btn-atm">
            <i class="fas fa-list"></i><br>Mini Statement
        </button>
    </div>
    <div class="col-md-6 mb-3">
        <button class="btn btn-outline-dark btn-atm">
            <i class="fas fa-key"></i><br>Change PIN
        </button>
    </div>
</div>

<form method="POST" action="{{ route('atm.logout') }}">
    @csrf
    <button type="submit" class="btn btn-danger btn-atm mt-3">
        <i class="fas fa-sign-out-alt"></i> Exit
    </button>
</form>
@endsection

@section('scripts')
<script>
    // Session timer
    let timeLeft = 15 * 60; // 15 minutes in seconds
    const timer = document.getElementById('timer');
    
    const countdown = setInterval(function() {
        const minutes = Math.floor(timeLeft / 60);
        const seconds = timeLeft % 60;
        timer.textContent = `${minutes}:${seconds.toString().padStart(2, '0')}`;
        
        if (timeLeft <= 0) {
            clearInterval(countdown);
            alert('Session expired. Redirecting to main screen.');
            window.location.href = '{{ route("atm.welcome") }}';
        }
        timeLeft--;
    }, 1000);
</script>
@endsection