<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipality extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [

        'code',
        'name',
        'department_id'
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
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
