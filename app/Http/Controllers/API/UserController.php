<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ClientData;
use App\Models\MerchantsData;
use App\Models\User;
use App\Models\RoutingNode;
use App\Models\FundingNode;
use App\Models\Transaction;
use Illuminate\Http\Request;
use DateTime;
use DB;
use carbon\carbon;
use Illuminate\Support\Facades\Hash;
use function PHPUnit\Framework\isEmpty;
use Illuminate\Support\Facades\Mail;
use Swift_Mailer;
use Swift_SmtpTransport;


class UserController extends Controller
{
    public $successStatus = 200;
    /**
     * login api
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function clients_login(Request $request){
        
        $user =ClientData::where('client_id',$request->client_id)->first();
    if($user){
      
             if($user['is_active'] != '1')
            {
                return response()->json(['message' =>'User is not active']);
            }
      		$admin=DB::table('admin_email')->where('type', 'Client Session Token TF')->first();
      		$response=array(
               "id"=> $user->id,
                "user_id"=> $user->user_id,
                "client_name"=> $user->client_name,
                "client_id"=> $user->client_id,
                "email"=> $user->email,
                "container_address"=> $user->container_address,
                "lightning_port"=> $user->lightning_port,
                "mws_port"=> $user->mws_port,
                "pws_port"=> $user->pws_port,
                "is_gamma_user"=> $user->is_gamma_user,
                "is_active"=> $user->is_active,
                "fp_status"=> $user->fp_status,
                "fp_expiration"=> $user->fp_expiration,
                "maxboost_limit"=> $user->maxboost_limit,
                "client_maxboost"=> $user->client_maxboost,
                "client_image_id"=> $user->client_image_id,
                "card_image_id"=> $user->card_image_id,
                "client_type"=> $user->client_type,
                "created_at"=> $user->created_at,
                "updated_at"=> $user->updated_at,
                "client_backend_password"=> $user->client_backend_password,
              	"Client_login_TF"=> $admin->admin_email,
            );
            return response()->json(['message'=>'Successfully done','data'=>$response] );
    }else{
    return response()->json(['message'=>'Wrong Client ID or Password'] );}
    }


    public function clients_2fa(Request $request){
        
        $user =ClientData::where('client_id',$request->client_id)->first();
        if($user){
            if($user->client_backend_password==$request->password)
            {
                return response()->json(['status'=>'yes','message'=>'Client authenticated '] );
            }
            else
            {
                return response()->json(['status'=>'no','message'=>'The Clients password is incorrect'] );
            }
        }
        else{
             return response()->json(['status'=>'no','message'=>'This client ID does not exist'] );
        }
    }

    public function clients(Request $request){

         $user =ClientData::limit(10)->get();
         echo json_encode($user);
    }
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function merchants_login(Request $request)
    {
        
        $user =MerchantsData::where('merchant_id',$request->merchant_id)->first();
           
        if(!$user)
        {
            return response()->json(['message' =>'Invalid Merchant ID']);

        }
      
        $admin=DB::table('admin_email')->where('type', 'Merchant Session Token TF')->first();
        $response=array(
          "id"=> $user->id,
          "user_id"=> $user->user_id,
          "merchant_id"=> $user->merchant_id,
          "email"=> $user->email,
          "store_name"=> $user->store_name,
          "ssh_ip_port"=> $user->ssh_ip_port,
          "ssh_username"=> $user->ssh_username,
          "ssh_password"=> $user->ssh_password,
          "is_own_bitcoin"=> $user->is_own_bitcoin,
          "rpc_username"=> $user->rpc_username,
          "rpc_password"=> $user->rpc_password,
          "latitude"=> $user->latitude,
          "longitude"=> $user->longitude,
          "container_address"=> $user->container_address,
          "lightning_port"=> $user->lightning_port,
          "mws_port"=> $user->mws_port,
          "pws_port"=> $user->pws_port,
          "merchant_backend_password"=> $user->merchant_backend_password,
          "maxboost_limit"=> $user->maxboost_limit,
          "merchant_maxboost"=> $user->merchant_maxboost,
          "boost_2fa_password"=>"$user->boost_2fa_password",
          "created_at"=> $user->created_at,
          "updated_at"=> $user->updated_at,
          "client_2fa_password"=>"$user->client_2fa_password",
          "admin_administrator_password"=>"$user->admin_administrator_password",
          "notes"=>"$user->notes",
          "tax_rate"=>"$user->tax_rate",
          "verify_email_code"=>"$user->verify_email_code",
          "serverUrl"=>"$user->serverUrl",
          "serverPort"=>"$user->serverPort",
          "serverId"=>"$user->serverId",
          "token_expiry_time"=>"$user->token_expiry_time",
          "Merchant_login_TF"=> $admin->admin_email,
        );
        return response()->json(['message'=>'Successfully done','data'=>$response] );

    }



  public function merchantsuser_login(Request $request){
    $user =DB::table('merchant_data_user_types')->where('sign_in_username',$request->sign_in_username)->where('user_type',$request->user_type)
        ->where('sign_in_password',$request->password)
        ->where('merchant_data_id',$request->merchant_id)
        ->get()->first();
    //print_r($user);exit;
   //echo sizeof($user);exit;
    if($user){
               return response()->json(['message'=>'successfully done','data'=>$user] );
    }
    else{
    return response()->json(['message'=>'invalid Merchant '.$request->user_type.' User'] );}
    }



    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */

