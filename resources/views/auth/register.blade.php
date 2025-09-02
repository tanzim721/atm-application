@extends('layouts.atm')

@section('title', 'Register New Account')

@section('header', 'Open New Bank Account')

@section('content')
<form method="POST" action="{{ route('auth.register.submit') }}">
    @csrf
    
    <!-- Personal Information -->
    <h6 class="text-primary mb-3"><i class="fas fa-user"></i> Personal Information</h6>
    
    <div class="mb-3">
        <label for="name" class="form-label">Full Name</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
    </div>

    <div class="row">
        <div class="col-md-8 mb-3">
            <label for="email" class="form-label">Email Address</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
        </div>
        <div class="col-md-4 mb-3">
            <label for="phone" class="form-label">Phone Number</label>
            <input type="tel" class="form-control" id="phone" name="phone" value="{{ old('phone') }}" required>
        </div>
    </div>

    <div class="mb-3">
        <label for="address" class="form-label">Address</label>
        <textarea class="form-control" id="address" name="address" rows="2" required>{{ old('address') }}</textarea>
    </div>

    <div class="mb-3">
        <label for="date_of_birth" class="form-label">Date of Birth</label>
        <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth') }}" required>
    </div>

    <!-- Account Information -->
    <h6 class="text-primary mb-3 mt-4"><i class="fas fa-university"></i> Account Information</h6>
    
    <div class="mb-3">
        <label for="initial_deposit" class="form-label">Initial Deposit (Minimum: $1,000)</label>
        <input type="number" class="form-control" id="initial_deposit" name="initial_deposit" min="1000" step="0.01" value="{{ old('initial_deposit') }}" required>
    </div>

    <!-- Security Information -->
    <h6 class="text-primary mb-3 mt-4"><i class="fas fa-lock"></i> Security Information</h6>
    
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="password" class="form-label">Login Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="col-md-6 mb-3">
            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="pin" class="form-label">ATM PIN (4 digits)</label>
            <input type="password" class="form-control" id="pin" name="pin" maxlength="4" pattern="[0-9]{4}" required>
        </div>
        <div class="col-md-6 mb-3">
            <label for="pin_confirmation" class="form-label">Confirm PIN</label>
            <input type="password" class="form-control" id="pin_confirmation" name="pin_confirmation" maxlength="4" pattern="[0-9]{4}" required>
        </div>
    </div>

    <div class="form-check mb-3">
        <input class="form-check-input" type="checkbox" id="terms" name="terms" required>
        <label class="form-check-label" for="terms">
            I agree to the <a href="#" target="_blank">Terms and Conditions</a> and <a href="#" target="_blank">Privacy Policy</a>
        </label>
    </div>

    <button type="submit" class="btn btn-success btn-atm">
        <i class="fas fa-user-plus"></i> Open Account
    </button>
    

    <div class="text-center mt-3">
        <small class="text-muted">
            <a href="{{ route('atm.welcome') }}">Back to ATM</a> | 
            <a href="{{ route('auth.login') }}">Already have an account?</a>
        </small>
    </div>
</form>
@endsection

@section('scripts')
<script>
    // Ensure PIN is numeric only
    document.getElementById('pin').addEventListener('input', function (e) {
        e.target.value = e.target.value.replace(/[^0-9]/g, '');
    });
    
    document.getElementById('pin_confirmation').addEventListener('input', function (e) {
        e.target.value = e.target.value.replace(/[^0-9]/g, '');
    });

    // Phone number formatting
    document.getElementById('phone').addEventListener('input', function (e) {
        let value = e.target.value.replace(/\D/g, '');
        e.target.value = value;
    });
</script>
@endsection