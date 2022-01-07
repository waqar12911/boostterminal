<?php

namespace App\Http\Controllers;

use App\Models\ClientData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DB;
use Carbon\carbon;




class ClientDataController extends Controller
{
    public function clientEdit($id){
        // $data= DB::table('client_data')->where('client_data.id',$id)->join('users' , 'users.client_id' , 'client_data.client_id')->first();
        $data= DB::table('client_data')->where('id',$id)->first();
        if($data){
        return view('users.edit-client',compact('data'));
        }
    }


    public function createClient(Request $request){
        if ($request->hasFile('client_image_id')) {
            $image = $request->file('client_image_id');
            $imageName = time() . "-" .$image->extension();
            $imagePath = public_path() . '/black/img/clients/';
            $image->move($imagePath, $imageName);
            $imageDbPath = $imageName;
        }   

        $data=ClientData::create([
            'client_name'=>$request['client_name']??'',
            'client_id'=>$request['client_id']??'',
            'national_id'=>$request['national_id']??'',
            'address'=>$request['address']??'',
            'email'=>$request['email']??'',
            'client_backend_password'=>$request['client_backend_password']??'',
            'dob'=>$request['dob']??'',
            'is_gamma_user'=>$request['is_gamma_user']??'',
            'registered_at'=>$request['registered_at']??'',
            'is_active'=>$request['name']??'',
            'client_image_id'=>$imageDbPath??'',
            'card_image_id'=>$request['card_image_id']??'',
            'maxboost'=>$request['maxboost']??'',
        ]);

        if ($data){
            return redirect()->back()->with('message','Client Created Successfully');
        }
    }


    public function updateClient(Request $request)
    {
        $client = ClientData::where('client_id' ,$request->client_id)->firstOrFail();
        $user=$client->user;
   
        $request->validate([
            'email' => 'required|unique:users,email,'.$user->id.'|max:20',
        ]);
        $name1='';
        $name='';

         if($files=$request->file('client_image_id')) {
            $name1 = $files->getClientOriginalName();
            // $files->move(public_path('images\sucrai'), $name);
            
            if($name1!='')
            $files->move(public_path('black/img/clients/'), $name1);
        }
        
       
         if($files=$request->file('card_image_id')) {
            $name = $files->getClientOriginalName();
            // $files->move(public_path('images\sucrai'), $name);
            if($name!='')
            $files->move(public_path('black/img/clients/'), $name);
        }

        if($request->client_2fa_password != NULL || $request->client_2fa_password != 'abc123')
        {
            $user->password = Hash::make($request->client_2fa_password);
            $user->email=$request->email;
            $user->updated_at = carbon::now();
            $user->name= $request->client_name;
            $user->save();
                  

        }

        $client->client_name = $request->client_name;
        $client->client_id = $request->client_id;
        $client->maxboost_limit = $request->maxboost_limit;
        $client->client_maxboost = $request->client_maxboost;
        $client->is_active = $request->is_active;
        $client->address = $request->address;
        $client->email = $request->email;
        $client->dob = $request->dob;
        $client->national_id = $request->national_id;
        $client->client_backend_password =$request->client_backend_password;
        $client->container_address =$request->container_address;
        $client->lightning_port =$request->lightning_port;
        $client->mws_port =$request->mws_port;
        $client->pws_port =$request->pws_port;
        if($name1!='')
        $client->client_image_id = $name1;
        if($name!='')
        $client->card_image_id = $name;
        $client->save();

        return redirect()->route('profile.edit')->with('message','Client information updated successfully');
    }

    public function addClient(){
        return view('users.add-client');
    }
    public function clientDelete($id){
        $data=ClientData::where('id',$id)->firstOrFail();
        if($data->user)
        {
            $data->user->delete();
            $data->delete();
            return redirect()->back()->with('message','Client Deleted Successfully');
        }
        else
        {
            return redirect()->back()->with('message','Something went wrong');
        }
    }
    
    
    

}