    public function upload(Request $request){


    $result = $request->file('file')->store('apiDocument');
    return ["result" => $result];



}
public function get_shock_pay($client_id){
    
    $user =ClientData::where('client_id',$client_id)->first();
    if(!$user){
         return response()->json(['message'=>'invalid client id' ], 200 );
    }
       $data = DB::table('shock_pay')->where('client_id' ,$client_id)->get();
       if(count($data) >0 ){
           return response()->json(['message'=>'successfully get' , 'data' => $data], 200 );
       }
       else{
           return response()->json(['message'=>'No record found' ], 200 );
       }
               
}
public function create_shock_pay(Request $request){
    // dd($request->all());
    // if(!isset($request->))
    $user =ClientData::where('client_id',$request->client_id)->first();
    if($user){
        
        $data = DB::table('shock_pay')->insert([
            'client_id' => $request->client_id,
            'shock_pay_contact_name' => $request->shock_pay_contact_name,
            'shock_pay_contact_Node_ID' => $request->shock_pay_contact_Node_ID,
            ]);
        if($data){
             $res = DB::table('shock_pay')->orderBy('id' , 'desc')->first();
            return response()->json(['message'=>'Successfully creaetd' , 'data' => $res], 200 );
        }
        else{
            return response()->json(['message'=>'Something went wrong'], 200 );
        }
        
    }
    else{
        return response()->json(['message'=>'Invalid Client Id' , 'data' => null], 200 );
    }
}

    public function delete_shock_pay(Request $request){
        
        if(!empty($request->id)){
        
         $deleteClient = DB::table('shock_pay')->where('id' , $request->id)->delete();
            if ($deleteClient) {
                return response()->json(['status' => 'success', 'message' => 'Shock Pay Client successfully deleted']);
            } else {
                return response()->json(['status' => 'success', 'message' => 'There is no record related to this id']);
            }
        
        }else{
            return response()->json(['status' => 'success', 'message' => 'id is not valid']);
        }
    }

