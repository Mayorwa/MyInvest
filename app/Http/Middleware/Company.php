<?php

namespace App\Http\Middleware;

use App\Models\landTrnx;
use App\Models\Property;
use App\Models\Transaction;
use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\Company  as Comp;
use App\Models\Estate;

class Company
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    private $landTrnx;
    private $transaction;
    private $company;
    public function __construct(landTrnx $landTrnx, Transaction $transaction, Comp $company) {
        $this->landTrnx = $landTrnx;
        $this->company = $company;
        $this->transaction = $transaction;
    }
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            if(auth()->user()->type == "company"){
                $noOfTrans = [];
                $purChased = $this->landTrnx->where('userId', auth()->user()->id)->get();
                $noOfComp = [];
                $companyInfo = $this->company->where('userId', auth()->user()->id)->first();

                $estates = Estate::where("companyId", $companyInfo->id)->get();

                foreach ($estates as $estate){
                    $allTrnx = $this->landTrnx->where('itemId', $estate->id)->get();
                    $allcTrnx = $this->landTrnx->where(['isCompleted' => true,'itemId' => $estate->id])->get();

                    foreach ($allcTrnx as $trnx){
                        array_push($noOfComp, $trnx);
                    }

                    foreach ($allTrnx as $trnx){
                        array_push($noOfTrans, $trnx);
                    }
                }
                view()->share('noOfComp', $noOfComp);
                view()->share('noOfTrans', $noOfTrans);
                view()->share('purChased', $purChased);
                return $next($request);
            }
            return redirect('auth/logout');
        }
        return redirect('/');
    }
}
