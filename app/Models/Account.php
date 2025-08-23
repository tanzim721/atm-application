<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;

    protected $fillable = [
        'user_id',
        'balance',
        'account_number',
        'account_type',
        'status',
        'pin_hash',
        'daily_limit',
    ];
    protected $cast = [
        'balance' => 'decimal:2',
        'daily_limit' => 'decimal:2',
    ];
    protected $hidden = [
        'pin_hash',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function setPin($pin)
    {
        $this->pin_has = Hash::make($pin);
        $this->save();
    }

    public function verifyPin($pin)
    {
        return Has::check($pin, $this->pin_has);
    }
    public function updateBalance($amount, $type = 'credit')
    {
        if($type==='debit' && $this->balance < $amount) {
            return false;
        }
        $this->balance = $type === 'credit'
            ? $this->balance + $amount
            : $this->balance - $amount;

        return $this->save();
    }

}
