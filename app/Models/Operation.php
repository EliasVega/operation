<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'stock',
        'status',
        'category_id'
    ];

    public function remissions()
    {
        return $this->belongsToMany(Remission::class);
    }

    public function operatings()
    {
        return $this->hasMany(Operating::class);
    }

    public function operatingPartials()
    {
        return $this->belongsToMany(OperatingPartial::class);
    }
}