    public function addClients(Request $request){
      
      	if($request->is_gamma_user)
        {
          	$client_backend_password = $this->RandomPassword();
        }
      	else
        {
          	$client_backend_password = 'abc123';
        }
        if($request->client_id)
        {
            $client_id=ClientData::where('client_id',$request->client_id)->get()->first();
            if($client_id){
                return response()->json(['message'=>'Client id already exists'] );
                }
         }
          if($request->email){
            $client_email=ClientData::where('email',$request->email)->get()->first();

            if($client_email){
                return response()->json(['message'=>'Email already exists'] );
            }
         }
         
        if($request->national_id){
            $client_id=ClientData::where('national_id',$request->national_id)->get()->first();

            if($client_id){
                return response()->json(['message'=>'National Id already exists'] );
            }
         }


    if ($request->file('card_image_id')) {
            $image = $request->file('card_image_id');
            $imageName = time() . "." .$image->extension();
            $imagePath = public_path() . '/black/img/clients/';
            $image->move($imagePath, $imageName);
            $imageDbPath = $imageName;
        }

    if ($request->file('client_image_id')) {
            $image1 = $request->file('client_image_id');
            $imageName1 = time() ."1". "." .$image1->extension();
            $imagePath1 = public_path() . '/black/img/clients/';
            $image1->move($imagePath1, $imageName1);
            $imageDbPath1 = $imageName1;
        }
      
      	$user =User::create([
            "name" => $request->client_name,
            "email"=>$request->email,
            "email_verified_at"=>carbon::now(),
            "type"=>"gamma",
            "password" => Hash::make($client_backend_password),
            "created_at"=>carbon::now(),
            "updated_at"=>carbon::now(),
        ]);
        $client =ClientData::create([
            'user_id' =>$user->id,
            "client_name"=>$request['client_name']??'',
            "client_id"=>$request['client_id']??'',
            "national_id"=>$request['national_id']??'',
            "address"=>$request['address']??'',
            "dob"=>$request['dob']??'0',
            "is_gamma_user"=>$request['is_gamma_user']??'',
            "registered_at"=>$request['registered_at']??'',
            "is_active"=>$request['is_active']??'',
            "client_image_id"=>$imageDbPath1??'',
            "card_image_id"=>$imageDbPath??'',
            "email"=>$request['email']??'',
            "client_type" => $request['client_type']??'',
            "maxboost_limit"=>$request['maxboost_limit'],
            "client_maxboost"=>$request['maxboost_limit'],
            "client_backend_password"=>$client_backend_password,
            "merchant_id" => $request['merchant_id'],
        ]);
         
        if($client){
                $boostAdminDetail = DB::table('admin_email')->where('type', 'Boost Normal Registration Email')->first();
                $boostNormalEmail = $boostAdminDetail->admin_email;
                $boostInstantAdmin = DB::table('admin_email')->where('type', 'Boost Instant Registration Email')->first();
                $boostInstantEmail = $boostInstantAdmin->admin_email;
                if($request['client_type'] == 'normal'){
                    $ccEmail = $boostNormalEmail;
                }else{
                    $ccEmail = $boostInstantEmail;
                }
            
                if($request['is_active'] == 1){
                    $status = 'Active Account';
                }else{
                    $status = 'Deactivate Account';
                }
          		$subject = 'C lightning Boost Terminal';
          		if($request->is_gamma_user){
            		$subject='You are now a registered Next Layer Client';
                }
          		$transport = new Swift_SmtpTransport('mail.nextlayer.live', 587, 'tls');
                $transport->setUsername('outgoing@nextlayer.live');
                $transport->setPassword('Bitcoin2020$');
                $swift_mailer = new Swift_Mailer($transport);
                Mail::setSwiftMailer($swift_mailer);
          		$data = array('client_id'=> $request['client_id'], 'client_name' => $request['client_name'], 'email'=> $request['email'], 'is_active' => $status, 'is_gamma_user'=>$request['is_gamma_user'], 'password'=>$client_backend_password);
                $reciever_email = $request['email'];
                $sender_email = 'outgoing@nextlayer.live';
                Mail::send(['html'=>'email_templates.registration_email_format'], $data, function($message) use($reciever_email , $sender_email, $ccEmail, $subject ) {
                  $message->to($reciever_email)->subject($subject);
                  $message->from($sender_email);
                  $message->cc($ccEmail);
                });
                return response()->json(['message'=>'Register successfully','data'=>$user]);
                
            }
            else{
                    return response()->json(['message'=>'Some thing went wrong, try again','status'=>403] , 403 );
            }
 

}
  
