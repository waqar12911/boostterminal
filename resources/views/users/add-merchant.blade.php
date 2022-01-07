<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@extends('layouts.app')

@section('content')
    <div class="set_form">
        <div class="card">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <div class="card-header">
                <h5 class="title">add Profile</h5>
            </div>
            <form method="post" action="{{route('createMerchant')}}"  onsubmit="return validateForm()" id="myForm" autocomplete="off" enctype="multipart/form-data">
                <div class="card-body">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Merchant Id</label>
                            <input type="text" name="merchant_id" class="form-control" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="store_name">Store Name</label>
                            <input type="text" name="store_name" class="form-control" required>
                        </div>
                      {{-- <div class="form-group col-md-6">
                            <label for="store_name">Merchant Password</label>
                            <input type="text" name="password" value="{{$data->password}}" class="form-control" required>
                        </div> --}}
                        
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="store_name">Merchant Backend Password</label>
                            <input type="text" name="merchant_backend_password" class="form-control" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="store_name">Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Maxboost Limit</label>
                            <input type="number" name="maxboost_limit" class="form-control" required  >
                        </div>
                      	<div class="form-group col-md-6">
                            <label for="inputPassword4">Merchant Maxboost</label>
                            <input type="number" name="merchant_maxboost" class="form-control" required  >
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="store_name">latitude</label>
                            <input type="text" name="latitude" class="form-control" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">longitude</label>
                            <input type="text" name="longitude" class="form-control" required  >
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="ssh_ip_port">SSH IP PORT</label>
                            <input type="text" name="ssh_ip_port" class="form-control" required  >
                        </div>
                        <div class="form-group col-md-6">
                            <label for="ssh_username">SSH USERNAME</label>
                            <input type="text" name="ssh_username" class="form-control" required  >
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="ssh_password">SSH PUBLIC KEY</label>
                            <input type="text" name="ssh_password" class="form-control" required  >
                        </div>
                        
                         <div class="form-group col-md-6">
                            <label for="store_name">Boost 2FA Password</label>
                            <input type="text" name="boost_2fa_password" class="form-control" required>
                        </div>
                        
                    </div>








                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="admin_administrator_password">Admin Administrator Password</label>
                            <input type="text" name="admin_administrator_password" class="form-control" required  >
                        </div>
                        
                        <div class="form-group col-md-6">
                            <label for="admin_administrator_password">Add Notes</label>
                            <textarea type="text" name="notes" class="form-control border" required  > </textarea>
                        </div>
                        
                        
                    </div> 
                       <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="ssh_password">Tax Rate</label>
                            <input type="text" name="tax_rate" class="form-control" required  >
                        </div>
                    


                        
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="ssh_password">Container Address</label>
                            <input type="text" name="container_address" class="form-control" required  >
                        </div>
                        <div class="form-group col-md-6">
                            <label for="ssh_password">Lightning Port</label>
                            <input type="text" name="lightning_port" class="form-control" required  >
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="ssh_password">MWS Port</label>
                            <input type="text" name="mws_port" class="form-control" required  >
                        </div>
                      	<div class="form-group col-md-6">
                            <label for="ssh_password">PWS Port</label>
                            <input type="text" name="pws_port" class="form-control" required  >
                        </div>
                    </div>




                    <div style="margin-bottom:20px" class="form-row">
                        <div class="form-check">
                            <input type="checkbox" name="is_own_bitcoin" checked value="1" style="margin-left:5px;visibility: visible;opacity:1" class="form-check-input" id="isown">
                            <label class="form-check-label" for="isown">Own Bitcoin Node</label>
                          </div>
                    </div>



                    <div id="rpcDetails" class="form-row">
                        <div class="form-group col-md-6">
                            <label for="rpc_username">RPC USERNAME </label>
                            <input type="text" name="rpc_username" class="form-control"  >
                        </div>
                        <div class="form-group col-md-6">
                            <label for="rpc_password">RPC PASSWORD</label>
                            <input type="text" name="rpc_password" class="form-control"  >
                        </div>
                    </div>
                </div>
                                
                <div class="card-footer pull-right">
                    <button type="submit" class="btn btn-fill btn-primary">save</button>
                </div>
            </form>
        </div>
    </div>
    
    
     <script>

    //$("#rpcDetails").hide();
    $("#isown").click(function() {
        if($(this).is(":checked")) {
            //$("#rpcDetails").show(300);
            $("#isown").val(1);
        } else {
            //$("#rpcDetails").hide(200);
            $("#isown").val(0);
        }
    });
        
         
    
// function validateForm() {

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



@endsection
