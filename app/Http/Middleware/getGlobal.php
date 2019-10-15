<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class getGlobal
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    private $user;
    public function __construct(User $user) {
        $this->user = $user;
    }
    public function handle($request, Closure $next)
    {
        $usr = Auth::user();
        if($usr !== null){
            if($usr->type == "company"){
                $user = $this->user->where('id', $usr->id)->first();
                $user->company = $user->company($usr->id);
                view()->share('usr', $user);
            }
            elseif($usr->type == "user") {
                view()->share('usr', $usr);
            }
            elseif($usr->type == "consultant" || $usr->type == "realtor") {
                $user = $this->user->where('id', $usr->id)->first();
                $user->agency = $user->agency($usr->id);
//                dd($user);
                view()->share('usr', $user);
            }
            else{
                view()->share('usr', $usr);
            }
        } else{
            view()->share('usr', $usr);
        }

        return $next($request);
    }
}