  	public function RandomPassword()
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randstring = '';
        for ($i = 0; $i < 8; $i++) {
            $randstring .= $characters[rand(0, strlen($characters)-1)];
        }
        return strtoupper($randstring);
    }


    public function clients_Edit(Request $request,$id){
        $user =ClientData::where('id',$id)->update([
            "client_maxboost"=>$request['client_maxboost'],
        ]);

        if($user){
            $data =ClientData::where('id',$id)->get()->first();
        return response()->json(['message'=>'updated successfully','data'=>$data] );
        }else{
            return response()->json(['message'=>'Some thing went wrong'] );
        }

    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function merchants_Edit(Request $request,$id){
//        dd($request);
        $user =MerchantsData::where('id',$id)->update([
            // "merchant_name"=>$request['merchant_name'],
            "merchant_maxboost"=>$request['merchant_maxboost'],
        ]);

    if ($user){
        $data =MerchantsData::where('id',$id)->get()->first();
        return response()->json(['message'=>'updated successfully','data'=>$data] );
        }else{
        return response()->json(['message'=>'Some thing went wrong'] );
    }

    }

    public function merchant_maxboost(){
        // dd('walla');
       $user =MerchantsData::all();
            foreach($user as $data){
                $maxlimit=$data->maxboost_limit;
                $id=$data->id;
     MerchantsData::where('id',$id)->Update([
         'merchant_maxboost'=>$maxlimit??'0',
     ]);
}

     }

     public function client_maxboost(){
        //  dd('wallaaaa');
         $user =ClientData::all();
//         dd($user);
         foreach($user as $data){
             $maxlimit=$data->maxboost_limit??'0';
             $id=$data->id;
             ClientData::where('id',$id)->Update([
                 'client_maxboost'=>$maxlimit??'0',
             ]);
         }
     }




    public function getMerchants(){

        $data=MerchantsData::all();

        if($data){
        return response()->json(['message'=>'successfully done','data'=>$data] );
        }
    }

    public function getClients($id){

        $data=ClientData::select('id','client_name','client_id','client_image_id','card_image_id')->where('id',$id)->orWhere('client_id',$id)->first();

        if($data){
        return response()->json(['message'=>'successfully done','data'=>$data] );
        }
    }

    public function getAllClients(){
        $data=ClientData::all();

        if($data){
        return response()->json(['message'=>'successfully done','data'=>$data] );
        }
    }

    public function getRoutingNodes(){
        $data=RoutingNode::all();

        if($data){
        return response()->json(['message'=>'successfully done','data'=>$data] );
        }
    }



    public function getFundingNodes(){
        $data=FundingNode::all();

        if($data){
        return response()->json(['message'=>'successfully done','data'=>$data] );
        }
    }
    
    // ahmad
       public function addInstance(Request $request){
           
        $amount      = $request['transaction_amountUSD'];
        $client_id   = $request['transaction_clientId'];
        $merchent_id = $request['transaction_merchantId'];

        // Client Remainings
        
        $get_client  = ClientData::where('client_id',$client_id)->get()->first();
       
        // $totalClient=$get_client->client_maxboost;
             
        // $clintRemaining=$totalClient-$amount;
        $clintRemaining = $get_client->client_maxboost;
        // ClientData::where('client_id',$client_id)->update(['client_maxboost'=>$clintRemaining,]);
        // dd($clintRemaining);

        // Merchant Rmainings
         $get_merchant  = MerchantsData::where('merchant_id',$merchent_id)->get()->first();
        // $totalMerchant=$get_merchant->merchant_maxboost;
        $merchantRemaining = $get_merchant->merchant_maxboost;
        // $merchantRemaining=$totalMerchant-$amount;
        // MerchantsData::where('merchant_name',$merchent_id)->update(['merchant_maxboost'=>$merchantRemaining,]);
        // dd($merchantRemaining);


        $data=Transaction::create([
        'transaction_label'=>$request['transaction_label'],
        'transaction_id'=>$request['transaction_id'],
        'transaction_amountBTC'=>$request['transaction_amountBTC'],
        'transaction_amountUSD'=>$request['transaction_amountUSD'],
        'transaction_clientId'=>$request['transaction_clientId'],
        'transaction_merchantId'=>$request['transaction_merchantId'],
        'transaction_timestamp'=>$request['transaction_timestamp'],
        'conversion_rate'=>$request['conversion_rate'],
        'client_remaining'=>$clintRemaining,
        'merchant_remaining'=>$merchantRemaining,
        ]);
        
        // dd($data);

        if($data){
            return response()->json(['message'=>'successfully done','data'=>$data] );
        }else{
            return response()->json(['message'=>'some thing went wrong'] );
        }
           
           
       }
    // ahmad end
    
    
    public function addTransction(Request $request){

        $amount      = $request['transaction_amountUSD'];
        $client_id   = $request['transaction_clientId'];
        $merchent_id = $request['transaction_merchantId'];

        // Client Remainings
        
        $get_client  = ClientData::where('client_id',$client_id)->get()->first();
        $clientEmail = $get_client->email;
        
        
        $totalClient=$get_client->client_maxboost;
        $clintRemaining=$totalClient-$amount;
        
        ClientData::where('client_id',$client_id)->update(['client_maxboost'=>$clintRemaining,]);
        // dd($clintRemaining);

        // Merchant Rmainings
        $get_merchant  = MerchantsData::where('merchant_id',$merchent_id)->get()->first();
        $totalMerchant=$get_merchant->merchant_maxboost;
        $merchantEmail = $get_merchant->email;
       
        
        $merchantRemaining=$totalMerchant-$amount;
        MerchantsData::where('merchant_id',$merchent_id)->update(['merchant_maxboost'=>$merchantRemaining,]);
        // dd($merchantRemaining);

        $data=Transaction::create([
        'transaction_label'=>$request['transaction_label'],
        'transaction_id'=>$request['transaction_id'],
        'transaction_amountBTC'=>$request['transaction_amountBTC'],
        'transaction_amountUSD'=>$request['transaction_amountUSD'],
        'transaction_clientId'=>$request['transaction_clientId'],
        'transaction_merchantId'=>$request['transaction_merchantId'],
        'transaction_timestamp'=>$request['transaction_timestamp'],
        'conversion_rate'=>$request['conversion_rate'],
        'client_remaining'=>$clintRemaining,
        'merchant_remaining'=>$merchantRemaining,
        ]);
        
        // dd($data);

        if($data){
          	$boostAdminDetail = DB::table('admin_email')->where('type', 'Boost Recharge Receipt Email')->first();
            $adminEmail = $boostAdminDetail->admin_email;
        	$transport = new Swift_SmtpTransport('mail.nextlayer.live', 587, 'tls');
          	$transport->setUsername('outgoing@nextlayer.live');
            $transport->setPassword('Bitcoin2020$');
            $swift_mailer = new Swift_Mailer($transport);
            Mail::setSwiftMailer($swift_mailer);
        	$emailData = array('merchantId' => "$request->transaction_merchantId",'chargeTime' => "$request->transaction_timestamp", 'mountBTC'=>"$request->transaction_amountBTC" , 'amountUSD' => "$request->transaction_amountUSD" );
            Mail::send(['html'=>'email_templates.add_transction'], $emailData, function($message) use($clientEmail , $merchantEmail, $adminEmail) {
              $message->to($clientEmail, $merchantEmail, $adminEmail)->subject('C lightning Boost Terminal');
              $message->from("nextlayertechnology@gmail.com");
              $message->cc($adminEmail);
            });
            return response()->json(['message'=>'successfully done','data'=>$data] );
        }else{
            return response()->json(['message'=>'some thing went wrong'] );
        }
    }
        
        public function checkMerchant(Request $request){
            
            $merchant_id=$request['merchant_id'];
            $merchant_pass=$request['password'];
            $data=MerchantsData::where('merchant_name',$merchant_id)
                                ->where('password',$merchant_pass)->get();
                                
            if($data->count() > 0){
                return response()->json(['message'=>'successfully done','data'=>$data] );
            }else{
                return response()->json(['message'=>'somthing went wrong'] );
            };
            
        }
  
  	// by Muhammad Waqar
  	public function routingapiauth1(Request $request)
    {
        $user =MerchantsData::where('merchant_id',$request->merchant_id)->where('merchant_backend_password',$request->merchant_backend_password)->first();
        if($user)
        {
            return response()->json(['message' =>'Success']);

        }
        else
        {
          return response()->json(['message'=>'Fail']);
        }
    }
  
  	// By Muhammad Waqar
  	public function routingapiauth2(Request $request)
    {
        $user =MerchantsData::where('merchant_id',$request->merchant_id)->where('boost_2fa_password',$request->boost_2fa_password)->first();
        if($user)
        {
            return response()->json(['message' =>'Success']);

        }
        else
        {
          return response()->json(['message'=>'Fail']);
        }
    }




}
