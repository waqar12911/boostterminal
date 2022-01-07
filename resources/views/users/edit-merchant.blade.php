<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-md-3"></div>
  @if(Session::get('fail'))
  <div class="col-md-6">
    <div class="alert bg-danger text-center" style="color: white;">
      {{Session::get('fail')}}
    </div>
  </div>
  @endif
  @if(Session::get('success'))
  <div class="col-md-6">
    <div class="alert bg-success text-center" style=" color: white;">
      {{Session::get('success')}}
    </div>
  </div>
  @endif 
  <div class="col-md-3"></div>
</div>
<br>
    <div class="set_form">

        <div class="card">
            <div class="card-header">
                <h5 class="title">Edit Profile</h5>
            </div>
            <form method="post" action="{{route('updateMerchant',[$data->merchant_id])}}" onsubmit="return validateForm()" id="myForm" autocomplete="off" enctype="multipart/form-data">
                <div class="card-body">

                    <input type="hidden" id='merchant_id' value="{{$data->id}}" />
                     @if(Session::has('message'))
                  <p class="alert alert-info">{{ Session::get('message') }}</p>
                     @endif
                    @csrf
               
                        <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Merchant Id</label>
                            <input type="text" value="{{$data->merchant_id}}" name="merchant_id" readonly class="form-control" required>
                        </div>
                        {{-- <div class="form-group col-md-6">
                            <label for="store_name">Merchant Password</label>
                            <input type="text" name="password" value="{{$data->password}}" class="form-control" required>
                        </div> --}}
                        
                    {{-- </div>
                    <div class="form-row"> --}}
                        <div class="form-group col-md-6">
                            <label for="store_name">Merchant Backend Password</label>
                            <input type="text" value="{{$data->merchant_backend_password}}" name="merchant_backend_password" class="form-control" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="store_name">Store Name</label>
                            <input type="text" value="{{$data->store_name}}" name="store_name" class="form-control" required>
                        </div>
                        
                    </div>
                     <div class="form-row">
                         <div class="form-group col-md-6">
                            <label for="inputPassword4">Maxboost Limit</label>
                            <input type="text" value="{{$data->maxboost_limit}}" name="maxboost_limit" class="form-control" required  >
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Merchant Boost Limit</label>
                            <input type="text" value="{{$data->merchant_maxboost}}" name="merchant_maxboost" class="form-control" required  >
                        </div>
                        
                        
                        <div class="form-group col-md-6">
                            <label for="email">Email</label>
                            <input type="text" value="{{$data->email}}" name="email" readonly class="form-control" required>
                        </div>
                        
                         <div class="form-group col-md-6">
                            <label for="store_name">Boost  2FA Password</label>
                            <input type="text" name="boost_2fa_password" value="{{$data->boost_2fa_password}}" class="form-control" required>
                        </div>
                   
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="store_name">latitude</label>
                            <input type="text" value="{{$data->latitude}}" name="latitude" class="form-control" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">longitude</label>
                            <input type="text" value="{{$data->longitude}}" name="longitude" class="form-control" required  >
                        </div>
                    </div>     
                                    
                 <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="ssh_ip_port">SSH IP PORT</label>
                            <input type="text" value="{{$data->ssh_ip_port}}" name="ssh_ip_port" class="form-control" required  >
                        </div>
                        <div class="form-group col-md-6">
                            <label for="ssh_username">Node Username</label>
                            <input type="text"  value="{{$data->ssh_username}}" name="ssh_username" class="form-control" required  >
                        </div>
                    </div>
                     
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="ssh_password">Node Password</label>
                                <input type="text" value="{{$data->ssh_password}}" name="ssh_password" class="form-control" required  >
                            </div>
                            {{-- <div class="form-group col-md-6">
                                <label for="admin_administrator_password">Admin Administrator Password</label>
                                <input type="text" name="admin_administrator_password" value="{{$data->admin_administrator_password}}" class="form-control" required  >
                            </div> --}}
                        </div> 
                  
  
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="ssh_password">Tax Rate</label>
                                <input type="text" value="{{$data->tax_rate}}" name="tax_rate" class="form-control" required  >
                            </div>


                      <div class="form-group col-md-6">
                            <label for="user_type">App User Authentication</label>
                            <select  onchange="ToggleBlocks(this.value)" style="color:rgba(255, 255, 255, 0.6);background: #2b3553;" name="user_type" id="user_type" class="form-control" required  >
                            <option value="Admin">Admin</option>
                            <option value="Merchant">Merchant</option>
                            <option value="Checkout">Checkout</option>
                            
                            <option value="Add-User">Add User</option>

                            </select>
                        </div>


                           
                        </div> 




                         <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="notes">Add Notes</label>
                                <textarea type="text" name="notes" value="{{$data->notes}}" class="form-control border" required  >{{ $data->notes; }} </textarea>
                            </div>
                        </div> 
                        
                  <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="ssh_password">Container Address</label>
                            <input type="text" name="container_address" class="form-control" value="{{$data->container_address}}" required  >
                        </div>
                        <div class="form-group col-md-6">
                            <label for="ssh_password">Lightning Port</label>
                            <input type="text" name="lightning_port" class="form-control" value="{{$data->lightning_port}}" required  >
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="ssh_password">MWS Port</label>
                            <input type="text" value="{{$data->mws_port}}" name="mws_port" class="form-control" required  >
                        </div>
                      	<div class="form-group col-md-6">
                            <label for="ssh_password">PWS Port</label>
                            <input type="text" value="{{$data->pws_port}}" name="pws_port" class="form-control" required  >
                        </div>
                    </div>

              
                    <div style="margin-bottom:20px;display: none;" class="form-row">
                        <div class="form-check">
                            <input type="checkbox"   name="is_own_bitcoin"  value="1"  @if($data->is_own_bitcoin == '1')  checked @endif style="margin-left:5px;visibility: visible;opacity:1" class="form-check-input" id="isown">
                            <label class="form-check-label" for="isown">Own Bitcoin Node</label>
                          </div>
                    </div>
                    <div id="rpcDetails" class="form-row" style="display: none;">
                        <div class="form-group col-md-6">
                            <label for="rpc_username">RPC USERNAME </label>
                            <input type="text" value="{{$data->rpc_username}}" name="rpc_username" class="form-control"  >
                        </div>
                        <div class="form-group col-md-6">
                            <label for="rpc_password">RPC PASSWORD</label>
                            <input type="text" value="{{$data->rpc_password}}" name="rpc_password" class="form-control"  >
                        </div>
                    </div>
                
                 
                    
                    
                    
                </div> <a href="" class="btn btn-primary" data-toggle="modal" data-target="#requestModal">Request New Member Token</a>&nbsp&nbsp&nbsp
              	<a href="" class="btn btn-primary" data-toggle="modal" data-target="#passwordModal">Change Password</a>
                <div class="card-footer pull-right">
         
                    <button type="submit" class="btn btn-fill btn-primary">update</button>
                  
                </div>
