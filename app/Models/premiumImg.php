<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class premiumImg extends Model
{
    //
    protected $table = "premium_imgs";

    protected $fillable = [
        'itemId', 'image'
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
