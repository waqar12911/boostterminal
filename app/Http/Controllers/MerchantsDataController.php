<?php

namespace App\Http\Controllers;

use App\Models\MerchantsData;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Auth;
class MerchantsDataController extends Controller
{
    
    
 public function addMerchant()
 {

    return view('users.add-merchant');
}
    
    
  public function createMerchant(Request $request)
  {
        $request->validate([
            'email' => 'required|unique:users,email,null|max:20',
            'merchant_id' => 'required|unique:merchants_data,merchant_id,null|max:100',
            'store_name' => 'required|unique:merchants_data,store_name,null|max:250',
            'merchant_backend_password' => 'required',
        ],
        [
            'store_name' =>'Store name already exists',
            'merchant_id' =>'Merchant already exists',
        ]);
   
                                    
        // $check_exist =  User::where('merchant_id' , '=' ,$request['merchant_id'])->first();
        // if(isset($check_exist) || $check_exist != null){
        //      return redirect()->route('user.index')->with('message','Merchant already exists');
                                           
        // }
        
        //  $check_exist =  User::where('email' , '=' ,$request['email'])->whereNotNull('merchant_id')->first();
        //  if(isset($check_exist) || $check_exist != null){
        //      return redirect()->route('user.index')->with('message','E-mail already exists');
                                           
        // }
        
        //  $check_exist =  MerchantsData::where('store_name' , '=' , $request['store_name'])->first();
        //  if(isset($check_exist) || $check_exist != null){
        //      return redirect()->route('user.index')->with('message','Store name already exists');
                                           
        // }

        $user= User::create([
            "name"=>$request['merchant_id'],
            "email"=>$request['email'],       
            "type"=>'alpha',
            "password"=>Hash::make($request['merchant_backend_password']),
	        "verify_email_code"=>'1',
            ]);

        $merchant=MerchantsData::create([
            "user_id"=>$user->id,
            "merchant_id"=>$request['merchant_id'],
            "maxboost_limit"=>$request['maxboost_limit'],
            "user_type"=>$request['user_type'],
            "tax_rate"=>$request['tax_rate'],
            "merchant_maxboost"=>$request['merchant_maxboost'],
            "store_name"=>$request['store_name'],
            "email"=>$request['email'],
            "merchant_backend_password"=>$request['merchant_backend_password'],
            "latitude"=>$request['latitude'],
            "longitude"=>$request['longitude'],
            "ssh_ip_port"  =>$request['ssh_ip_port'],
            "ssh_username" =>$request['ssh_username'],
            "ssh_password" =>$request['ssh_password'], 
            "is_own_bitcoin" =>$request['is_own_bitcoin']?$request['is_own_bitcoin']:0,
            "rpc_username" =>$request['rpc_username'], 
            "rpc_password" =>$request['rpc_password'], 
            "boost_2fa_password" =>$request['boost_2fa_password'],
            "notes" => $request['notes'], 
            "container_address" => $request['container_address'], 
            "lightning_port" => $request['lightning_port'], 
            "mws_port" => $request['mws_port'], 
          	"pws_port" => $request['pws_port'], 
                                
        ]);
        

         if($merchant){
                // $email = 'ahmad.sw7788@gmail.com';
                $email =  $request['email'];
                $email_data = array('user_mail' => $request['email'] ,'name'=>$request['merchant_id'] ,'user_pass' => $request['pannel_password']);
                                
                //$email_data = array('description' => $inputs['title'] . ' Updated.');
                /*
                $test = Mail::send(['html'=>'send_email'], $email_data, function($message) use($email)
                {
                    $message->to($email)->subject('ALPHA Notification: Login Credentials');
                    // $setting = DB::table('setting')->first();
                    $message->from('sisdev92@gmail.com','Merchant Node Login credentials');
                });
*/

            return redirect()->route('user.index')->with('message','Merchant Created successfully, Email Sent to merchant');
          
                
        }else{
            return redirect()->route('user.index')->with('message','Something Went wrong');
        }
                    
        
  
    }
    
    
    public function editMerchant($id){
        $data=MerchantsData::where('id',$id)->get()->first();
        $AdminUserdata = DB::table('merchant_data_user_types')->where('user_type','Admin')->get()->all();
        $CheckoutUserdata=DB::table('merchant_data_user_types')->where('user_type','Checkout')->get()->all();
        $MerchantUserdata=DB::table('merchant_data_user_types')->where('user_type','Merchant')->get()->all();


        return view('users.edit-merchant',compact('data','AdminUserdata','CheckoutUserdata','MerchantUserdata'));
    }
    
