<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class premium extends Model
{
    //

    protected $table = "premia";

    protected $fillable = [
        'name', 'size' , 'companyId', 'noOfPlots', 'amount', 'bio' , 'additionalFees', 'address', 'state', 'country', 'rules', 'description', 'slug', 'isActive'
    ];

    protected $hidden = [
        'updated_at'
    ];

    public function image()
    {

        $image = $this->hasMany('App\Models\premiumImg', 'itemId', 'id')->first();

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

        $images = $this->hasMany('App\Models\premiumImg', 'itemId', 'id')->get();

        foreach ($images as $image) {
            if ($image) {
                $image->image = URL('/') . "/uploads/images/" . $image->image;
            } else {
                $image->image = URL('/') . "/uploads/images/def.jpg";
            }

        }

        return $images;
    }

    public function company()
    {
        $company = $this->hasOne('App\Models\Company', 'id', 'companyId')->first();

        return $company;
    }
}
