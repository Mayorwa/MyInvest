<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    //
    protected $table = "subscriptions";

    protected $fillable = [
        'userId', 'landId', 'sub_code', 'email_token'
    ];


}
