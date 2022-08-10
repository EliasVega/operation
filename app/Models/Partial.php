<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partial extends Model
{
    use HasFactory;

    protected $fillable = [
        'total',
        'items',
        'status',
        'aprobation',
        'payment_id',
        'user_id',
        'remission_id',
        'responsible_id'
    ];

    public function remission(){
        return $this->belongsTo(Remission::class);
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function operatings()
    {
        return $this->belongsToMany(Operating::class);
    }

    public function payment(){
        return $this->belongsTo(Payment::class);
    }
}
