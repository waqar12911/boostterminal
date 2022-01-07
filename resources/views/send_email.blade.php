<!DOCTYPE html>

<html>

<head>

	<title>Email</title>

	 <meta charset="utf-8">

  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <style>

        html,

body {

    margin: 0 auto !important;

    padding: 0 !important;

    height: 100% !important;

    width: 100% !important;

    background: #f1f1f1;

}





* {

    -ms-text-size-adjust: 100%;

    -webkit-text-size-adjust: 100%;

}





div[style*="margin: 16px 0"] {

    margin: 0 !important;

}





table,

td {

    mso-table-lspace: 0pt !important;

    mso-table-rspace: 0pt !important;

}





table {

    border-spacing: 0 !important;

    border-collapse: collapse !important;

    table-layout: fixed !important;

    margin: 0 auto !important;

}





img {

    -ms-interpolation-mode:bicubic;

}



a {

    text-decoration: none;

}



*[x-apple-data-detectors],  

.unstyle-auto-detected-links *,

.aBn {

    border-bottom: 0 !important;

    cursor: default !important;

    /*color: inherit !important;*/

    text-decoration: none !important;

    font-size: inherit !important;

    font-family: inherit !important;

    font-weight: inherit !important;

    line-height: inherit !important;

}



/* What it does: Prevents Gmail from displaying a download button on large, non-linked images. */

.a6S {

    display: none !important;

    opacity: 0.01 !important;

}



/* What it does: Prevents Gmail from changing the text color in conversation threads. */

.im {

       color: #6f6f6f;

}



/* If the above doesn't work, add a .g-img class to any image in question. */

img.g-img + div {

    display: none !important;

}





@media only screen and (min-device-width: 320px) and (max-device-width: 374px) {

    u ~ div .email-container {

        min-width: 320px !important;

    }

}

/* iPhone 6, 6S, 7, 8, and X */

@media only screen and (min-device-width: 375px) and (max-device-width: 413px) {

    u ~ div .email-container {

        min-width: 375px !important;

    }

    .ggg{

    	    line-height: 30px !important;

    }

}

/* iPhone 6+, 7+, and 8+ */

@media only screen and (min-device-width: 414px) {

    u ~ div .email-container {

        min-width: 414px !important;

    }

}





    </style>



    <!-- CSS Reset : END -->



    <!-- Progressive Enhancements : BEGIN -->

    <style>



	    .primary{

	background: #f5564e;

}

.bg_white{

	background: #ffffff;

}

.bg_light{

	background: #fafafa;

}

.bg_black{

	background: #000000;

}

.bg_dark{

	background: #ffcd33;

}

.email-section{

	padding:2.5em 2.5em 0;

}



/*BUTTON*/

.btn{

	padding: 5px 15px;

	display: inline-block;

}

.btn.btn-primary{

	border-radius: 5px;

	background: #f5564e;

	color: #ffffff;

}

.btn.btn-white{

	border-radius: 5px;

	background: #ffffff;

	color: #000000;

}

.btn.btn-white-outline{

	border-radius: 5px;

	background: transparent;

	border: 1px solid #fff;

	color: #fff;

}



h1,h2,h3,h4,h5,h6{

	font-family: 'Nunito Sans', sans-serif;

	color: #000000;

	margin-top: 0;

}



body{

	font-family: 'Nunito Sans', sans-serif;

	font-weight: 400;

	font-size: 15px;

	line-height: 1.8;

	/*color: rgba(0,0,0,.4);*/

}



a{

	/*color: #f5564e;*/

}



table{

}

/*LOGO*/



.logo h1{

	margin: 0;

}

.logo h1 a{

	color: #000;

	font-size: 20px;

	font-weight: 700;

	text-transform: uppercase;

	font-family: 'Nunito Sans', sans-serif;

}



.navigation{

	padding: 0;

}

.navigation li{

	list-style: none;

	display: inline-block;;

	margin-left: 5px;

	font-size: 12px;

	font-weight: 700;

	text-transform: uppercase;

}

.navigation li a{

	/*color: rgba(0,0,0,.6);*/

}



/*HERO*/

.hero{

	position: relative;

	z-index: 0;

}

.hero .overlay{

	position: absolute;

	top: 0;

	left: 0;

	right: 0;

	bottom: 0;

	content: '';

	width: 100%;

	background: #00000040;

	z-index: -1;

	opacity: .3;

}

.hero .icon{

}

.hero .icon a{

	display: block;

	width: 60px;

	margin: 0 auto;

}

.hero .text{

	/*color: rgba(255,255,255,.8);*/

	padding: 0 4em;

}

