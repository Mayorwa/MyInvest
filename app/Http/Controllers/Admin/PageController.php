<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Company;
use App\Models\Estate;
use App\Models\Transaction;
use App\Models\landTrnx;
use App\Models\Property;
use App\Models\premium;
use App\Models\Agency;

class PageController extends Controller
{
    //
    private $user;
    private $company;
    private $estate;
    private $transaction;
    private $property;
    private $landtrnx;
    private $agency;
    private $premium;

    public function __construct(User $user, Company $company, Estate $estate, Transaction $transaction, Property $property, landTrnx $landtrnx, Agency $agency, premium $premium) {
        $this->user = $user;
        $this->company = $company;
        $this->estate = $estate;
        $this->transaction = $transaction;
        $this->property = $property;
        $this->landtrnx = $landtrnx;
        $this->agency = $agency;
        $this->premium = $premium;
    }

//    FETCH ALL PAGES
        public function index(Request $request){
            try {
                $users = $this->user->take(10)->latest()->get();
                $estates = $this->estate->take(10)->latest()->get();
                $properties = $this->property->take(10)->latest()->get();

                if ($properties !== []) {
                    foreach ($properties as $key => $property) {
                        $property->image = $property->image();
                        $property->metaData = [
                            'estate' => $property->estate(),
                        ];
                    }
                }


                $getCompanies = $this->company->take(10)->latest()->get();

                $companies = [];

                if ($getCompanies !== []){
                    foreach ($getCompanies as $key => $company) {
                        $company->metaData = [
                            'user' => $company->user(),
                        ];
                        array_push($companies, $company);
                    }
                 }

                $data = [
                    'title' => 'Admin: Index',
                    'users' => $users,
                    'companies' => $companies,
                    'properties' => $properties,
                    'estates' => $estates,
                    ];
                return view('admin.index',$data);

            } catch(\Exception $e){
                \Session::put('red', true);
                return redirect('/')->withErrors($e->getMessage());
            }
        }

        public function users(Request $request){
            try{
                $users = $this->user->latest()->paginate(14);
                $data = [
                    'title' => 'Admin: Users',
                    'users' => $users
                ];

    //            dd($users);
                return view('admin.user',$data);

            } catch(\Exception $e){
                \Session::put('red', true);
                return redirect('/')->withErrors($e->getMessage());
            }
        }

        public function companies(Request $request){
            try{
                $getCompanies = $this->company->latest()->paginate(14);


                foreach ($getCompanies as $key => $company){
                    $company->metaData = [
                        'user' => $company->user(),
                    ];
                }
                $data = [
                    'title' => 'Admin: Companies',
                    'companies' => $getCompanies
                ];
                return view('admin.company',$data);

            } catch(\Exception $e){
                \Session::put('red', true);
                return redirect()->back()->withErrors($e->getMessage());
            }
        }

        public function estates(Request $request){
            try{
                $estates = $this->estate->where('isActive', true)->latest()->paginate(14);

                foreach ($estates as $key => $property){
                    $property->image = $property->image();
                }

                $companies = $this->company->latest()->get();

                $data = [
                    'title' => 'Admin: Estates',
                    'estates' => $estates,
                    'companies' => $companies,
                ];
                return view('admin.estate',$data);

            } catch(\Exception $e){
                \Session::put('red', true);
                return redirect()->back()->withErrors($e->getMessage());
            }
        }

        public function premium(Request $request){
        try{
            $premiums = $this->premium->where('isActive', true)->latest()->paginate(14);

            foreach ($premiums as $key => $property){
                $property->image = $property->image();
            }

            $companies = $this->company->latest()->get();

            $data = [
                'title' => 'Admin: Premium Investment',
                'premiums' => $premiums,
                'companies' => $companies,
            ];
            return view('admin.premium',$data);

        } catch(\Exception $e){
            \Session::put('red', true);
            return redirect()->back()->withErrors($e->getMessage());
        }
    }


        public function transactions(Request $request){
            try{

//                dd("Hi");
                $landtrnxs = $this->landtrnx->latest()->paginate(14);


                foreach ($landtrnxs as $transaction){
//                dd($transaction);
                    $transaction->user = $transaction->user();

                    $transaction->transactions = $this->transaction->where(['userId' => $transaction->userId, "itemId" => $transaction->itemId])->get();
                    $transaction->estate = $transaction->estate($transaction->itemId);

                    $transaction->amountinTotal = $transaction->transactions[0]->amount * $transaction->cycle;

                    $getAgent = $this->agency->where("id",$transaction->referredId)->first();
                    if($getAgent !== null) {
                        $getAgent->user = $this->user->where('id', $getAgent->userId)->first();
                    }
                    $transaction->amountPaid = $transaction->transactions[0]->amount * $transaction->cycleCompleted;
                    $transaction->amountOutstand = ($transaction->transactions[0]->amount * $transaction->cycle) - ($transaction->transactions[0]->amount * $transaction->cycleCompleted);
                }
                $data = [
                    'title' => 'Admin: Transactions',
                    'transactions' => $landtrnxs,
                    'agent' => $getAgent,
                ];
                return view('admin.transaction',$data);

            } catch(\Exception $e){
                \Session::put('red', true);
                return redirect()->back()->withErrors($e->getMessage());
            }
        }

