<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;

    protected $fillable = [
        'account_id',
        'card_number',
        'expiry_date',
        'card_type',
        'cvv_hash',
        'status',
    ];
    
    protected $cast = [
        'expiry_date' => 'date',
    ];

    protected $hidden = [
        'cvv_hash',
    ];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }
    
    // card number generator
    public static function generateCardNumber()
    {
        do {
            $cardNumber = '4532' . str_pad(mt_rand(0, 999999999999), 12, '0', STR_PAD_LEFT);
        } while (self::where('card_number', $cardNumber)->exists());
        return $cardNumber;
    }

    // cvv management
    public function setCvv($cvv)
    {
        $this->cvv_hash = Hash::make($cvv);
        $this->save();
    }
    
    public function verifyCvv($cvv)
    {
        return Hash::check($cvv,  $this->cvv_hash);
    }

}
