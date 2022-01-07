<!DOCTYPE html>
<html>
    <head>
        
    </head>
    <body>
         <div>
            <h1>
                Welcome Sovereign, to the Next Layer Boost Terminal.
            </h1>
            <h2>
                The fastest way to recharge your lightning line!
            </h2>
             <h2>
                Here is your new user information:
            </h2>
        </div>
        <div>
               <h3>Client ID:  {{$client_id}}</h3>
               <h3>Client Name:  {{$client_name}}</h3>
               <h3>Client email:  {{$email}}</h3>
               <h3>Client Status:  {{$is_active}}</h3>
          	   @if($is_gamma_user)
          	   <p>Your New Temporary Client Login Password:<b>{{$password}}</b>.  This password must be changed in order for you to take advantage of great services like Flashpay.  Please click the link below to login to the Client Portal to create your unique password.  Your temp password expires in 2 hours: </p>
          		<p style="text-align:center;">Proceed to Client Portal (https://nextlayer.live/clientapp)</p>
          		<p style="text-align:center;">If you fail to register in the allotted time, you may contact Next Layer Technology Cutomer Service at: clienthelp@nextlayer.live</p>
          		@endif
                
        </div>
    </body>
</html>