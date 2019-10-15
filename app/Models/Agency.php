<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agency extends Model
{
    protected $table = "agencies";


    protected $fillable = [
        'userId', 'companyId', 'uniqueId', 'isVerified', 'slug', 'accountNumber'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'updated_at',
    ];
}
