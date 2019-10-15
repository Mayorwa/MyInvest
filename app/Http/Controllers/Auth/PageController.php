<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Company;
class PageController extends Controller
{
    //
    private $company;
    public function __construct(Company $company){
        $this->company = $company;
    }

    public function SignInPage(Request $request){
        try{
            if(Auth::check())
            {
                return redirect('/');
            } else {
                $data = ['title' => 'Log In'];
                return view('auth.login',$data);

            }
        } catch(\Exception $e){
            \Session::put("red", true);
            return redirect('/')->withErrors($e->getMessage());
        }
    }

    public function getAccess(Request $request){
        try{
            if(!\Session::has('email')){
                $data = ['title' => 'Get Acccess'];
                return view('auth.getc',$data);
            } else{
                return redirect('/auth/register');
            }
        } catch(\Exception $e){
            \Session::put("red", true);
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function agencyRegister(Request $request){
        try{
            if(Auth::check())
            {
                return redirect('/');
            } else {
                $companies = $this->company->get();
                $data = ['title' => 'Agents Registration', 'companies' => $companies];
                return view('auth.agency',$data);

            }
        } catch(\Exception $e){
            \Session::put("red", true);
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
}