<br>
<div >
              <div id="adminUserBlock" style="display: block;">
                <table width="100%">
                    <tr>
                        <td colspan="3"><strong>Admin Users</strong></td>
                       
                    </tr> 
                    <tr>
                        <td style="width: 30%">User Type</td>
                        <td style="width: 30%">Signin Username</td>
                        <td style="width: 30%">Signin Password</td>
                        <td>Action</td>
                    </tr>
                    <?php 
if(sizeof($AdminUserdata)>0){
                    foreach($AdminUserdata as $rec) { 

                        ?>
                <tr>
                        <td style="width: 30%"><?php echo $rec->user_type;?></td>
                        <td style="width: 30%"><?php echo $rec->sign_in_username;?></td>
                        <td style="width: 30%"><?php echo $rec->sign_in_password;?></td>
                        <td style="width: 10%"><a href="javascript:;" onclick="DeleteMe(<?=$rec->id?>)">Delete</a></td>
                    </tr>



                    <?php } }else{

                        ?>
                <tr>
                        <td colspan="4">
                            <p class="alert alert-danger">No record found.</p>
                        </td>
                    </tr>

                        <?php
                    }?>
                    

                </table>
              </div>  

</div>
<div>
  <div  id="checkoutUserBlock" style="display: none;">
                <table width="100%">
                    <tr>
                        <td colspan="3"><strong>Checkout Users</strong></td>
                       
                    </tr> 
                    <tr>
                        <td>User Type</td>
                        <td>Signin Username</td>
                        <td>Signin Password</td>
                        <td>Action</td>
                    </tr>
                    <?php if(sizeof($CheckoutUserdata)>0) { foreach($CheckoutUserdata as $rec) { 

                        ?>
                        <tr>
                        <td style="width: 30%"><?php echo $rec->user_type;?></td>
                        <td style="width: 30%"><?php echo $rec->sign_in_username;?></td>
                        <td style="width: 30%"><?php echo $rec->sign_in_password;?></td>
                        <td style="width: 10%"><a href="javascript:;" onclick="DeleteMe(<?=$rec->id?>)">Delete</a></td>
                    </tr>

                    <?php } }else{

                        ?>
<tr>
                        <td colspan="4">
<p class="alert alert-danger">No record found.</p>
                        </td>
                    </tr>

                        <?php
                    }?>
                    

                </table>
              </div>  

