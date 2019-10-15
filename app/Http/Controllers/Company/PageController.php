<?php

namespace App\Http\Controllers\Company;

use App\Models\Estate;
use App\Models\Company;
use App\Models\Property;
use App\Models\landTrnx;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Agency;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    //
    //
    private $estate;
    private $company;
    private $property;
    private $landTranx;
    private $transaction;
    private $user;
    private $agency;
    public function __construct(Estate $estate, Company $company, Property $property, landTrnx $landTranx, User $user, Transaction $transaction, Agency $agency) {
        $this->estate = $estate;
        $this->property = $property;
        $this->company = $company;
        $this->landTranx = $landTranx;
        $this->transaction = $transaction;
        $this->user = $user;
        $this->agency = $agency;
    }

    public function getCompanyInfo(){
        $userInfo = Auth::user();
        $companyInfo = $this->company->where('userId', $userInfo->id)->first();
        return $companyInfo;
    }

    public function register(Request $request){
        try{

            if(\Session::has('email')){
//                \Session::forget('email');
//                dd(\Session::get('email'));
                $data = ['title' => 'Register: Company'];
                return view('auth.register',$data);
            } else{
                return redirect('/auth/get-access');
            }
        } catch(\Exception $e){
            \Session::put("red", true);
            return redirect('/')->withErrors($e->getMessage());
        }
    }

    public function overview(Request $request){
        try{
            $companyId = $this->getCompanyInfo()->id;
            $estates = $this->estate->where('companyId',$companyId)->latest()->paginate(4);

            foreach ($estates as $key => $property){
                $property->image = $property->image();
            }

            $data = ['title' => 'Company: Overview','page' => 'Overview', 'estates' => $estates];
            return view('dashboard.overview',$data);

        } catch(\Exception $e){
            \Session::put('red', true);
            return redirect('/')->withErrors($e->getMessage());
        }
    }

    public function profile(Request $request){
        try{

            $data = ['title' => 'Company: Profile','page' => 'Profile'];
            return view('dashboard.profile',$data);

        } catch(\Exception $e){
            \Session::put('red', true);
            return redirect('/')->withErrors($e->getMessage());
        }
    }

    public function settings(Request $request){
        try{

            $data = ['title' => 'Dashboard: Settings','page' => 'Settings'];
            return view('dashboard.settings',$data);

        } catch(\Exception $e){
            \Session::put('red', true);
            return redirect('/')->withErrors($e->getMessage());
        }
    }

    public function estate(Request $request){
        try{
            $companyId = $this->getCompanyInfo()->id;
            $estates = $this->estate->where('companyId',$companyId)->latest()->paginate(15);

            foreach ($estates as $key => $property){
                $property->image = $property->image();
            }

            $data = ['title' => 'Dashboard: Estate','page' => 'Estate','estates' => $estates];
            return view('dashboard.estate',$data);

        } catch(\Exception $e){
            \Session::put('red', true);
            return redirect('/')->withErrors($e->getMessage());
        }
    }

    public function Oneestate(Request $request){
        try{
            $estates = $this->estate->where('slug',$request->slug)->first();

            $estates->images = $estates->images();

            $transactions = $this->landTranx->where(["itemId" => $estates->id])->paginate(10);
            foreach ($transactions as $transaction){
                $transaction->user = $transaction->user();

                $transaction->transactions = $this->transaction->where(['userId' => $transaction->userId, "itemId" => $estates->id])->get();
                $transaction->estate = $transaction->estate($estates->id);

                $transaction->amountinTotal = $transaction->transactions[0]->amount * $transaction->cycle;

                $getAgent = $this->agency->where("id",$transaction->referredId)->first();
                if($getAgent !== null) {
                    $getAgent->user = $this->user->where('id', $getAgent->userId)->first();
                }
                $transaction->amountPaid = $transaction->transactions[0]->amount * $transaction->cycleCompleted;
                $transaction->amountOutstand = ($transaction->transactions[0]->amount * $transaction->cycle) - ($transaction->transactions[0]->amount * $transaction->cycleCompleted);
            }
            $data = ['title' => 'Dashboard: Estate','page' => 'Estate','estate' => $estates, 'transactions' => $transactions, 'agent' => $getAgent];
            return view('dashboard.single.estate',$data);

        } catch(\Exception $e){
            \Session::put('red', true);
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function transaction(Request $request){
        try{

            $data = ['title' => 'Dashboard: Transaction','page' => 'Transaction'];
            return view('dashboard.transaction',$data);

        } catch(\Exception $e){
            \Session::put('red', true);
            return redirect('/')->withErrors($e->getMessage());
        }
    }
}

