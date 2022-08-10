<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [

        'name',
        'number',
        'address',
        'phone',
        'email',
        'password',
        'position',
        'status',
        'company_id',
        'document_id',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function role()
    {
        return $this->hasOne(Role::class);
    }

    public function document()
    {
        return $this->belongsTo(Document::class);
    }

    public function operations()
    {
        return $this->hasMany(Operation::class);
    }

    public function remissions()
    {
        return $this->hasMany(Remission::class);
    }

    public function partials()
    {
        return $this->hasMany(Partial::class);
    }

    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }

    public function payments(){
        return $this->hasMany(Payment::class);
    }

    public function advances(){
        return $this->hasMany(Advance::class);
    }
}
