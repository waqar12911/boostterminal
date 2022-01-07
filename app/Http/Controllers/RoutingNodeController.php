<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FundingNode;
use App\Models\RoutingNode;
use DB;

class RoutingNodeController extends Controller
{
    public function routingHomeView(){
        $data=RoutingNode::get();
        return view('admin_settings.routing.routing-home',compact('data'));
    }
    
    public function editRouting(Request $request,$id){
        
        $data=RoutingNode::where('id',$id)->get()->first();
        return view('admin_settings.routing.edit-routing',compact('data'));
        
    }
    public function updateRouting(Request $request,$id){
       $user=RoutingNode::where('id',$id)->update([
            'ip'=>$request['ip'],
            'username'=>$request['username'],
            'password'=>$request['password'],
         	'port'=>$request['port'],
          	'ssh_username'=>$request['ssh_username'],
          	'ssh_password'=>$request['ssh_password'],
            ]);
        if($user){
            return redirect()->route('routingHomeView')->with('message','updated successfully');
        }
    }
    
    public function showAdminInfo(){
        $data = DB::table('admin_email')->get();
        return view('profile.admin_info', compact('data'));
    }
    
    // update the admin info
    public function getGlobal(Request $request){
        
        $validated = $request->validate([
        'type' => 'required|max:255',
        'key' => 'required|in:haiww82uuw92iiwu292isk',
       
        ]);
        if(!$request->type && !empty($request->type) && !$request->key && $request->key=='haiww82uuw92iiwu292isk')
        {
            $data=['status'=>false,'response'=>"type or key does not match"];
            return response()->json($data, 404);
        }
        $id='';
        if ($request->type=='merchant') 
        {
            $id=5;
        }
        elseif($request->type=='client')
        {
            $id=6;
        }
        else
        {
            $data=['status'=>false,'response'=>"type or key does not match"];
            return response()->json($data, 404);
        }
        $data = DB::table('admin_email')->where('id',$id)->first();

         return json_encode(['session_token'=>$data->admin_email]);
      
    }

      public function updateAdminEmail(Request $request){
        
        $validated = $request->validate([
        'admin_email' => 'required|max:255',
       
    ]);
    
   if($validated){
        $data = DB::table('admin_email')->where('id', $request->id)->update([
            'admin_email'=> $request->admin_email
            ]);
        
      return redirect()->back()->with('message', 'Value has updated sucessfully');
   }else{
        return redirect()->back()->with('message', 'Something wrong');
   }
    }
    
}
