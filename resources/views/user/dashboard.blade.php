@extends('layouts.atm')

@section('title', 'Account Dashboard')

@section('header', 'Account Management Dashboard')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h5>Welcome back, {{ $user->name }}!</h5>
            <p class="text-muted mb-0">Manage your accounts and view transactions</p>
        </div>
        <form method="POST" action="{{ route('auth.logout') }}" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-outline-danger btn-sm">
                <i class="fas fa-sign-out-alt"></i> Logout
            </button>
        </form>
    </div>

    @if(isset($accounts))
        @foreach($accounts as $account)
        <div class="card mb-3">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="mb-0">
                    <i class="fas fa-university"></i> 
                    {{ ucfirst($account->account_type) }} Account
                </h6>
                <span class="badge bg-{{ $account->status === 'active' ? 'success' : 'warning' }}">
                    {{ ucfirst($account->status) }}
                </span>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Account Number:</strong> {{ $account->account_number }}</p>
                        <p><strong>Current Balance:</strong> ${{ number_format($account->balance, 2) }}</p>
                        <p><strong>Daily Limit:</strong> ${{ number_format($account->daily_limit, 2) }}</p>
                    </div>
                    <div class="col-md-6">
                        @if($account->cards->count() > 0)
                            @foreach($account->cards as $card)
                            <p><strong>Card Number:</strong> **** **** **** {{ substr($card->card_number, -4) }}</p>
                            <p><strong>Card Status:</strong> 
                                <span class="badge bg-{{ $card->status === 'active' ? 'success' : 'warning' }}">
                                    {{ ucfirst($card->status) }}
                                </span>
                            </p>
                            <p><strong>Expires:</strong> {{ $card->expiry_date->format('m/Y') }}</p>
                            @endforeach
                        @endif
                    </div>
                </div>
                
                @if($account->transactions->count() > 0)
                <h6 class="mt-3">Recent Transactions</h6>
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Type</th>
                                <th>Amount</th>
                                <th>Balance</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($account->transactions->take(5) as $transaction)
                            <tr>
                                <td>{{ $transaction->created_at->format('M d, Y') }}</td>
                                <td>
                                    <span class="badge bg-{{ $transaction->type === 'withdrawal' ? 'danger' : 'success' }}">
                                        {{ ucfirst(str_replace('_', ' ', $transaction->type)) }}
                                    </span>
                                </td>
                                <td>${{ number_format($transaction->amount, 2) }}</td>
                                <td>${{ number_format($transaction->balance_after, 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
        </div>
        @endforeach
    @endif
    <div class="text-center mt-4">
        <a href="{{ route('atm.welcome') }}" class="btn btn-primary">
            <i class="fas fa-credit-card"></i> Use ATM
        </a>
    </div>
@endsection
