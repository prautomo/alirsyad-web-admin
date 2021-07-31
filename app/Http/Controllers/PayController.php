<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use App\Services\PaymentService;

class PayController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->prefix = 'pages.frontoffice.pay';
        $this->routePath = 'frontoffice::pay';
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['paymentMethods'] = PaymentMethod::where('is_enabled', 1)->get();

        return view('pages.frontoffice.pay', $data);
    }

    public function store(Request $request){
        // validasi form
        $this->validate($request, [
            'paymentMethod' => 'required'
        ]);
        
        $paymentMethod = PaymentMethod::findOrFail($request->paymentMethod);

        $ret = PaymentService::requestPayment($paymentMethod);
        
        if(@$ret->Status == 200) {
            $sessionId  = $ret->Data->SessionID;
            $url        =  $ret->Data->Url;
            return redirect()->away($url);
        } else {
            dd($ret);
        }

        // return redirect()->route($this->routePath.'.index')->with(
        //     $this->success(__("Success to create Brand"), $data)
        // );
    }
}
