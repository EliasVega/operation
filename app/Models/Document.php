<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'code',
        'name',
        'initials',
    ];

    public function suppliers(){
        return $this->hasMany(Proveedore::class);
    }

    public function clientes(){
        return $this->hasMany(Cliente::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
