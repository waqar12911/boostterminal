@extends('layouts.app')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@section('content')
  
  <style>
      
      .dropdowncolor option{
              color : #000 !important;
          
      }
    
    .onoffswitch {
    position: relative; width: 125px;
    -webkit-user-select:none; -moz-user-select:none; -ms-user-select: none;
}
.onoffswitch-checkbox {
    display: none;
}
.onoffswitch-label {
    display: block; overflow: hidden; cursor: pointer;
    border: 2px solid #999999; border-radius: 20px;
}
.onoffswitch-inner {
    display: block; width: 200%; margin-left: -100%;
    transition: margin 0.3s ease-in 0s;
}
.onoffswitch-inner:before, .onoffswitch-inner:after {
    display: block; float: left; width: 50%; height: 30px; padding: 0; line-height: 30px;
    font-size: 14px; color: white; font-family: Trebuchet, Arial, sans-serif; font-weight: bold;
    box-sizing: border-box;
}
.onoffswitch-inner:before {
    content: "Active";
    padding-left: 10px;
    background-color: green; color: #FFFFFF;
}
.onoffswitch-inner:after {
    content: "Inactive";
    padding-right: 10px;
    background-color: red; color: #FFFFFF;
    text-align: right;
}
.onoffswitch-switch {
    display: block; width: 46px; margin: 2px;
    background: #FFFFFF;
    position: absolute; top: 0; bottom: 0;
    right: 75px;
    border: 2px solid #999999; border-radius: 20px;
    transition: all 0.3s ease-in 0s; 
}
.onoffswitch-checkbox:checked + .onoffswitch-label .onoffswitch-inner {
    margin-left: 0;
}
.onoffswitch-checkbox:checked + .onoffswitch-label .onoffswitch-switch {
    right: 0px; 
}
      
  </style>

    <div class="set_form">
        <div class="card">

            <div class="card-header">
                <h5 class="title">Client Edit</h5>
            </div>
            @if(Session::has('message'))
                <p class="alert alert-info">{{ Session::get('message') }}</p>
            @endif
            
           
            
            <form method="post" action="{{route('updateClient',[$data->id])}}" autocomplete="off" enctype="multipart/form-data">
                <div class="card-body">
                    @csrf
                    <div class="form-row">

                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Name</label>
                            <input type="hidden" name="id" id="id" value="{{$data->id}}">
                            <input type="text" name="client_name" id="client_name" value="{{$data->client_name}}" class="form-control">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="inputEmail4">client id</label>
                            <input type="text" name="client_id" id="client_id" readonly value="{{$data->client_id}}" class="form-control">
                        </div>
                        
                         <div class="form-group col-md-6">
                            <label for="inputEmail4">Merchant id</label>
                            <input type="text" name="merchant_id" readonly value="{{$data->merchant_id}}" class="form-control">
                        </div>
                        
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Is gamma user</label>
                            <!--<input type="text" name="national_id" value="{{$data->national_id}}" class="form-control">-->
                           <select  class="form-control dropdowncolor" required name="is_gamma_user">
                            <option value="">Change status</option>
                            <option value="1" @if($data->is_gamma_user == 1) selected  @endif>Yes</option>
                            <option value="0" @if($data->is_gamma_user == 0) selected  @endif>No</option>
                            
                          </select>
                        </div>


                        <div class="form-group col-md-6">
                            <label for="inputEmail4">National Id</label>
                            <input type="text" name="national_id" value="{{$data->national_id}}" class="form-control">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Client Backend Password</label>
                             <?php 
                                $val;      
                             if($data->client_backend_password == 'NULL'|| $data->client_backend_password == NULL || $data->client_backend_password == 'null')  {
                                    ?>
                                               <input type="text" name="client_backend_password" class="form-control" placeholder="Enter Password" required value="">
                                    <?php
                                 
                             }
                             else{
                                ?>
                                               <input type="text" name="client_backend_password" class="form-control" required value="{{$data->client_backend_password}}">
                                    <?php
                             }
                             
                             ?>
                 
                        </div>

                        <div class="form-group col-md-6">
                            <label for="inputEmail4">address</label>
                            <input type="text" name="address" value="{{$data->address}}" required class="form-control">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="inputEmail4">email</label>
                            <input type="email" name="email" value="{{$data->email}}" id="email" required class="form-control">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Data of Birth</label>
                            <input type="text" name="dob" value="{{$data->dob}}" class="form-control">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="inputEmail4">MaxBoost Limit</label>
                            <input type="number" name="maxboost_limit" value="{{$data->maxboost_limit}}" class="form-control" id="inputEmail4" placeholder="MaxBoost limit">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="inputEmail4">ClientBoost Limit</label>
                            <input type="number" name="client_maxboost" value="{{$data->client_maxboost}}" class="form-control" id="inputEmail5" placeholder="ClientBoost Limit">
                        </div>                        
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Status</label>
                            <select  name="is_active" value="{{$data->is_active}}" class="form-control" id="status-change" style="background: #27293d; ">
                                <option value="{{$data->is_active}}" selected ><?php
                                        if($data->is_active == ''){
                                            $status='';
                                        }
                                        if($data->is_active == '1'){
                                            $status='Active';
                                        }
                                        if($data->is_active == '0'){
                                            $status='De-Active';
                                        }
                                        echo $status;
                                        ?></option>
                                        <option value="1">Active</option>
                                        <option value="0">De-Active</option>
                            </select>
                            
                            <!--<input type="text" name="is_active" value="{{$data->is_active}}" class="form-control" id="inputPassword4">-->
                        </div>
                        <div class="form-group col-md-6">
                            <label for="ssh_password">Container Address</label>
                            <input type="text" name="container_address" class="form-control" value="{{$data->container_address}}" required  >
                        </div>
                        <div class="form-group col-md-6">
                            <label for="ssh_password">Lightning Port</label>
                            <input type="text" name="lightning_port" class="form-control" value="{{$data->lightning_port}}" required  >
                        </div>
                        <div class="form-group col-md-6">
                            <label for="ssh_password">MWS Port</label>
                            <input type="text" value="{{$data->mws_port}}" name="mws_port" class="form-control" required  >
                        </div>
                        <div class="form-group col-md-6">
                            <label for="ssh_password">PWS Port</label>
                            <input type="text" value="{{$data->pws_port}}" name="pws_port" class="form-control" required  >
                        </div>
                      	<div class="form-group col-md-6">
                            <label for="ssh_password">FP Status</label>
                            <div class="onoffswitch">
                              <input type="checkbox" disabled name="onoffswitch" <?php if($data->fp_status){echo('checked');}?> class="onoffswitch-checkbox" id="myonoffswitch">
                              <label class="onoffswitch-label" for="myonoffswitch">
                                  <span class="onoffswitch-inner"></span>
                                  <span class="onoffswitch-switch"></span>
                              </label>
                          </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="ssh_password">FP Expiration Date</label>
                            <input type="date" value="{{$data->fp_expiration}}" name="fp_expiration" id="fp_expiration" class="form-control" required  >
                        </div>
                    </div>
                </div>
                
                <div class="form-group col-md-4">
                            <img src="{{asset('public/black/img/clients/'.$data->client_image_id)}}"  alt="" class="img-fluid w-100 modal-img">
                    <label class="btn btn-outline-neutral">Change Client Image
                    <input type="file" name="client_image_id"  >
                    </label>
                </div>
                 <div class="dummy_images">

                             
                              <!--<input type="file" name="back_image">-->

                            </div>

                <div class="form-group col-md-4">
                              <img src="{{asset('public/black/img/clients/'.$data->card_image_id)}}"  alt="" class="img-fluid w-100 modal-img">
                    <label class="btn btn-outline-neutral"> Change Identification Image
                    <input type="file" id="output" name="card_image_id"  >
                    <!--<input name="photo" type="file" accept="image/*" onchange="document.getElementById('output').src = window.URL.createObjectURL(this.files[0])">-->
                    </label>
                </div>
                   <div class="dummy_images">

                      
                              <!--<input type="file" name="back_image">-->

                            </div>

                <div class="card-footer pull-right">
                    <button type="submit" class="btn btn-fill btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
    
    <!--Modal for staus active inactive-->
    <div class="modal fade in" id="active" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
         <form method="POST" action="{{ route('weeklyMail') }}">
             @csrf
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Custom Report</h5>
              </div>
              <div class="modal-body">
                  <div>
                    <label class="" style="color: black;">Destination Email:</label>
                    <input type="email" name="weekMail" class="form-control"  style="color: black;"/ required>
                </div>
                <div class="mt-4">
                      <div>
                          <div>
                            <label class="" style="color: black;">From Date: </label>
                            <input type="date" class="weekValue form-control" name="weekStart"  style="color: black;"  max="<?php echo date("Y-m-d"); ?>"  required>
                          </div>
                          <div>
                            <label class="" style="color: black;">To Date: </label>
                             <input type="date" class="weekValue form-control" name="weekEnd"  style="color: black;"  max="<?php echo date("Y-m-d"); ?>" required>
                        </div>
                     </div>  
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onClick="closeModal(active)" >Close</button>
                <button type="submit" name="weekbtn" class="btn btn-primary weeklyBtn">Send</button>
              </div>
            </div>
        </form>
      </div>
    </div>   

 <!--Modal for staus active inactive-->
    <div class="modal fade in" id="deactive" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
         <form method="POST" action="{{ route('weeklyMail') }}">
             @csrf
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">deactive Report</h5>
              </div>
              <div class="modal-body">
                 
                
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" >Close</button>
                <button type="submit" name="weekbtn" class="btn btn-primary weeklyBtn">Send</button>
              </div>
            </div>
        </form>
      </div>
    </div>   

