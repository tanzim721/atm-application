@extends('layouts.atm')

@section('title', 'ATM - Transaction')

@section('header', 'Welcome to ATM')

@section('content')
<div class="text-center mb-4">
    <i class="fas fa-exchange-alt fa-4x text-primary mb-3"></i>
    <h4>Make a Transaction</h4>
    <p class="text-muted">Fill in the details below to proceed</p>

    <form method="POST" action="{{ route('transactions.store') }}" id="transactionForm">
        @csrf
        <div class="mb-3">
            <label for="account_id" class="form-label">Select Account</label>
            <select class="form-select" id="account_id" name="account_id" required>
            <option value="" disabled selected>Select your account</option>
            @foreach($accounts as $account)
                <option value="{{ $account->id }}">{{ $account->account_number }} - {{ $account->account_type }} (Balance: ${{ number_format($account->balance, 2) }})</option>
            @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="transaction_type" class="form-label">Transaction Type</label>
            <select class="form-select" id="transaction_type" name="transaction_type" required>
            <option value="" disabled selected>Select transaction type</option>
            <option value="deposit">Deposit</option>
            <option value="withdrawal">Withdrawal</option>
            <option value="transfer_in">Transfer In</option>
            <option value="transfer_out">Transfer Out</option>
            <option value="balance_inquiry">Balance Inquiry</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="amount" class="form-label">Amount</label>
            <input type="number" step="0.01" min="0" class="form-control" id="amount" name="amount" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <input type="text" class="form-control" id="description" name="description">
        </div>

        <div class="mb-3">
            <label for="reference_number" class="form-label">Reference Number</label>
            <input type="text" class="form-control" id="reference_number" name="reference_number">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
@endsection

@section('scripts')

@endsection