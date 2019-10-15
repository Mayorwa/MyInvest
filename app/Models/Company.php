<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    //

    protected $table = "companies";


    protected $fillable = [
        'name', 'email', 'slug', 'logo', 'address','isDeleted','userId', 'accountNumber'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'updated_at',
    ];

    public function user()
    {
        $user = $this->hasOne('App\Models\User', 'id', 'userId')->first();

        return $user;
    }

    public function estates()
    {
        $properties = $this->hasMany('App\Models\Estate', 'companyId', 'id')->latest()->paginate(15);

        return $properties;
    }
}
