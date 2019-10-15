<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\landTrnx;
use App\Models\Property;
use App\Models\Image;
use App\Models\Agency;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    private $landtrnx;
    private $property;
    private $transaction;
    private $agency;
    private $image;
    public function __construct(landTrnx $landtrnx, Property $property, Image $image, Transaction $transaction, Agency $agency){
        $this->landtrnx = $landtrnx;
        $this->property = $property;
        $this->agency = $agency;
        $this->image = $image;
        $this->transaction = $transaction;
    }

    //

    public function overview(Request $request){
        try{
            $user = Auth::user();
            $transactions = $this->landtrnx->where(["userId" => $user->id])->paginate(15);
            $lands = $this->landtrnx->where(["userId" => $user->id])->get();
            $completedTrnx = $this->landtrnx->where(["userId" => $user->id, "isCompleted" => true])->get();

            $estates = [];
            foreach ($transactions as $transaction){
                $transaction->user = $transaction->user();

                $transaction->transactions = $this->transaction->where(['userId' => $transaction->userId])->get();
                $transaction->estate = $transaction->estate($transaction->itemId);

                $transaction->amountinTotal = $transaction->transactions[0]->amount * $transaction->cycle;

                $getAgent = $this->agency->where("id",$transaction->referredId)->first();
                if($getAgent !== null) {
                    $getAgent->user = $user;
                }
                $transaction->amountPaid = $transaction->transactions[0]->amount * $transaction->cycleCompleted;
                $transaction->amountOutstand = ($transaction->transactions[0]->amount * $transaction->cycle) - ($transaction->transactions[0]->amount * $transaction->cycleCompleted);
            }
            if ($lands !== []){
                foreach ($lands as $land){
                    $estate = $land->estate($land->itemId);
                    $estate->image =  $estate->image();
                    array_push($estates, $estate);
                }
            }
//            dd($transactions);
            $data = [
                'title' => 'Dashboard: Overview',
                'page' => 'Overview',
                "estates" => $estates,
                "lands" => $lands,
                'agent' => $getAgent,
                "completedTrnx" => $completedTrnx,
                "transactions" => $transactions,
            ];

            return view('user.overview',$data);

        } catch(\Exception $e){
            \Session::put('red', true);
            dd($e->getMessage());
            return redirect('/')->withErrors($e->getMessage());
        }
    }
    public function profile(Request $request){
        try{

            $data = ['title' => 'Dashboard: Profile','page' => 'Profile'];
            return view('user.profile',$data);

        } catch(\Exception $e){
            \Session::put('red', true);
            return redirect('/')->withErrors($e->getMessage());
        }
    }
    public function settings(Request $request){
        try{

            $data = ['title' => 'Dashboard: Settings','page' => 'Settings'];
            return view('user.settings',$data);

        } catch(\Exception $e){
            \Session::put('red', true);
            return redirect('/')->withErrors($e->getMessage());
        }
    }
    public function cart(Request $request){
        try{

            $data = ['title' => 'Dashboard: Cart','page' => 'Cart'];
            return view('user.cart',$data);

        } catch(\Exception $e){
            \Session::put('red', true);
            return redirect('/')->withErrors($e->getMessage());
        }
    }
    public function transaction(Request $request){
        try{
            $user = Auth::user();

            $transactions = $this->landtrnx->where(["userId" => $user->id])->paginate(10);
            foreach ($transactions as $transaction){
                $transaction->user = $transaction->user();

                $transaction->transactions = $this->transaction->where(['userId' => $transaction->userId])->get();
                $transaction->estate = $transaction->estate($transaction->itemId);

                $transaction->amountinTotal = $transaction->transactions[0]->amount * $transaction->cycle;

                $getAgent = $this->agency->where("id",$transaction->referredId)->first();
                if($getAgent !== null) {
                    $getAgent->user = $user;
                }
                $transaction->amountPaid = $transaction->transactions[0]->amount * $transaction->cycleCompleted;
                $transaction->amountOutstand = ($transaction->transactions[0]->amount * $transaction->cycle) - ($transaction->transactions[0]->amount * $transaction->cycleCompleted);
            }
            $data = [
                'title' => 'Dashboard: Transaction',
                'page' => 'Transaction',
                'agent' => $getAgent,
                "transactions" => $transactions,
            ];
            return view('user.transactions',$data);

        } catch(\Exception $e){
            \Session::put('red', true);
            return redirect('/')->withErrors($e->getMessage());
        }
    }

    public function singleTrnx(Request $request){
        try{
            $user = Auth::user();

            $landtrnx = $this->landtrnx->where(['userId' => $user->id, "slug" => $request->slug])->first();

            if($landtrnx !== null){
                $transactions = $this->transaction->where(['userId' => $landtrnx->userId, 'itemId' => $landtrnx->itemId])->paginate(10);

                foreach ($transactions as $transaction){
                    $transaction->user = $transaction->user();
                    $transaction->token = $transaction->token();
                    $transaction->estate = $transaction->estate($transaction->itemId);
                }
                $data = [
                    'title' => 'Admin: Transaction Info',
                    'page' => 'Transaction:'. $request->slug,
                    'transactions' => $transactions,
                    "landTrnx" => $landtrnx,
                ];
                \Session::put('red', true);
                return view('user.singletrans',$data);
            } else{
                \Session::put('red', true);
                return redirect()->back()->withErrors("Transaction not found");
            }

        } catch(\Exception $e){
            \Session::put('red', true);
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
}
