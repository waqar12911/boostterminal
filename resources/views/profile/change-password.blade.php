<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@extends('layouts.app')

@section('content')
    <div class="set_form">
           @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        @if(isset($code))
        <div class="card">
            
            <div class="card-header">
                <h5 class="title">Password Change 2fa</h5>
            </div>
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="alert alert-success">
                        <p>You will receive a email for verification code please verify here.</p>
                    </div>
                     <form method="get" action="{{route('password-change.2fa')}}"  autocomplete="off" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="inputEmail4">2fa Code</label>
                                    <input type="text" name="verify_code" class="form-control" required>
                                </div>
                            </div>


                        </div>
                                        
                        <div class="card-footer pull-right">
                            <button type="submit" class="btn btn-fill btn-primary">Verify</button>
                        </div>
                    </form>
                </div>
            </div>
            

           
        </div>
        @else

            <div class="card">
            
            <div class="card-header">
                <h5 class="title">Change Password</h5>
            </div>
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                     <form method="post" action="{{route('admin-password.update')}}"  autocomplete="off" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="verify_code" value="{{$_GET['verify_code']}}">
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="inputEmail4">Password</label>
                                    <input type="text" name="password" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="inputEmail4">Confirm Password</label>
                                    <input type="text" name="password_confirmation" class="form-control" required>
                                </div>
                            </div>


                        </div>
                                        
                        <div class="card-footer pull-right">
                            <button type="submit" class="btn btn-fill btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
            

           
        </div>
        @endif
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
