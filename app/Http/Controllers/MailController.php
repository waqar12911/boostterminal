<?php

namespace App\Http\Controllers;

use App\Models\FundingNode;
use App\Models\MerchantsData;
use App\Models\Transaction;
use App\Models\TransectionAlpha;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use DB;
use Session;
use Swift_Mailer;
use Swift_SmtpTransport;
use Auth;




class MailController extends Controller
{
	public function merchantRequestNewMemberToken($id)
    {
      	
        $user=DB::table('merchants_data')->where('id',$id)->first();
        $transport = new Swift_SmtpTransport('mail.nextlayer.live', 587, 'tls');
        $transport->setUsername('outgoing@nextlayer.live');
        $transport->setPassword('Bitcoin2020$');
        $swift_mailer = new Swift_Mailer($transport);
        Mail::setSwiftMailer($swift_mailer);
        $data = ["name" => "Qaiser" , "email"=>"qaiser@stepinnsolution.com"];
        $reciever_email = $user->email;
        $sender_email = 'outgoing@nextlayer.live';
        $subject = 'Token Renewal Authorization Request ';


        $data['code'] = $this->generate2faCode();
        DB::table('merchants_data')->where('email',$user->email)->update([
          "2fa_code" => $data['code']
        ]);
        Mail::send(['html'=>'emails.send2faMail'], $data, function($message) use($reciever_email , $sender_email, $subject ) {
          $message->to($reciever_email)->subject($subject);
          $message->from($sender_email);
          $message->cc('muhammadwaqar12911@gmail.com');
        });
      return back()->with('sent', '2fa Code has been sent');
    }
  
