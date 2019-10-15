<?php

namespace App\Http\Controllers\Agency;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    //
    public function overview(Request $request){
        try{

            $data = ['title' => 'Dashboard: Overview','page' => 'Overview'];
            return view('agency.overview',$data);

        } catch(\Exception $e){
            \Session::put('red', true);
            return redirect('/')->withErrors($e->getMessage());
        }
    }
    public function profile(Request $request){
        try{

            $data = ['title' => 'Dashboard: Profile','page' => 'Profile'];
            return view('agency.profile',$data);

        } catch(\Exception $e){
            \Session::put('red', true);
            return redirect('/')->withErrors($e->getMessage());
        }
    }
    public function settings(Request $request){
        try{
//dd("Calm");
            $data = ['title' => 'Dashboard: Settings','page' => 'Settings'];
            return view('agency.settings',$data);

        } catch(\Exception $e){
            \Session::put('red', true);
            return redirect('/')->withErrors($e->getMessage());
        }
    }
    public function transaction(Request $request){
        try{

            $data = ['title' => 'Dashboard: Transaction','page' => 'Transaction'];
            return view('agency.transactions',$data);

        } catch(\Exception $e){
            \Session::put('red', true);
            return redirect('/')->withErrors($e->getMessage());
        }
    }
}
