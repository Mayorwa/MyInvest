<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    //
    protected $table = "properties";

    protected $fillable = [
        'estateId', 'companyId', 'noOfPlots', 'noOfSoldPlots', 'slug', 'isAvailable', 'isActive' , 'isDeleted','type', 'amount', 'description', 'rules', 'destination'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'updated_at','isDeleted'
    ];

    public function estate()
    {
        $estate = $this->hasOne('App\Models\Estate', 'id', 'estateId')->first();

        return $estate;
    }

    public function company()
    {
        $company = $this->hasOne('App\Models\Company', 'id', 'companyId')->first();

        return $company;
    }

    public function image()
    {

            $image = $this->hasMany('App\Models\Image', 'itemId', 'id')->first();

            if($image)
            {
                    $image->image = URL('/')."/uploads/images/".$image->image;
            } else {
                $image->image = URL('/')."/uploads/images/def.jpg";
            }


        return $image;
    }

    public function images()
    {

        $images = $this->hasMany('App\Models\Image', 'itemId', 'id')->get();

        foreach ($images as $image) {
            if ($image) {
                $image->image = URL('/') . "/uploads/images/" . $image->image;
            } else {
                $image->image = URL('/') . "/uploads/images/def.jpg";
            }

        }

        return $images;
    }
    public function inst()
    {

        $ins = $this->hasMany('App\Models\InsPayment', 'propertyId', 'id')->get();

        return $ins;
    }


}
