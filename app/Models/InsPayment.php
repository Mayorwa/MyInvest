<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InsPayment extends Model
{
    //
    protected $table = "ins_payments";

    protected $fillable = [
        'noOfMonths', 'estateId', 'price'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'updated_at'
    ];
}