.hero .text h2{

	color: #ffffff;

	font-size:32px;

	margin-bottom: 0;

	line-height: 1.2;

	font-weight: 900;

}





/*HEADING SECTION*/

.heading-section{

}

.heading-section h2{

	color: #000000;

	font-size: 24px;

	margin-top: 0;

	line-height: 1.4;

	font-weight: 700;

}

.heading-section .subheading{

	margin-bottom: 20px !important;

	display: inline-block;

	font-size: 13px;

	text-transform: uppercase;

	letter-spacing: 2px;

	/*color: rgba(0,0,0,.4);*/

	position: relative;

}

.heading-section .subheading::after{

	position: absolute;

	left: 0;

	right: 0;

	bottom: -10px;

	content: '';

	width: 100%;

	height: 2px;

	background: #f5564e;

	margin: 0 auto;

}



.heading-section-white{

	/*color: rgba(255,255,255,.8);*/

}

.heading-section-white h2{

	font-family: 

	line-height: 1;

	padding-bottom: 0;

}

.heading-section-white h2{

	/*color: #ffffff;*/

}

.heading-section-white .subheading{

	margin-bottom: 0;

	display: inline-block;

	font-size: 13px;

	text-transform: uppercase;

	letter-spacing: 2px;

	/*color: rgba(255,255,255,.4);*/

}





.icon{

	text-align: center;

}

.icon img{

}





/*SERVICES*/

.services{

	background: rgba(0,0,0,.03);

}

.text-services{

	padding: 10px 10px 0; 

	text-align: center;

}

.text-services h3{

	font-size: 16px;

	font-weight: 600;

}



.services-list{

	padding: 0;

	margin: 0 0 10px 0;

	width: 100%;

	float: left;

}



.services-list .text{

	width: 100%;

	float: right;

}

.services-list h3{

	margin-top: 0;

	margin-bottom: 0;

	font-size: 18px;

}

.services-list p{

	margin: 0;

}





/*DESTINATION*/

.text-tour{

	padding-top: 10px;

}

.text-tour h3{

	margin-bottom: 0;

}

.text-tour h3 a{

	color: #000;

}



/*BLOG*/

.text-services .meta{

	text-transform: uppercase;

	font-size: 14px;

}



/*TESTIMONY*/

.text-testimony .name{

	margin: 0;

}

.text-testimony .position{

	color: rgba(0,0,0,.3);



}





/*COUNTER*/

.counter{

	width: 100%;

	position: relative;

	z-index: 0;

}

.counter .overlay{

	position: absolute;

	top: 0;

	left: 0;

	right: 0;

	bottom: 0;

	content: '';

	width: 100%;

	background: #000000;

	z-index: -1;

	opacity: .3;

}

.counter-text{

	text-align: center;

}

.counter-text .num{

	display: block;

	color: #ffffff;

	font-size: 34px;

	font-weight: 700;

}

.counter-text .name{

	display: block;

	color: rgba(255,255,255,.9);

	font-size: 13px;

}

.price{

color: #ffcd33 !important;

}



ul.social{

	padding: 0;

}

ul.social li{

	display: inline-block;

}



/*FOOTER*/



.footer{

	color: rgba(255,255,255,.5);



}

.footer .heading{

	color: #ffffff;

	font-size: 20px;

}

.footer ul{

	margin: 0;

	padding: 0;

}

.footer ul li{

	list-style: none;

	margin-bottom: 10px;

}

.footer ul li a{

	color: rgba(255,255,255,1);

}





@media screen and (max-width: 500px) {



	.icon{

		text-align: left;

	}



	.text-services{

		padding-left: 0;

		padding-right: 20px;

		text-align: left;

	}



}





    </style>

</head>

<body>

	<div class="container">

		<div class="table_email" style="background-color: #fff; padding-top: 30px; text-align: center;">

	

	



                                    
             <img src="{{url('public/logo.png')}}" alt="Evernote" > <br>
             <h2 style="text-align: center; ">Merchantnode Login Credentials</h2>

<h2 style="text-align: center; color: #ffcd33;"> @if(isset($name))Hello  {{$name}} @endif</h2>

	<div class="link_site">

		<p style="text-align: center;">

                    
                      <div class="row" style="text-align: center; ">
					    <h3>Email:    <strong> {{$user_mail}}</strong> </h3>
					    </div>
					   <div class="row" style="text-align: center; "> 
					    <h3>Password:   <strong style="    font-size: 20px;
    font-weight: 500;">{{$user_pass}}</strong> </h3>
						</div>
						<br>
						<a href="http://merchantnode.stepinnsolution.com/login" style="padding: 10px;    background: #ffcd33;    border-radius: 6px;    color: #000;">Click here to login.</a>


		</p>







</div>



</body>

</html>