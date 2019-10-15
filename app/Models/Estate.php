<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estate extends Model
{
    //
    protected $table = "estates";

    protected $fillable = [
        'name', 'size', 'companyId', 'noOfPlots', 'noOfSoldPlots', 'amount', 'bio', 'additionalFees', 'address', 'state', 'country', 'rules', 'description', 'slug', 'isActive'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'updated_at'
    ];

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

        $ins = $this->hasMany('App\Models\InsPayment', 'estateId', 'id')->get();

        return $ins;
    }
}
