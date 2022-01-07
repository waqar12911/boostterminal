<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FundingNode;
use App\Models\RoutingNode;

class FundingNodeController extends Controller
{
 public function fundingHomeView(){
        $data=FundingNode::get();
        return view('admin_settings.funding.funding-home',compact('data'));
    }
     public function editFunding(Request $request,$id){
        
        $data=FundingNode::where('id',$id)->get()->first();
        return view('admin_settings.funding.edit-funding',compact('data'));
        
    }
    public function updateFunding(Request $request,$id){
        $user=FundingNode::where('id',$id)->update([
            'ip'=>$request['ip'],
            'username'=>$request['username'],
            // 'company_email'=>$request['company_email'],
            'password'=>$request['password'],
            'merchant_boost_fee'=>$request['merchant_boost_fee'],
            'node_id'=>$request['node_id'],
          	'port'=>$request['port'],
          	'ssh_username'=>$request['ssh_username'],
          	'ssh_password'=>$request['ssh_password'],
            'registration_fees'=>$request['registration_fees'],
            'lightning_boost_fee'=>$request['lightning_boost_fee'],
            ]);
        if($user){
            return redirect()->route('fundingHomeView')->with('message','Updated successfully');
        }    
    }
}
