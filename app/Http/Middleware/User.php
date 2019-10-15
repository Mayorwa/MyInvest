<?php

namespace App\Http\Middleware;

use App\Models\landTrnx;
use App\Models\Property;
use App\Models\Transaction;
use Closure;
use Illuminate\Support\Facades\Auth;

class User
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
    private $property;

    public function __construct( landTrnx $landTrnx, Transaction $transaction, Property $property) {
        $this->property = $property;
        $this->landTrnx = $landTrnx;
        $this->transaction = $transaction;
    }
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            if(auth()->user()->type == "user"){
                $purChased = $this->landTrnx->where('userId', auth()->user()->id)->get();
                $noOfTrans = $this->transaction->where('userId', auth()->user()->id)->get();
                $noOfComp = $this->landTrnx->where(['userId'=> auth()->user()->id, 'isCompleted' => true])->get();
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
