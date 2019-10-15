<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class landTrnx extends Model
{
    //
    protected $table = "landtrnxes";

    protected $fillable = [
        'itemId', 'userId', 'cycle', 'cycleCompleted', 'nextPayment', 'slug', 'isCompleted' , 'isDeleted'
    ];


    public function property()
    {
        $properties = $this->hasOne('App\Models\Property', 'id', 'landId')->first();

        return $properties;
    }
    public function estate($id)
    {
        $estate = Estate::where("id", $id)->first();

        return $estate;
    }

    public function user(){
        $user = $this->hasOne('App\Models\User', 'id', 'userId')->first();

        return $user;
    }
}