</div>
<div>
  <div  id="merchantUserBlock" style="display: none;">
                <table width="100%">
                    <tr>
                        <td colspan="3"><strong>Merchant Users</strong></td>
                       
                    </tr> 
                    <tr>
                        <td>User Type</td>
                        <td>Signin Username</td>
                        <td>Signin Password</td>
                        <td>Action</td>
                    </tr>
                    <?php
if(sizeof($MerchantUserdata)>0){
                     foreach($MerchantUserdata as $rec) { 

                        ?>
<tr>
                        <td style="width: 30%"><?php echo $rec->user_type;?></td>
                        <td style="width: 30%"><?php echo $rec->sign_in_username;?></td>
                        <td style="width: 30%"><?php echo $rec->sign_in_password;?></td>
                        <td style="width: 10%"><a href="javascript:;" onclick="DeleteMe(<?=$rec->id?>)">Delete</a></td>
                    </tr>
                    <?php } }else{

                        ?>
<tr>
                        <td colspan="4">
<p class="alert alert-danger">No record found.</p>
                        </td>
                    </tr>

                        <?php
                    }?>
                    

                </table>
              </div>  
</div>
<div>
  <div  id="addUserBlock" style="display: none;">
                <table width="100%">
                    <tr>
                        <td colspan="4"><strong>Add User</strong></td>
                       
                    </tr> 
                    <tr>
                        <td colspan="3">
                            
                            <table width="100%">
                                <tr>
                                    <td>User Type</td>
                                    <td>
                                        
                 
                            
                            <select style="color:rgba(255, 255, 255, 0.6);background: #2b3553;" id="addnewUser_user_type" class="form-control" required  >
                            <option value="Admin">Admin</option>
                            <option value="Merchant">Merchant</option>
                            <option value="Checkout">Checkout</option>
                            </select>
                        
                                    </td>
                                </tr>



                                   <tr>
                                    <td>Signin Username</td>
                                    <td>
                                        
                 
                                     <input type="text" value="" name="addnewUser_signin_username" id="addnewUser_signin_username" class="form-control"  >
                           
                        
                                    </td>
                                </tr>

                                <tr>
                                    <td>Signin Password</td>
                                    <td>
                                        
                 
                                     <input type="text" value="" name="addnewUser_signin_password" id="addnewUser_signin_password" class="form-control"  >
                           
                        
                                    </td>
                                </tr>



                                <tr>
                                    <td colspan="2"><button type="button" id="addnewUser" class="btn btn-fill btn-primary">Add User</button></td>
                                  
                                </tr>



                            </table>

                        </td>
                       
                    </tr>
                  

                   
                    

                </table>
              </div>  
</div>

            </form>
        </div>
    </div>
<div class="modal fade" id="requestModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Would you like to proceed?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
    <div class="modal-body">This is a request for a new Member Token.</div>
    <div class="modal-footer">
        <button class="btn btn-secondary float-end" type="button" data-dismiss="modal">Cancel</button>
        <a class="btn btn-primary" href="{{url('merchant/requestNewMemberToken', $data->id)}}">Yes</a>
    </div>
</div>
</div>
</div>

<div class="modal fade" id="verifyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">2fa Code has been sent to your mail.</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
  	<form method="post" action="{{url('merchant/verify2faCode')}}" enctype="multipart/form-data">
        @csrf
    <div class="modal-body">
      	<input type="hidden" value="{{$data->id}}" name="id" required>
      	<h5 style="color:black;">Verify 2fa Code</h5>
        <input type="text" name="code" class="form-control form-control-user" style="color:black;" placeholder="2fa Code" required="">
        
  	</div>
    <div class="modal-footer">
        <button class="btn btn-secondary float-end" type="button" data-dismiss="modal">Cancel</button>
      	<input type="submit" name="upload" id="upload" class="btn btn-primary" value="Verify">
    </div>
    </form>
