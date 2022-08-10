<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operating extends Model
{
    use HasFactory;

    protected $fillable = [
        'operating',
        'operation_id',
        'remission_id_id'
    ];

    public function remission()
    {
        return $this->belongsTo(Remission::class);
    }

    public function operations()
    {
        return $this->belongsTo(Operation::class);
    }

    public function partials()
    {
        return $this->belongsToMany(Partial::class);
    }
}