<script>

        $(document).ready(function() {
            $('#status-change').change(function() {
            var $option = $(this).find('option:selected');
            var status = $option.val();
            var id = $("#id").val();
            var email = $("#email").val();
            var client_id = $('#client_id').val();
            var client_name = $('#client_name').val();
           
            if(status == 1){
                swal({
                      title: "Are you sure you want to activate this user?",
                    //   text: "Once deleted, you will not be able to recover this imaginary file!",
                      icon: "warning",
                      buttons: ["Cancel", "Activate"],
                      successMode: true,
                    })
                    .then((willDelete) => {
                      if (willDelete) {
                          
                          $.ajax( {
            					headers: {
            						'X-CSRF-TOKEN': $( 'meta[name="csrf-token"]' ).attr( 'content' )
            					},
            					type: 'POST',
            					url: "/change-status",
            					data: {'status': status, 'id': id, 'email': email, 'client_id': client_id, 'client_name': client_name},
            					success: function ( msg ) {
                                   
            					}
            				});
                          
                        swal("success! User activated successfully!", {
                          icon: "success",
                        });
                        
                      } else {
                        swal("Thanks!");
                      }
                    });
			
            }else{
                 swal({
                      title: "Are you sure you want to De Activate this user?",
                    //   text: "Once deleted, you will not be able to recover this imaginary file!",
                      icon: "warning",
                      buttons: ["Cancel", "De-Activate"],
                      dangerMode: true,
                    })
                    .then((willDelete) => {
                      if (willDelete) {
                          
                          $.ajax( {
            					headers: {
            						'X-CSRF-TOKEN': $( 'meta[name="csrf-token"]' ).attr( 'content' )
            					},
            					type: 'POST',
            					url: "/change-status",
            					data: {'status': status, 'id': id, 'email': email, 'client_id': client_id, 'client_name': client_name},
            					success: function ( msg ) {
                                   
            					}
            				});
                          
                        swal("success! User De-activated successfully!", {
                          icon: "success",
                        });
                        
                      } else {
                        swal("Thanks!");
                      }
                    });
            }
            
        });
    });
   
	
</script>
<script>
  $('#fp_expiration').on('change', function() {
    var today = '<?php echo(date("Y-m-d"));?>';
    var expire = this.value;
    if(today < expire) 
  	{
    	$( "#myonoffswitch").prop('checked', true);
 	}
    else
    {
      	$( "#myonoffswitch").prop('checked', false);
    }
});
</script>


@endsection
