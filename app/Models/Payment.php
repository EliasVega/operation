<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount',
        'advance',
        'total',
        'reference',
        'bank_id',
        'payment_method_id',
        'user_id',
        'responsible_id',
        'bank_origin_id'
    ];

    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function partialss(){
        return $this->hasMany(Partial::class);
    }

    public function advances(){
        return $this->hasMany(Advance::class);
    }
}
