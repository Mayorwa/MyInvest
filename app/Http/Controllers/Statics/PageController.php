<?php

namespace App\Http\Controllers\Statics;

use App\Models\Estate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Http\Helpers\sendMail;
use App\Models\premium;

class PageController extends Controller
{
    //
    private $property;
    private $mail;
    private $estate;
    private $premium;
    public function __construct(Property $property,sendMail $mail, Estate $estate, premium $premium) {
        $this->property = $property;
        $this->mail = $mail;
        $this->estate = $estate;
        $this->premium = $premium;
    }
    public function terms()
    {
        $data = ['title' => 'Terms and Conditions','page' => 'Terms and Conditions'];
        return view('static.terms',$data);
    }
    public function listings()
    {
        $estates = $this->estate->where('isActive', true)->paginate(15);
        foreach ($estates as $key => $property){
            $property->image = $property->image();
        }
//        dd($properties);
        $data = ['title' => 'Listings','page' => 'Listings', 'estates' => $estates];
        return view('static.listing',$data);
    }
    public function listing(Request $request)
    {

        $estate = $this->estate->where(['isActive' => true, 'slug' => $request->slug])->first();

        $estate->images = $estate->images();

        $estate->metaData = [
            'company' => $estate->company(),
            'inst' => $estate->inst(),
        ];

        $data = ['title' => 'Listing','page' => 'Listing', 'estate' => $estate];

        return view('static.fetchOne.listing',$data);
    }
    public function home(Request $request)
    {
        $estates = $this->estate->get();

        $highProps = $this->premium->latest()->paginate(10);

        $ranges["max"] = $this->estate->max('amount');
        $ranges["min"] = $this->estate->min('amount');
        $properties = $this->estate->paginate(15);
        $highProp = $this->estate->orderBy('amount')->paginate(4);
        foreach ($properties as $key => $property){
            $property->image = $property->image();
        }


        foreach($highProps as $premium){
            $premium->image = $premium->image();
        }
//        dd($highProps);
        $data = ['title' => 'MyyInvest','page' => 'Home', 'properties' => $properties, 'ranges' => $ranges, 'estates' => $estates, 'highProps' => $highProps];
        return view('static.home',$data);
    }

    public function premium(Request $request)
    {

        $premium = $this->premium->where(['isActive' => true, 'slug' => $request->slug])->first();

        $premium->images = $premium->images();

        $premium->metaData = [
            'company' => $premium->company(),
        ];

        $data = ['title' => 'Premium Property','page' => 'Premium Property', 'premium' => $premium];

        return view('static.fetchOne.premium',$data);
    }

    public function contact(Request $request)
    {
        $var = null;
        if($request->has('q')){
            $var = $this->premium->where('slug', $request->q)->first();
        }


        $data = ['title' => 'MyyInvest: Contact Us','page' => 'Contact Us', 'pre' => $var];
        return view('static.contact',$data);
    }
    public function investment(Request $request)
    {

        $data = ['title' => 'MyyInvest: Investment Flow','page' => 'Investment Flow',];
        return view('static.investment-flow',$data);
    }
    public function submitForm(Request $request){
        try{
            $data = $request->except('_token');
            $this->mail->sendContactUs($data);
            \Session::put('green', 1);

            return redirect()->back()->withErrors("Response Sent Successfully");
        }catch(\Exception $e){
            \Session::put("red", true);
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
}
