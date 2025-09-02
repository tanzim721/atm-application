<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Jobs\TransferMoneyJob;

class TransactionController extends Controller
{
    

    public function create()
    {
        $accounts = Account::where('user_id', auth()->id())->get();
        return view('transactions.create', compact('accounts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'account_id' => 'required|exists:accounts,id',
            'transaction_type' => 'required|in:withdrawal,deposit,transfer_in,transfer_out,balance_inquiry',
            'amount' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'reference_number' => 'nullable|string',
        ]);


        $account = Account::findOrFail($request->account_id);
        $balanceBefore = $account->balance;
        $amount = $request->amount;

        switch ($request->type) {
            case 'withdrawal':
            case 'transfer_out':
                if ($account->balance < $amount) {
                    return back()->withErrors(['amount' => 'Insufficient balance.']);
                }
                $account->balance -= $amount;
                break;
            case 'deposit':
            case 'transfer_in':
                $account->balance += $amount;
                break;
            case 'balance_inquiry':
                // No balance change
                break;
        }

        $account->save();

        $transaction = Transaction::create([
            'account_id' => $account->id,
            'transaction_id' => uniqid('txn_'),
            'transaction_type' => $request->transaction_type,
            'amount' => $amount,
            'balance_before' => $balanceBefore,
            'balance_after' => $account->balance,
            'description' => $request->description,
            'reference_number' => $request->reference_number,
        ]);

        dispatch(new TransferMoneyJob($request->amount));

        return redirect()->route('transactions.create', $transaction)->with('success', 'Transaction completed successfully.');
    }

}
