<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Company;
use App\Models\Transaction;
use App\Models\Property;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    private $user;
    private $company;
    private $transaction;
    private $property;

    public function __construct(User $user, Company $company, Transaction $transaction, Property $property) {
        $this->user = $user;
        $this->property = $property;
        $this->company = $company;
        $this->transaction = $transaction;
    }

    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            if(auth()->user()->type == "admin"){
                $users = $this->user->get();
                $companies = $this->company->get();
                $properties = $this->property->get();
                $transactions = $this->transaction->get();
                view()->share('allUsers', $users);
                view()->share('allCompany', $companies);
                view()->share('allProperties', $properties);
                view()->share('allTransactions', $transactions);
                return $next($request);
            }
            return redirect('auth/logout');
        }
        return redirect('auth/login');
    }
}

