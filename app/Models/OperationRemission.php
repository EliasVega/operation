<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OperationRemission extends Model
{
    use HasFactory;

    protected $fillable = [
        'quantity',
        'price',
        'subtotal',
        'item',
        'pending',
        'operation_id',
        'remission_id',
    ];
}
