<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Company;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'address', 'phone','dob','slug','type', 'nextOfKin', 'nextOfKinPhone', 'nextOfKinEmail'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *s
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    public function company($userId)
    {
        $query = Company::where('userId', $userId)->first();

        return $query;
    }
    public function agency($userId)
    {
        $query = Agency::where('userId', $userId)->first();

        return $query;
    }
}
