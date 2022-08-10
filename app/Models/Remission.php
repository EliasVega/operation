<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Remission extends Model
{
    use HasFactory;

    protected $fillable = [
        'items',
        'total',
        'status',
        'user_id',
        'responsible_id'
    ];

    public function operations(){
        return $this->belongsToMany(Operation::class);
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function operatings()
    {
        return $this->hasMany(Operating::class);
    }

    public function partials()
    {
        return $this->hasMany(Partial::class);
    }
}