  	public function generate2faCode()
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randstring = '';
        for ($i = 0; $i < 5; $i++) {
            $randstring .= $characters[rand(0, strlen($characters)-1)];
        }
        return strtoupper($randstring);
    }
  
  	public function merchantVerify2faCode(Request $request)
    {
        $user=DB::table('merchants_data')->where('id',$request->id)->first();
        $query=DB::table('merchants_data')->where('email',$user->email)->where('2fa_code', $request->code)->first();
        if($query)
        {
          return back()->with('success', '2fa Code Verified');
        }
      	else
        {
          return back()->with('fail', '2fa Code is InValid');
        }
    }
  



    //   allow the auto email or manual set 
    public function isEmailAllow(Request $request){
        $type = $request->type;
        $userType = $request->userType;
        $emailStatus = $request->emailStatus;
        $isUpdate = DB::table('is_email_allow')->where('type', $type)->where('user_type', $userType)->update([
        'is_email'=>$emailStatus
            ]);
            
           if($isUpdate){
               if($emailStatus == 'auto'){
                   return 'auto';
               }else{
                   return 'manual';
               }
               
           }else{
               return 'no';
           }
    }
 


    // send transaction data to manual email (this function is not usable)
    public function bootManualEmail(Request $request){
            $eMail = $request->bootEmail;
            $searchIDs =  json_decode($request->searchIDs, true);
        
         $arryData = [];
        foreach($searchIDs as $ids){
            $transactionData = DB::table('transactions')->where('id',$ids)->get();
            array_push($arryData, $transactionData);
        }
        $myArray = [
                [
                'Id', 'Transaction Label', 'Transaction Id', 'Transaction AmountBTC', 'Client Remaining', 'Merchan Remaining', 'Transaction AmountUSD',
                'Conversion Rate', 'Transaction ClientId', 'Transaction MerchantId', 'Transaction Timestamp', 'Created At', 'Updated At'
                ]
            ];
        
        
        foreach ($arryData as $value) {
            foreach ($value as $key => $follower) {
                    unset($key);
                     array_push($myArray ,(array)$follower);
            }
        }

        $fp = fopen('file.csv', 'w');
      foreach ($myArray as $fields) {
          fputcsv($fp, $fields);
      }
      fclose($fp);
 
        // $to_name = "sisapps@stepinnsolution.com";
        $to_email = $eMail;
        $data = array(['name'=>'this is name','body'=>'this is body']);
        $doneEmail = Mail::send('email_templates.daily_beta', $data, function($message) use ($to_email) {
           $message->to($to_email)
               ->subject('C lightning Boost daily');
          $message->from("nextlayertechnology@gmail.com");
          $message->attach('file.csv');
        //   $message->cc('ajmalg08@gmail.com');
        });
      
        if($eMail){
            return $eMail;
        }
       
    }
    
    /** function for daily manual report*/
    public function dailyManualEmail(Request $request){
        $customEmail = $request->dailyEmail;
        $arr = $request->searchIds;
        $searchIDs = explode(',',$arr[0]);
        $arryData = [];
        foreach($searchIDs as $ids){
           
            $transactionData = DB::table('transactions')->where('id',$ids)->get();
            array_push($arryData, $transactionData);
        }
        $myArray = [
               [
                'Id', 'Transaction Label', 'Transaction Id', 'Transaction AmountBTC', 'Client Remaining', 'Merchant Remaining', 'Transaction AmountUSD',
                'Conversion Rate', 'Transaction ClientId', 'Transaction MerchantId', 'Transaction Timestamp', 'Created At', 'Updated At'
                ]
            ];
        foreach ($arryData as $value) {
            foreach ($value as $key => $follower) {
                    unset($key);
                     array_push($myArray ,(array)$follower);
            }
        }
      $fp = fopen('file.csv', 'w');
      foreach ($myArray as $fields) {
          fputcsv($fp, $fields);
      }
      fclose($fp);
      
      
        $now = Carbon::now();
        $currentDate = $now->toDateString();
        
        // $to_name = "sisapps@stepinnsolution.com";
        $to_email = $customEmail;
        $data = ['currentDate'=>"$currentDate"];
        $doneEmail = Mail::send(['html'=>'email_templates.custom_report'], $data, function($message) use ($to_email) {
           $message->to($to_email)
               ->subject('C lightning Boost daily');
          $message->from("nextlayertechnology@gmail.com");
          $message->attach('file.csv');
        //   $message->cc('ajmalg08@gmail.com');
        });
        
    return redirect('get-transactions')->with('message', 'Your Custom email has sent successfully');
    }
    
    /** function for sending the weekly manual report */
    public function weeklyManualEmail(Request $request){
        $weekMail = $request->weekMail;
        $weekStart = $request->weekStart;
        $weekEnd = $request->weekEnd;
        
        // $datetime1 = strtotime($weekStart); // convert to timestamps
        // $datetime2 = strtotime($weekEnd); // convert to timestamps
        // $days = (int)(($datetime2 - $datetime1)/86400);
       
        // if($days > 7){
        //     return redirect()->back()->with('message', 'Please choose date less than or equal to 7 days');
        // }else{
        $dateS = new Carbon($weekStart);
        $dateE = new Carbon($weekEnd);
        $data = DB::table('transactions')->whereBetween('created_at', [$dateS->format('Y-m-d')." 00:00:00", $dateE->format('Y-m-d')." 23:59:59"])->get();
       
        if($data->isEmpty()){
            return redirect()->back()->with('message', 'There is no record related to this dates');
        }
        
         $myArray = [
               [
                'Id', 'Transaction Label', 'Transaction Id', 'Transaction AmountBTC', 'Client Remaining', 'Merchant Remaining', 'Transaction AmountUSD',
                'Conversion Rate', 'Transaction ClientId', 'Transaction MerchantId', 'Transaction Timestamp', 'Created At', 'Updated At'
                ]
            ];
        foreach($data as $object)
            {
                $myArray[] =  (array) $object;
            }
            
      $fp = fopen('file.csv', 'w');
      foreach ($myArray as $fields) {
          fputcsv($fp, $fields);
      }
      fclose($fp);
      
        
      
    //   $to_name = "sisapps@stepinnsolution.com";
        $to_email = $weekMail;
        $data = array('weekStart'=> "$weekStart", 'weekEnd' => "$weekEnd");
        $doneEmail = Mail::send(['html'=>'email_templates.weekly_manual_report'], $data, function($message) use ($to_email) {
           $message->to($to_email)
               ->subject('C lightning Boost Weekly');
          $message->from("nextlayertechnology@gmail.com");
          $message->attach('file.csv');
        //   $message->cc('ajmalg08@gmail.com');
        });

    return redirect('get-transactions')->with('message', 'Your Weekly manual email has sent successfully');
        
       
        // }
    }
    
    
