<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        //
        'code',
        'name',
        'codeISO'
    ];

    public function municipalities()
    {
        return $this->hasMany(Municipality::class);
    }

    public function branches()
    {
        return $this->hasMany(Branch::class);
    }

    public function proveedores()
    {
        return $this->hasMany(Proveedore::class);
    }

    public function customers()
    {
        return $this->hasMany(Customer::class);
    }
}
