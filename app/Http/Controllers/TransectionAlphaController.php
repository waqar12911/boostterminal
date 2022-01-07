<?php

namespace App\Http\Controllers;
use App\Models\TransectionAlpha;
use App\Models\MerchantsData;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class TransectionAlphaController extends Controller
{
   
  public function getTransactionsalpha(){
    
        $data=TransectionAlpha::where('merchant_id',Auth::user()->merchant_id)->get();
        return view('admin_settings.alpha-transection.transaction-home',compact('data'));
    }
    
    
    public function filterTransection(Request $request){
    $transection =  TransectionAlpha::query();
        if ($request["date_from"]){
            $transection->whereDate("created_at" ,'>=',$request["date_from"] );
        }
        if ($request["date_to"]){
            $transection->whereDate("created_at" ,'<=',$request["date_to"] );
        }
        $data = $transection->get();
        // dd($data);

        return view("admin_settings.alpha-transection._transactions",compact('data'));    
    }

    
    
}