        public function properties(Request $request){
        try{
            $properties = $this->property->latest()->paginate(14);

            foreach ($properties as $key => $property){
                $property->image = $property->image();
//                $property->cycle = $property->amount / $property->cycleInMonths;
                $property->metaData = [
                    'estate' => $property->estate(),
                ];
            }

            $companies = $this->company->latest()->get();

            $estates = $this->estate->latest()->get();

            $data = [
                'title' => 'Admin: Estates',
                'properties' => $properties,
                'companies' => $companies,
                'estates' => $estates,
            ];
            return view('admin.property',$data);

        } catch(\Exception $e){
            \Session::put('red', true);
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
//    END FETCH ALL PAGES

//    FETCH ONE PAGES

    public function user(Request $request){
        try{
            $user = $this->user->where(["isDeleted" => false, "slug" => $request->islug])->first();
            $transactions = $this->landtrnx->where(["userId" => $user->id])->paginate(10);
            foreach ($transactions as $transaction){
//                dd($transaction);
                $transaction->transactions = $this->transaction->where(['userId' => $transaction->userId])->get();
                $transaction->estate = $transaction->estate($transaction->itemId);

                $transaction->amountinTotal = $transaction->transactions[0]->amount * $transaction->cycle;

                $getAgent = $this->agency->where("id",$transaction->referredId)->first();
                if($getAgent !== null) {
                    $getAgent->user = $this->user->where('id', $getAgent->userId)->first();
                }
                $transaction->amountPaid = $transaction->transactions[0]->amount * $transaction->cycleCompleted;
                $transaction->amountOutstand = ($transaction->transactions[0]->amount * $transaction->cycle) - ($transaction->transactions[0]->amount * $transaction->cycleCompleted);
            }
            $data = [
                'title' => 'Admin: User Info',
                'user' => $user,
                'agent' => $getAgent,
                'transactions' => $transactions,
            ];

            return view('admin.fetchOne.user',$data);

        } catch(\Exception $e){
            \Session::put('red', true);
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function company(Request $request){
        try{
            $company = $this->company->where(["slug" => $request->islug])->first();

            $company->metaData = [
                'user' => $company->user(),
                'estates' => $company->estates(),
            ];
            foreach($company->metaData["estates"] as $property){
                $property->image = $property->image();
            }
            $data = [
                'title' => 'Admin: Company Info',
                'company' => $company
            ];
            return view('admin.fetchOne.company',$data);

        } catch(\Exception $e){
            \Session::put('red', true);
            return redirect('/')->withErrors($e->getMessage());
        }
    }

    public function property(Request $request){
        try{
            $property = $this->property->where(["slug" => $request->islug])->first();
            $transactions = $this->landtrnx->where(["landId" => $property->id])->paginate(10);
            foreach ($transactions as $transaction){
                $transaction->user = $transaction->user();
                $transaction->estate = $transaction->estate($property->estateId);
            }

            $property->images = $property->images();
            $property->metaData = [
                'company' => $property->company(),
                'estate' => $property->estate(),
            ];

            $data = [
                'title' => 'Admin: Property Info',
                'property' => $property,
                'transactions' => $transactions,
            ];

            return view('admin.fetchOne.property',$data);

        } catch(\Exception $e){
            \Session::put('red', true);
            return redirect('/')->withErrors($e->getMessage());
        }
    }

    public function estate(Request $request){
        try{
            $estate = $this->estate->where(["isActive"=> true, "slug" => $request->islug])->first();
            $transactions = $this->landtrnx->where(["itemId" => $estate->id])->paginate(10);
            foreach ($transactions as $transaction){
                $transaction->user = $transaction->user();

                $transaction->transactions = $this->transaction->where(['userId' => $transaction->userId, "itemId" => $estate->id])->get();
                $transaction->estate = $transaction->estate($estate->id);

                $transaction->amountinTotal = $transaction->transactions[0]->amount * $transaction->cycle;

                $getAgent = $this->agency->where("id",$transaction->referredId)->first();
                if($getAgent !== null) {
                    $getAgent->user = $this->user->where('id', $getAgent->userId)->first();
                }
                $transaction->amountPaid = $transaction->transactions[0]->amount * $transaction->cycleCompleted;
                $transaction->amountOutstand = ($transaction->transactions[0]->amount * $transaction->cycle) - ($transaction->transactions[0]->amount * $transaction->cycleCompleted);
            }
            $estate->images = $estate->images();
            $estate->metaData = [
                'company' => $estate->company(),
            ];
//            dd($transactions);

            $data = [
                'title' => 'Admin: Estate Info',
                'estate' => $estate,
                'transactions' => $transactions,
                'agent' => $getAgent,
            ];

            return view('admin.fetchOne.estate',$data);

        } catch(\Exception $e){
            \Session::put('red', true);
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function premiumOne(Request $request){
        try{
            $premium = $this->premium->where(["isActive"=> true, "slug" => $request->islug])->first();


            $premium->images = $premium->images();
            $premium->metaData = [
                'company' => $premium->company(),
            ];
            $data = [
                'title' => 'Admin: Estate Info',
                'premium' => $premium,
            ];

            return view('admin.fetchOne.premium',$data);

        } catch(\Exception $e){
            \Session::put('red', true);
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function transaction(Request $request){
        try{
            $landtrnx = $this->landtrnx->where(["slug" => $request->islug])->first();

            if($landtrnx !== null){
                $transactions = $this->transaction->where(['userId' => $landtrnx->userId, 'itemId' => $landtrnx->itemId])->paginate(10);

                foreach ($transactions as $transaction){
                    $transaction->user = $transaction->user();
                    $transaction->token = $transaction->token();
                    $transaction->estate = $transaction->estate($transaction->itemId);
                }
                $data = [
                    'title' => 'Admin: Transaction Info',
                    'transactions' => $transactions,
                    "landTrnx" => $landtrnx,
                ];
                \Session::put('red', true);
                return view('admin.fetchOne.transaction',$data);
            } else{
                \Session::put('red', true);
                return redirect()->back()->withErrors("Transaction not found");
            }

        } catch(\Exception $e){
            \Session::put('red', true);
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

//    END FETCH ONE PAGES
}
