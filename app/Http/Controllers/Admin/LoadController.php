<?php

namespace App\Http\Controllers\Admin;

use App\Models\premiumImg;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Estate;
use App\Models\Property;
use App\Http\Helpers\Validate;
use App\Http\Helpers\Helper;
use App\Models\Image;
use App\Models\InsPayment;
use App\Models\premium;

class LoadController extends Controller
{
    //
    private $estate;
    private $validate;
    private $image;
    private $property;
    private $helper;
    private $insPayment;
    private $premium;
    public function __construct(Estate $estate, Validate $validate,Property $property, Helper $helper, Image $image, InsPayment $insPayment, premium $premium) {
        $this->estate = $estate;
        $this->image = $image;
        $this->property = $property;
        $this->helper = $helper;
        $this->validate = $validate;
        $this->insPayment = $insPayment;
        $this->premium = $premium;
    }

    public function createEstate(Request $request){
        try{
           $body = $request->except('_token');

           $validation = $this->validate->estate($body, "create");

           if($validation->fails()){
               $errorMessages = $this->helper->formatErrors($validation->getMessageBag()->messages());

               \Session::put("red", true);
               return redirect()->back()->withErrors($errorMessages);
           } else {

               $data = [

                    "name" => $body["name"],
                    "size" => $body["size"],
                    "companyId" => $body["companyId"],
                    "noOfPlots" => $body["noOfPlots"],
                    "amount" => $body["amount"],
                    "bio" => $body["bio"],
                    "additionalFees" => $body["additionalFees"],
                    "address" => $body["address"],
                    "state" => $body["state"],
                    "country" => $body["country"],
                    "rules" => $body["rules"],
                    "description" => $body["description"],
                    "slug" => str_random(10),
                ];

                $estateId = $this->estate->create($data)->id;

                for($i=0; $i<count($body["images"]); $i++){
                   $helperRet = $this->helper->uploadFile($body["images"][$i], "propertyImage");

                   $params = [
                       "itemId" => $estateId,
                       "image" => $helperRet["file"],
                   ];
                   $this->image->create($params);
                }

                if($body["radios"] == 2){
                   for($i = 0; $i<count($body["noOfMonths"]); $i++){
                       $dta = [
                           "noOfMonths" => $body["noOfMonths"][$i],
                           "price" => $body["insAmounts"][$i],
                           "estateId" => $estateId
                       ];
                       $this->insPayment->create($dta);
                   }
                }


               \Session::put('green', true);
               return redirect()->back()->withErrors("Estate Created Successfully");
           }
        } catch(\Exception $e){
            \Session::put('red', true);
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function createProperty(Request $request){
        try{
            $body = $request->except('_token');
//            dd($body);
            $validation = $this->validate->property($body, "create");

            if($validation->fails()){
                $errorMessages = $this->helper->formatErrors($validation->getMessageBag()->messages());

                \Session::put("red", true);
                return redirect()->back()->withErrors($errorMessages);
            } else {
                $getEstate = $this->estate->where('id', $body['estateId']);
                $Destate = $getEstate->first();
                if($Destate != null){
                    $data = [
                        "noOfPlots" => $body["noOfPlots"],
                        "amount" => $body["amount"],
                        "estateId" => $body["estateId"],
                        "companyId" => $Destate->companyId,
                        "destination" => $Destate->destination,
                        "slug" => str_random(10),
                        "description" => $body["description"],
                        "rules" => $body["rules"],
                    ];

                    $propId = $this->property->create($data)->id;
                        $newPlot = $Destate->noOfPlots + $body["noOfPlots"];
                        $getEstate->update([
                            "noOfPlots" => $newPlot
                        ]);
                    for($i=0; $i<count($body["images"]); $i++){
                        $helperRet = $this->helper->uploadFile($body["images"][$i], "propertyImage");

                            $params = [
                                "itemId" => $propId,
                                "image" => $helperRet["file"],
                            ];
                        $this->image->create($params);
                    }
//                    dd($body);
                    if($body["radios"] == 2){
                        for($i = 0; $i<count($body["noOfMonths"]); $i++){
                            $dta = [
                                "noOfMonths" => $body["noOfMonths"][$i],
                                "price" => $body["insAmounts"][$i],
                                "propertyId" => $propId
                            ];
                            $this->insPayment->create($dta);
                        }
                    }

                    \Session::put('green', true);
                    return redirect()->back()->withErrors("Property Created Successfully");

                } else {
                    \Session::put('red', true);
                    return redirect()->back()->withErrors("Sorry an Error Occurred");
                }
            }
        } catch(\Exception $e){
            \Session::put('red', true);
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function deleteProperty(Request $request){
        try{
            $body = $request->except('_token');

            $prop = $this->property->where('slug', $body["slug"]);

            if($prop->first() !== null){
                $getProp = $prop->first();
                $est = $this->estate->where("id" , $getProp->estateId);
                $getEstate = $est->first();
                if($getEstate !== null){
                    $newPlot = $getEstate->noOfPlots - $getProp->noOfPlots;
                    $est->update([
                        "noOfPlots" => $newPlot
                    ]);

                    $this->image->where("itemId", $getProp->id)->delete();
                    $prop->delete();
                    \Session::put('green', true);
                    return redirect()->back()->withErrors("Property Deleted Successfully");
                } else{
                    \Session::put('red', true);
                    return redirect()->back()->withErrors("Estate Not Found");
                }

            } else{
                \Session::put('red', true);
                return redirect()->back()->withErrors("Property Not Found");
            }
        } catch(\Exception $e){
            \Session::put('red', true);
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
    public function deleteEstate(Request $request){
        try{
            $body = $request->except('_token');

            $est = $this->estate->where('slug', $body["slug"]);
            $getEstate = $est->first();

            if($getEstate !== null){
                $est->delete();
                \Session::put('green', true);
                return redirect()->back()->withErrors("Estate Deleted Successfully");
            } else{
                \Session::put('red', true);
                return redirect()->back()->withErrors("Estate Not Found");
            }
        } catch(\Exception $e){
            \Session::put('red', true);
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function createPremium(Request $request){
        try{
            $body = $request->except('_token');

            $validation = $this->validate->premium($body, "create");

            if($validation->fails()){
                $errorMessages = $this->helper->formatErrors($validation->getMessageBag()->messages());

                \Session::put("red", true);
                return redirect()->back()->withErrors($errorMessages);
            } else {

                $data = [

                    "name" => $body["name"],
                    "size" => $body["size"],
                    "companyId" => $body["companyId"],
                    "noOfPlots" => $body["noOfPlots"],
                    "amount" => $body["amount"],
                    "bio" => $body["bio"],
                    "additionalFees" => $body["additionalFees"],
                    "address" => $body["address"],
                    "state" => $body["state"],
                    "country" => $body["country"],
                    "rules" => $body["rules"],
                    "description" => $body["description"],
                    "slug" => str_random(10),
                ];

                $estateId = $this->premium->create($data)->id;

                for($i=0; $i<count($body["images"]); $i++){
                    $helperRet = $this->helper->uploadFile($body["images"][$i], "propertyImage");

                    $params = [
                        "itemId" => $estateId,
                        "image" => $helperRet["file"],
                    ];
                    premiumImg::create($params);
                }


                \Session::put('green', true);
                return redirect()->back()->withErrors("Premium Investment Created Successfully");
            }
        } catch(\Exception $e){
            \Session::put('red', true);
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function deletePremium(Request $request){
        try{
            $body = $request->except('_token');

            $est = $this->premium->where('slug', $body["slug"]);
            $getEstate = $est->first();

            if($getEstate !== null){
                $est->delete();
                \Session::put('green', true);
                return redirect()->back()->withErrors("Premium Investment Deleted Successfully");
            } else{
                \Session::put('red', true);
                return redirect()->back()->withErrors("Premium Investment Not Found");
            }
        } catch(\Exception $e){
            \Session::put('red', true);
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
}