//   Beta dashBoard mails Autometic
     public function daily_mails(){
                $merchants=Transaction::all();
                $uniq_data=$merchants->unique('transaction_merchantId')->toArray();
                
               foreach ($uniq_data as $key=>$uniq){
                  $user_data[$key]['id']=$uniq['transaction_merchantId'];
                  $user_data[$key]['email']=MerchantsData::where('merchant_name',$uniq['transaction_merchantId'])->pluck('email')->first();
           
                 }
            
            
            //check if auto email is allow or not
                
                    $emailAllow = DB::table('is_email_allow')->where('user_type', 'beta')->where('type', 'daily')->where('is_email', 'auto')->get();
                    $isEmail = $emailAllow[0]->is_email;
                    if($isEmail == "auto"){
            
               foreach ($user_data as $useremail){
                    if($useremail['email'] != null){
                   $data1=Transaction::orderBy('created_at', 'DESC')
                       ->where('transaction_merchantId',$useremail['id'])
                       ->whereDate('created_at', '=', Carbon::today()->toDateString())->get()->toArray();
            //            ddd($data1);
            
                   
            
                   $fp = fopen('file.csv', 'w');
            
                   foreach ($data1 as $fields) {
                       fputcsv($fp, $fields);
                   }
                   fclose($fp);
                   
                   
                    $boostAdminDetail = DB::table('admin_email')->where('type', 'Periodic Reports Email')->first();
                    $adminEmail = $boostAdminDetail->admin_email;
                   
                    
                    $now = Carbon::now();
                    $currentDate = $now->toDateString();
                   
                  $to_email = $useremail['email'];
                  $data = ['currentDate'=>"$currentDate"];
                  Mail::send('email_templates.daily_beta', $data, function($message) use ($to_email, $adminEmail) {
                      $message->to($to_email, $adminEmail)
                          ->subject('C lightning Boost daily');
                      $message->from("nextlayertechnology@gmail.com");
                      $message->attach('file.csv');
                      $message->cc($adminEmail);
                  });
                }
               }
               
            
             }
               
          }
  
     public function weekly_mails(){
         
                $merchants=Transaction::all();
                $uniq_data=$merchants->unique('transaction_merchantId')->toArray();
            //     dd($uniq_data);
               foreach ($uniq_data as $key=>$uniq){
                   $user_data[$key]['id']=$uniq['transaction_merchantId'];
                  $user_data[$key]['email']=MerchantsData::where('merchant_name',$uniq['transaction_merchantId'])->pluck('email')->first();

                 }
            
                    //checking if the weekly email auto is allwo or not
                    $emailAllow = DB::table('is_email_allow')->where('user_type', 'beta')->where('type', 'weekly')->where('is_email', 'auto')->get();
                    $isEmail = $emailAllow[0]->is_email;
                    if($isEmail == "auto"){
            
                    foreach ($user_data as $useremail){
                    if($useremail['email'] != null){
                    $data1=Transaction::orderBy('created_at', 'DESC')
                       ->where('transaction_merchantId',$useremail['id'])
                       ->whereDate('created_at', '>', \Carbon\Carbon::now()->subWeek())->get()->toArray();
            //            ddd($data1);
            
                   $fp = fopen('file.csv', 'w');
                   foreach ($data1 as $fields) {
                   fputcsv($fp, $fields);
                   }
            
                   fclose($fp);
                   
                    $boostAdminDetail = DB::table('admin_email')->where('type', 'Periodic Reports Email')->first();
                    $adminEmail = $boostAdminDetail->admin_email;
                   
                    $now = Carbon::now();
                    $currentDate = $now->toDateString();
                    $week = $now->weekOfYear;
                    $month = $now->month;
                    $year = $now->year;
                   
                   $to_email = $useremail['email'];
                   $data = ['currentDate'=>"$currentDate"];
                //   $data = ['week'=>"$week",'month'=>"$month", 'year'=>"$year"];
                   Mail::send('email_templates.weekly_beta', $data, function($message) use ($to_email, $adminEmail) {
                       $message->to($to_email, $adminEmail)
                           ->subject('C lightning Boost Weekly');
                       $message->from("nextlayertechnology@gmail.com");
                       $message->attach('file.csv');
                      $message->cc($adminEmail);
                   });
                
                        
                 }
               }
               
            }
      }
    
     public function monthly_mails(){
             
            $merchants=Transaction::all();
            $uniq_data=$merchants->unique('transaction_merchantId')->toArray();
    //     dd($uniq_data);
           foreach ($uniq_data as $key=>$uniq){
               $user_data[$key]['id']=$uniq['transaction_merchantId'];
              $user_data[$key]['email']=MerchantsData::where('merchant_name',$uniq['transaction_merchantId'])->pluck('email')->first();
    
             }
    
            /** checking if monthly auto email is allow */
             $emailAllow = DB::table('is_email_allow')->where('user_type', 'beta')->where('type', 'monthly')->where('is_email', 'auto')->get();
            $isEmail = $emailAllow[0]->is_email;
            if($isEmail == "auto"){
    
            foreach ($user_data as $useremail){
            if($useremail['email'] != null){
               $data1=Transaction::orderBy('created_at', 'DESC')
                   ->where('transaction_merchantId',$useremail['id'])
                   ->whereDate('created_at', '>', \Carbon\Carbon::now()->subMonth())->get()->toArray();
        //            ddd($data1);
               $fp = fopen('file.csv', 'w');
    
               foreach ($data1 as $fields) {
                   fputcsv($fp, $fields);
               }
    
           fclose($fp);
           
             $boostAdminDetail = DB::table('admin_email')->where('type', 'Periodic Reports Email')->first();
             $adminEmail = $boostAdminDetail->admin_email;
            
            
            $now = Carbon::now();
            $currentDate = $now->toDateString();
            $week = $now->weekOfYear;
            $month = $now->format('F');
            $year = $now->year;
           
           $to_email = $useremail['email'];
           $data = ['month'=>"$month",'year'=>"$year"];
           Mail::send('email_templates.monthly_beta', $data, function($message) use ($to_email, $adminEmail) {
               $message->to($to_email, $adminEmail)
                   ->subject('C lightning Boost Monthly');
               $message->from("nextlayertechnology@gmail.com");
               $message->attach('file.csv');
              $message->cc($adminEmail);
           });
           
            }
       
         }
       }
      }
    
     
    