</div>
</div>
</div>



<div class="modal fade" id="passwordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Change Merchant Backend Password</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
  	<form method="post" action="{{url('merchant/changePassword')}}" enctype="multipart/form-data">
        @csrf
    <div class="modal-body">
      	<input type="hidden" value="{{$data->id}}" name="id" required>
      	<h5 style="color:black;">Old Password : </h5>
        <input type="password" name="old" class="form-control form-control-user" style="color:black;" placeholder="Old Password" required=""><br>
      	<h5 style="color:black;">New Password : </h5>
        <input type="password" name="new" class="form-control form-control-user" style="color:black;" placeholder="New Password" required=""><br>
      	<h5 style="color:black;">Confirm New Password : </h5>
        <input type="password" name="confirm" class="form-control form-control-user" style="color:black;" placeholder="Confirm New Password" required="">
  	</div>
    <div class="modal-footer">
        <button class="btn btn-secondary float-end" type="button" data-dismiss="modal">Cancel</button>
      	<input type="submit" name="upload" id="upload" class="btn btn-primary" value="Proceed">
    </div>
    </form>
</div>
</div>
</div>
 <script>
    function ToggleBlocks(val){
        if(val=='Admin')
        { 
            $('#adminUserBlock').show();
            $('#checkoutUserBlock').hide();
            $('#merchantUserBlock').hide();
            $('#addUserBlock').hide();
        }
          if(val=='Checkout')
        { 

            $('#adminUserBlock').hide();
            $('#checkoutUserBlock').show();
            $('#merchantUserBlock').hide();
            $('#addUserBlock').hide();
        }
          if(val=='Merchant')
        { 
            $('#adminUserBlock').hide();
            $('#checkoutUserBlock').hide();
            $('#merchantUserBlock').show();
            $('#addUserBlock').hide();
        }
           if(val=='Add-User')
        { 
            $('#adminUserBlock').hide();
            $('#checkoutUserBlock').hide();
            $('#merchantUserBlock').hide();
            $('#addUserBlock').show();
        }


    }
// function validateForm() {
function DeleteMe(id){
    var r = confirm("Are you sure you want to delete?");
if (r == true) {
 
} else {
 return false;
}



      $.ajax({
                                headers: {
                                            'X-CSRF-TOKEN': $( 'meta[name="csrf-token"]' ).attr( 'content' )
                                        },
                                url: '<?php echo url("DeleteMerchantUsers")?>',
                                type: 'POST',
                                data: {id:id},
                                
                              
                                  success:function(response){
                                  //alert(response);return false;
                               // if(response=='success') {
                                    alert(response); 
                                    location.reload();
                                    return false;
                                //}
                                }
                                
            });


}

$("#addnewUser").click(function(){
  

  $.ajax({
                                headers: {
                                            'X-CSRF-TOKEN': $( 'meta[name="csrf-token"]' ).attr( 'content' )
                                        },
                                url: '<?php echo url("addNewMerchantUser")?>',
                                type: 'POST',
                                data: {user_type:$("#addnewUser_user_type").val(),signin_username:$("#addnewUser_signin_username").val(),signin_password:$("#addnewUser_signin_password").val(),merchant_id:$("#merchant_id").val()},
                                
                              
                                  success:function(response){
                                  //alert(response);return false;
                               // if(response=='success') {
                                    alert(response); 
                                    location.reload();
                                    return false;
                                //}
                                }
                                
                            });
          

    });      


$("form").submit(function(){
    
    //  alert('asd');
      var x = document.forms["myForm"]["ssh_ip_thor"].value;
    //   alert(x);
      var y = document.forms["myForm"]["ssh_ip_lightning"].value;
      var z = document.forms["myForm"]["ssh_ip_bitcoin"].value;
  if ((/^(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/.test(x))) {  
        //  alert('validated');
         if ((/^(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/.test(y))) {  
        //  alert('validated');
         
              if ((/^(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/.test(z))) {  
        //  alert('validated');
              return true;
                  
              }
         }
       
  } 
    alert("Please provide proper Ip addresses");
    return false;
//   alert("Submitted");
});
   
//   }

</script>
<script type="text/javascript">
    $(document).ready(function(){
        if({{Session::get('sent')!=NULL}})
        {
          console.log("asdf");
          $('#verifyModal').modal('show');
        }
    });
</script>
@endsection
