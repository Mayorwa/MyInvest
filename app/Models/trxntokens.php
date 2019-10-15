<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class trxntokens extends Model
{
    //
    protected $table = "trxntokens";

    protected $fillable = [
        'userId', 'itemId', 'referredId', 'amount', 'quantity', 'reference', 'token', 'isUsed',
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
