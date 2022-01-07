<?php

namespace App\Http\Controllers;
use App\Models\Transaction;
use Illuminate\Http\Request;
use DB;

class TransactionController extends Controller
{
    public function getTransactions(){
        $data=Transaction::all();
        $status = DB::table('is_email_allow')->where('user_type', 'beta')->get();
        return view('transaction.transaction-home',compact('data'), compact('status'));
    }
    
    public function filterTransections(Request $request){
    $transection =  Transaction::query();
        if ($request["date_from"]){
            $transection->whereDate("created_at" ,'>=',$request["date_from"] );
        }
        if ($request["date_to"]){
            $transection->whereDate("created_at" ,'<=',$request["date_to"] );
        }
        $data = $transection->get();
        // dd($data);

        return view("transaction._transactions",compact('data'));    
    }
    
    
}
