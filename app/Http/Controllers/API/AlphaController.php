<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\TransectionAlpha;
use Illuminate\Http\Request;

use App\Models\MerchantImages;
use DB;
use File;

class AlphaController extends Controller
{
    public function addAlphaTransction(Request $request){
        
        $data=TransectionAlpha::create([
        'transaction_label'=>$request['transaction_label'],
        'payment_hash'=>$request['payment_hash'],
        'transaction_amountBTC'=>$request['transaction_amountBTC'],
        'transaction_amountUSD'=>$request['transaction_amountUSD'],
        'payment_preimage'=>$request['payment_preimage'],
        'status'=>$request['status'],
        'destination'=>$request['destination'],
        'transaction_timestamp'=>$request['transaction_timestamp'],
        'msatoshi'=>$request['msatoshi'],
        'conversion_rate'=>$request['conversion_rate'],
        'merchant_id'=>$request['merchant_id'],
        'description'=>$request['description'],
        ]);
        
        if($data){
            return response()->json(['message'=>'successfully done','data'=>$data] );
        }else{
            return response()->json(['message'=>'some thing went wrong'] );
        }
    }
    
    /** Function for adding the merchant file and ucp number */
 public function addMerchant(Request $request)
    {
        if (!empty($request->merchant_id)) {
            $merchant_id = $request->merchant_id;
            $merchant_upc = $request->upc;
            if ($request->hasFile('file')) {
                $file = $request->file;
                if (!isset($merchant_id) || !isset($merchant_upc) || !isset($file)) {
                    return response()->json(['status' => 'fail', 'message' => 'merchant id & merchant upc & file is required']);
                } else {
                    
                    $upc_exist = DB::table('merchant_item_image')->where('upc_number', $merchant_upc)->first();
                    if($upc_exist){
                          return response()->json(['status' => 'fail', 'message' => 'upc Already exist']);
                    }else{
                    $file_name = $merchant_id . 'item' . time() . '.' . $file->extension();
                    $data=[
                        "merchant_id" => $merchant_id,
                        "upc_number" => $merchant_upc,
                        "image" => $file_name,
                        'quantity' => $request->quantity,
                        'price' => $request->price,
                        'name' => $request->name,
                        'additional_info' => $request->additional_info,
                        'select_quatity' => $request->select_quatity,
                        'total_price' => $request->total_price,
                        'image_in_hex' => $request->image_in_hex,
                        ];
                    $result = DB::table('merchant_item_image')->insert($data);
                    if ($result) {
                        $destinationPath = 'public/merchant_images';
                        $fileMoved = $file->move($destinationPath, $file_name);

                        if ($fileMoved) {
                            return response()->json(['status' => 'success', 'message' => 'merchant data successfully inserted']);
                        } else {
                            return response()->json(['status' => 'fail', 'message' => 'something wrong']);
                        }
                    } else {
                        return response()->json(['status' => 'fail', 'message' => 'something wrong with data insertion']);
                    }
                    
                   }  
                    
                }
            } else {
                return response()->json(['status' => 'fail', 'message' => 'please upload a file']);
            }

        } else {
            return response()->json(['status' => 'failed', 'message' => 'Merchant id is required']);
        }
    }

/** Function for delete the merchant file record */
    public function deleteMerchantFile(Request $request)
    {
        
        $merchant_id = $request->merchant_id;
        $merchant_upc = $request->merchant_item_upc;
        if (!empty($merchant_id)) {
            $deleteFile = DB::table('merchant_item_image')->where('merchant_id' , $merchant_id)->where('upc_number' , $merchant_upc)->delete();
            if ($deleteFile) {
                return response()->json(['status' => 'success', 'message' => 'merchant data successfully deleted']);
            } else {
                return response()->json(['status' => 'success', 'message' => 'something wrong']);
            }
        } else {
            return response()->json(['status' => 'failed', 'message' => 'Merchant id is empty']);
        }
    
    }
    
    /** Function for getting the whole record of merchant file */
    public function getMerchantFileRecord($id){
        if(!empty($id)){
            $merchantRecord = DB::table('merchant_item_image')->where('merchant_id',$id)->get();
            if($merchantRecord){
                  return response()->json(['status' => 'success', 'message' => 'All the merchant file record', 'data'=>$merchantRecord]);

            }else{
                return response()->json(['status' => 'failed', 'message' => 'Merchant id is empty']);
            }
            
        }else{
            return response()->json(['status' => 'failed', 'message' => 'Merchant id is empty']);
        }
    }
    
    /** Update Merchant file record  */
     public function updateMerchantFile(Request $request)
    {

        if (!empty($request->merchant_id)) {

            $merchant_id = $request->merchant_id;
            $merchant_upc = $request->upc;

             


                

                if (!isset($merchant_id) || !isset($merchant_upc) ) {
                    return response()->json(['status' => 'fail', 'message' => 'merchant id & merchant upc is required']);
                } else {


                    if ($request->hasFile('file')) {
                    $file = $request->file;

                    $file = $request->file;
                         $file_name = $merchant_id . 'item' . time() . '.' . $file->extension();
                    $destinationPath = 'public/merchant_images';
                     $fileMoved = $file->move($destinationPath, $file_name);
                    if ($fileMoved) {
                          $data=[
                            'upc_number' => $merchant_upc,
                            'image' => $file_name,
                            'name' => $request->name,
                            'quantity' => $request->quantity,
                            'price' => $request->price,
                            'additional_info' => $request->additional_info,
                            'select_quatity' => $request->select_quatity,
                            'total_price' => $request->total_price,
                            'image_in_hex' => $request->image_in_hex,
                        ];          
                    }   
                  }else{
                    $data=[
                            'upc_number' => $merchant_upc,
                           
                            'name' => $request->name,
                            'quantity' => $request->quantity,
                            'price' => $request->price,
                            'additional_info' => $request->additional_info,
                            'select_quatity' => $request->select_quatity,
                            'total_price' => $request->total_price,
                            'image_in_hex' => $request->image_in_hex,
                        ];

                  }


                   
                   
                        
                        $update = DB::table('merchant_item_image')->where('merchant_id', $merchant_id)->where('upc_number', $merchant_upc)->update($data);

                        if ($update) {
                            return response()->json(['status' => 'success', 'message' => 'Merchant File has updated successfully']);
                        } else {
                            return response()->json(['status' => 'failed', 'message' => 'Merchant File not updated']);
                        }

                     
                }

          

        } else {
            return response()->json(['status' => 'failed', 'message' => 'Merchant i should not be empty']);
        }
    }


    

}