//   Alpha dashBoard mails Autometic    
    
    public function daily_alpha_mails(){
    
                $merchants=TransectionAlpha::all();
                $uniq_data=$merchants->unique('merchant_id')->toArray();
            //     dd($uniq_data);
                    foreach ($uniq_data as $key=>$uniq){
                       $user_data[$key]['id']=$uniq['merchant_id'];
                       $user_data[$key]['email']=MerchantsData::where('merchant_name',$uniq['merchant_id'])->pluck('email')->first();
                        }
            
                    /** checking id daily auto email is allow or not */
                    $emailAllow = DB::table('is_email_allow')->where('user_type', 'beta')->where('type', 'daily')->where('is_email', 'auto')->get();
                    $isEmail = $emailAllow[0]->is_email;
                    if($isEmail == "auto"){
            
                    foreach ($user_data as $useremail){
                    if($useremail['email'] != null){
                    $data1=TransectionAlpha::orderBy('created_at', 'DESC')
                       ->where('merchant_id',$useremail['id'])
                       ->whereDate('created_at', '=', Carbon::today()->toDateString())->get()->toArray();
            //            ddd($data1);
                   $fp = fopen('file.csv', 'w');
            
                   foreach ($data1 as $fields) {
                       fputcsv($fp, $fields);
                   }
                   fclose($fp);
                   
                    $boostAdminDetail = DB::table('admin_email')->where('type', 'Periodic Reports Email')->first();
                    $adminEmail = $boostAdminDetail->admin_email;
                   
                   
                    $now = Carbon::now();
                    $currentDate = $now->toDateString();
                   
                      $to_email = $useremail['email'];
                      $data = ['currentDate'=>"$currentDate"];
                   Mail::send('email_templates.daily_alpha', $data, function($message) use ($to_email, $adminEmail) {
                       $message->to($to_email, $adminEmail)
                           ->subject('C lightning Boost daily');
                       $message->from("nextlayertechnology@gmail.com");
                       $message->attach('file.csv');
                       $message->cc($adminEmail);
                   });
                }
                   
               }
             }
        }
   
    public function weekly_alpha_mails(){
    
                $merchants=TransectionAlpha::all();
                $uniq_data=$merchants->unique('merchant_id')->toArray();
            //     dd($uniq_data);
                    foreach ($uniq_data as $key=>$uniq){
                       $user_data[$key]['id']=$uniq['merchant_id'];
                       $user_data[$key]['email']=MerchantsData::where('merchant_name',$uniq['merchant_id'])->pluck('email')->first();
                    }
            
                /* Checking if the weekly auto email is allow or not **/
                 $emailAllow = DB::table('is_email_allow')->where('user_type', 'beta')->where('type', 'weekly')->where('is_email', 'auto')->get();
                    $isEmail = $emailAllow[0]->is_email;
                    if($isEmail == "auto"){
            
                    foreach ($user_data as $useremail){
                    if($useremail['email'] != null){
                    $data1=TransectionAlpha::orderBy('created_at', 'DESC')
                       ->where('merchant_id',$useremail['id'])
                       ->whereDate('created_at', '>', \Carbon\Carbon::now()->subWeek())->get()->toArray();
            //            ddd($data1);
                   $fp = fopen('file.csv', 'w');
            
                   foreach ($data1 as $fields) {
                       fputcsv($fp, $fields);
                   }
                   fclose($fp);
                   
                    $boostAdminDetail = DB::table('admin_email')->where('type', 'Periodic Reports Email')->first();
                    $adminEmail = $boostAdminDetail->admin_email;
                
                    $now = Carbon::now();
                    $currentDate = $now->toDateString();
                    $week = $now->weekOfYear;
                    $month = $now->month;
                    $year = $now->year;
                   
                   $to_email = $useremail['email'];
                   $data = ['currentDate'=>"$currentDate"];
                   Mail::send('email_templates.weekly_alpha', $data, function($message) use ($to_email, $adminEmail) {
                       $message->to($to_email, $adminEmail)
                           ->subject('C lightning Boost Weekly');
                       $message->from("nextlayertechnology@gmail.com");
                       $message->attach('file.csv');
                      $message->cc($adminEmail);
                   });
                }
                
               }
            }
          }
    
    public function monthly_alpha_mails(){
    
                $merchants=TransectionAlpha::all();
                $uniq_data=$merchants->unique('merchant_id')->toArray();
                
                foreach ($uniq_data as $key=>$uniq){
                   $user_data[$key]['id']=$uniq['merchant_id'];
                   $user_data[$key]['email']=MerchantsData::where('merchant_name',$uniq['merchant_id'])->pluck('email')->first();
                 }
            
                    /* Checking if the monthly auto email is allow or not **/
                    $emailAllow = DB::table('is_email_allow')->where('user_type', 'beta')->where('type', 'monthly')->where('is_email', 'auto')->get();
                    $isEmail = $emailAllow[0]->is_email;
                    if($isEmail == "auto"){
            
               foreach ($user_data as $useremail){
                    if($useremail['email'] != null){
                    $data1=TransectionAlpha::orderBy('created_at', 'DESC')
                       ->where('merchant_id',$useremail['id'])
                       ->whereDate('created_at', '>', \Carbon\Carbon::now()->subMonth())->get()->toArray();
            //            ddd($data1);
                   $fp = fopen('file.csv', 'w');
            
                   foreach ($data1 as $fields) {
                       fputcsv($fp, $fields);
                   }
                   fclose($fp);
                   
                    $boostAdminDetail = DB::table('admin_email')->where('type', 'Periodic Reports Email')->first();
                    $adminEmail = $boostAdminDetail->admin_email;
                   
            
                    $now = Carbon::now();
                    $currentDate = $now->toDateString();
                    $week = $now->weekOfYear;
                    $month = $now->format('F');
                    $year = $now->year;
                   
                   $to_email = $useremail['email'];
                   $data = ['month'=>"$month",'year'=>"$year"];
                   Mail::send('email_templates.monthly_alpha', $data, function($message) use ($to_email, $adminEmail) {
                       $message->to($to_email, $adminEmail)
                           ->subject('C lightning Boost Monthly');
                       $message->from("nextlayertechnology@gmail.com");
                       $message->attach('file.csv');
                      $message->cc($adminEmail);
                   });
                 }
            }
        }
      }
      
      
      
    /* function for changing the status of user **/
    public function changeStatus(Request $request){
        $id = $request->id;
        $client_name = $request->client_name;
        $client_id = $request->client_id;
        $status = $request->status;
        $email = $request->email;
        
       
        if(!empty($id)){
           $result = DB::table('client_data')->where('id', $id)->update([
                    'is_active' => $status,
                ]);
                
            if($result == 1){
                
                if($status == 1){
                    $is_status = "Activated";
                }else{
                    $is_status = "Deactivated";
                }
                
                   $to_email = $email;
                   $data = ['client_id'=>"$client_id",'client_name'=>"$client_name", 'is_status'=>"$is_status"];
                   Mail::send('email_templates.status_email', $data, function($message) use ($to_email) {
                       $message->to($to_email)
                           ->subject('C lightning Boost Terminal');
                       $message->from("nextlayertechnology@gmail.com");
                   });
            }    
            
        }else{
            return redirect()->back()->with('message', 'somwthing wrong durin sending the email');
        }
        
    }
  
}
