<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advance extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'responsible_id',
        'payment_id',
        'amount',
        'description',
        'status'
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function payments(){
        return $this->belongsTo(Payment::class);
    }
}
