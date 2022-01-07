<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;


use App\Models\ClientData;
use App\Models\MerchantsData;

use App\Models\MerchantImages;
use DB;
use File;

use App\Models\TransectionAlpha;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

use Swift_Mailer;
use Swift_SmtpTransport;
use Mail;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //echo 'asdfasdf';exit;
        
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function RandomString()
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randstring = '';
        for ($i = 0; $i < 7; $i++) {
            $randstring .= $characters[rand(0, strlen($characters))];
        }
        return strtoupper($randstring);
    }

    public function index()
    {

        
  /*DB::table('users')->where('email','asdf2asdf@as.com')->update([
                   "email" => 'smalltime59@yahoo.com'
                   ]);
  */
/*
 $transport = new Swift_SmtpTransport('smtp.office365.com', 587, 'tls');
                $transport->setUsername('corporate@nextlayer.live');
                $transport->setPassword('bitcoin2020');
                // echo '11dddd';exit;
                $swift_mailer = new Swift_Mailer($transport);
                Mail::setSwiftMailer($swift_mailer);
                $data = ["name" => "Qaiser" , "email"=>"qaiser@stepinnsolution.com"];
                 $reciever_email = 'stepinnsolution@gmail.com';
                 $sender_email = 'corporate@nextlayer.live';
                 $subject = 'Email Verification Code';
                

                $data['verify_email_code'] = $this->RandomString();
                DB::table('users')->where('email','smalltime59@yahoo.com')->update([
                   "verify_email_code" => $data['verify_email_code']
                   ]);




                 
            
                Mail::send(['html'=>'emails.reset_password'], $data, function($message) use($reciever_email , $sender_email, $subject ) {
                    $message->to($reciever_email, 'Sample Message')->subject
                    ($subject);
                    $message->from($sender_email,$sender_email);
                });


*/

         $user = auth()->user()->merchant_id;

         if($user != null) {
             Auth::logout();
             return redirect('/login');
         }
        $merchant=MerchantsData::get()->count();
        $client=ClientData::get()->count();
        $Transection=Transaction::get()->count();
        // dd(Auth::user()->type);
        if(Auth::user()->type =='alpha'){
        $merchant_Transection=TransectionAlpha::where('merchant_id',Auth::user()->email)->get()->count();
        return view('dashboard',compact('merchant','client','Transection','merchant_Transection'));
        }
        return view('dashboard',compact('merchant','client','Transection'));
    }



     public function verify_email()
    {

         return view('verify_email');

    }


    
    
}