    public function addNewMerchantUser(Request $request){

                $sign_in_username= $_POST['signin_username'];

                        $user_type= $_POST['user_type'];
                        $sign_in_password= $_POST['signin_password'];
                        $merchant_id= $_POST['merchant_id'];

                $AdminUserdata = DB::table('merchant_data_user_types')->where('user_type','Admin')->get()->all();

                $MerchantUserdata=DB::table('merchant_data_user_types')->where('user_type','Merchant')->get()->all();

                if(sizeof($AdminUserdata)>0 && $user_type=='Admin'){
                    echo 'Admin already exists';exit;
                }

                if(sizeof($MerchantUserdata)>0  && $user_type=='Merchant'){
                    echo 'Merchant already exists';exit;
                }

      
        DB::table('merchant_data_user_types')->insert([
                        'user_type'=>$user_type,
                        'merchant_data_id'=>$merchant_id,
                        'sign_in_username'=>$sign_in_username,
                        'sign_in_password'=>$sign_in_password
                    ]);
        return 'Record added successfully.';


    }
public function updateMerchant(Request $request,$id){

        $merchant=MerchantsData::where('merchant_id',$id)->firstOrFail();
        $user=$merchant->user;
        $request->validate([
            'email' => 'required|unique:users,email,'.$user->id.'|max:20',
            'merchant_id' => 'required|unique:merchants_data,merchant_id,'.$merchant->id.'|max:100',
            'store_name' => 'required|unique:merchants_data,store_name,'.$merchant->id.'|max:250',
        ],
        [
            'store_name' =>'Store name already exists',
            'merchant_id' =>'Merchant already exists',
        ]);

            $user->name=$request['merchant_id'];
            $user->email=$request['email']; 
            if($request->merchant_backend_password)
            {
                $user->password=Hash::make($request['merchant_backend_password']);
            }      
            $user->save();
                $merchant=MerchantsData::where('merchant_id',$id)->update([
                    "user_id"=>$user->id,
                    "merchant_id"=>$request['merchant_id'],
                    "maxboost_limit"=>$request['maxboost_limit'],
                    "tax_rate"=>$request['tax_rate'],
                    "merchant_maxboost"=>$request['merchant_maxboost'],
                    "store_name"=>$request['store_name'],
                    "email"=>$request['email'],
                    "merchant_backend_password"=>$request['merchant_backend_password'],
                    "latitude"=>$request['latitude'],
                    "longitude"=>$request['longitude'],
                    'ssh_ip_port'  =>$request['ssh_ip_port'],
                    'ssh_username' =>$request['ssh_username'],
                    'ssh_password' =>$request['ssh_password'], 
                    'is_own_bitcoin' =>$request['is_own_bitcoin']?$request['is_own_bitcoin']:0,
                    'rpc_username' =>$request['rpc_username'], 
                    'rpc_password' =>$request['rpc_password'],
                    'boost_2fa_password' =>$request['boost_2fa_password'],
                    'notes' =>$request['notes'],
                    'container_address' => $request['container_address'], 
                    'lightning_port' => $request['lightning_port'], 
                    'mws_port' => $request['mws_port'], 
                  	'pws_port' => $request['pws_port'], 

                ]);
                
                if($merchant){
                                        
                                        
                    return redirect()->route('user.index')->with('message','Merchant Updated  in Boost Terminal And in Merchant node');
                }else{
                    return redirect()->route('user.index')->with('message','Something Went Wrong');
                }
    }
    
    public function merchantDelete($id)
    {
        $merchant=MerchantsData::where('merchant_id',$id)->firstOrFail();
        $data2 = User::where('id',$merchant->user_id)->delete();
        if($merchant->delete())
        {
            return redirect()->back()->with('message','Merchant Deleted Successfully');
        }
        else
        {
            return redirect()->route('user.index')->with('message','Something Went Wrong');
        }   
    }
    
    public function DeleteMerchantUsers()
    {
      $id = $_POST['id'];
          DB::table('merchant_data_user_types')->where('id',$id)->delete();

          echo 'Record deleted successfully';      
    }    
    
    
}
