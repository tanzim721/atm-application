<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;

     protected $fillable = [
        'account_id',
        'transaction_id',
        'type',
        'amount',
        'balance_before',
        'balance_after',
        'description',
        'reference_number'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'balance_before' => 'decimal:2',
        'balance_after' => 'decimal:2',
    ];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }


    // Transaction ID Generation
    public static function generateTransactionId()
    {
        do {
            $transactionId = 'TXN' . date('Ymd') . str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        } while (self::where('transaction_id', $transactionId)->exists());

        return $transactionId;
    }

     // Create Transaction Record
    public static function createRecord($accountId, $type, $amount, $balanceBefore, $balanceAfter, $description = null)
    {
        return self::create([
            'account_id' => $accountId,
            'transaction_id' => self::generateTransactionId(),
            'type' => $type,
            'amount' => $amount,
            'balance_before' => $balanceBefore,
            'balance_after' => $balanceAfter,
            'description' => $description,
        ]);
    }
    

}
