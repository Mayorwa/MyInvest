<?php

namespace App\Models;
use App\Models\Estate;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    //
    protected $table = "transactions";

    protected $fillable = [
        'userId', 'itemId', 'referredId', 'reference', 'amount', 'message', 'type' , 'isDeleted','token', 'status', 'slug', 'isActive', 'isDeleted'
    ];

    public function property()
    {
        $properties = $this->hasOne('App\Models\Property', 'id', 'itemId')->first();

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

    public function token(){
        $tkn = $this->hasOne('App\Models\trxntokens', 'reference', 'reference') ->first();

        return $tkn;
    }
}
