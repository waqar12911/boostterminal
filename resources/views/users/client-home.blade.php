@extends('layouts.app', ['page' => __('User Profile'), 'pageSlug' => 'profile'])

@section('content')
<style>

.sidebar .sidebar-wrapper>.nav [data-toggle="collapse"]~div>ul>li>a i, .sidebar .sidebar-wrapper .user .info [data-toggle="collapse"]~div>ul>li>a i, .off-canvas-sidebar .sidebar-wrapper>.nav [data-toggle="collapse"]~div>ul>li>a i, .off-canvas-sidebar .sidebar-wrapper .user .info [data-toggle="collapse"]~div>ul>li>a i {
  line-height: 32px;
}
.custom_color , .sorting_1 , table.dataTable.stripe tbody tr.odd, table.dataTable.display tbody tr.odd {
    background: #27293d !important;
}
.dataTables_wrapper .dataTables_length select {
    color: #fff !important;
}
.dataTables_wrapper .dataTables_length, .dataTables_wrapper .dataTables_filter, .dataTables_wrapper .dataTables_info, .dataTables_wrapper .dataTables_processing, .dataTables_wrapper .dataTables_paginate {
    color: #fff !important;
}
.dataTables_wrapper .dataTables_paginate .paginate_button.disabled, .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover, .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:active {
    color: #e7e4e4 !important;
}
.dataTables_wrapper .dataTables_paginate .paginate_button , .dataTables_wrapper .dataTables_filter input {
    color: #fff !important;
}
.card-body {
    overflow-x: scroll;
    /*overflow-y: hidden;*/
}
#myTable_paginate, #myTable_info{
    margin-top: 45px ;
}
.this:hover{
        box-shadow: 0px 0px 8px #0000005e;
    z-index: 2;
    -webkit-transition: all 200ms ease-in;
    -webkit-transform: scale(8);
    -ms-transition: all 200ms ease-in;
    -ms-transform: scale(8);   
    -moz-transition: all 200ms ease-in;
    -moz-transform: scale(8);
    transition: all 200ms ease-in;
    transform: scale(8);
}
</style>
    <div class="content">
        <div class="row">
            @if(Session::has('message'))
                <p class="alert alert-success">{{ Session::get('message') }}</p>
            @endif
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-8">
                                <h4 class="card-title">Clients</h4>
                            </div>
{{--                            <div class="col-4 text-right">--}}
{{--                                <a href="{{route('addClient')}}" class="btn btn-sm btn-primary">Add Client</a>--}}
{{--                            </div>--}}
                        </div>
                    </div>
                    <div class="card-body">
<?php

$img = 1;
?>
                        <div class="">
                            <table id="myTable" class="text-primary display table tablesorter">
                                <thead class="text-primary">
                                <tr><th scope="col">Client Name</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Client id</th>

                                    <!--<th scope="col">Email</th>-->
                                    
                                    <th scope="col">Clientboost</th>
                                    <th scope="col">Maxboost</th>
                                    <th scope="col">Client image</th>
                                    <th scope="col">NIC Image</th>
                                    <!--<th scope="col">Creation Date</th>-->
                                    <th scope="col">Action</th>
                                </tr></thead>
                                <tbody>
                                @foreach($data as $datum)
                                    <tr class="custom_color" >
                                        <td>{{$datum->client_name}}</td>

                                        <td><?php
                                        $img++;
                                        
                                        if($datum->is_active == ''){
                                            $status='';
                                        }
                                        if($datum->is_active == '1'){
                                            $status='Active';
                                        }
                                        if($datum->is_active == '0'){
                                            $status='De-Active';
                                        }
                                        echo $status;
                                        
                                        ?></td>


                                        <td>{{$datum->client_id}}</td>
                                        
                                        <!--<td>{{$datum->email}}</td>-->

                                        <td>{{ round($datum->client_maxboost,2) }}</td>
                                        <td>{{$datum->maxboost_limit}}</td>


                                        <!--client image id-->
                                        <td><img id='{{"img".$img}}' style="width:25px;height:25px;" onmouseover="Large(this)" src="{{asset('public/black/img/clients/'.$datum->client_image_id)}}" alt="" class="img-fluid pos_cl this">  </td>
                                        <!--End client image id-->
                                        <?php
                                        
                                        $img = $img + 1;
                                        
                                        ?>
                                        <!--card image id-->
                                        <td><img id='{{"img".$img}}' style="width:25px;height:25px;"  onmouseover="Large(this)"  src="{{asset('public/black/img/clients/'.$datum->card_image_id)}}" alt="" class="img-fluid pos_cl this">  </td>
                                        <!--End card_image id-->

                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    <a class="dropdown-item" href="{{route('clientEdit',[$datum->id])}}">Edit</a>
                                                    <a class="dropdown-item" href="{{route('clientDelete',[$datum->id])}}">Delete</a>
                                                    
                                                     <!--<a class="btn btn-sm btn-danger" name="{{$datum->id}}"  onclick="archiveFunction(this.name)" >Delete function</a>-->
                                                 <!--<a class="dropdown-item d-none"  type="hidden" id="{{$datum->id}}"  href="{{route('clientDelete',[$datum->id])}}">Delete</a>-->
                                                </div>
                                            </div>
                                        </td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer py-4">
                        <nav class="d-flex justify-content-end" aria-label="...">

                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>


<style>
.pos_cl{
    position:relative;
}
#imgbox 
{
    vertical-align : middle;
    position : absolute;
     top: 30px;
  right: 20;
    margin-right:100px;
    filter: Alpha(Opacity=100);
    visibility : hidden;
    height : 400px;
    width : 400px;
    z-index : 50;
    overflow : hidden;
    text-align : left;
}
</style>
<script>
function getElementLeft(elm) 
{
    var x = 0;

    //set x to elm’s offsetLeft
    x = elm.offsetLeft;

    //set elm to its offsetParent
    elm = elm.offsetParent;

    //use while loop to check if elm is null
    // if not then add current elm’s offsetLeft to x
    //offsetTop to y and set elm to its offsetParent

    while(elm != null)
    {
        x = parseInt(x) + parseInt(elm.offsetLeft);
        elm = elm.offsetParent;
    }
    return x;
}

function getElementTop(elm) 
{
    var y = 0;

    //set x to elm’s offsetLeft
    y = elm.offsetTop;

    //set elm to its offsetParent
    elm = elm.offsetParent;

    //use while loop to check if elm is null
    // if not then add current elm’s offsetLeft to x
    //offsetTop to y and set elm to its offsetParent

    while(elm != null)
    {
        y = parseInt(y) + parseInt(elm.offsetTop);
        elm = elm.offsetParent;
    }

    return y;
}
function Large(obj)
{
    
    var imgbox=document.getElementById("imgbox");
    imgbox.style.visibility='visible';
    var img = document.createElement("img");
    img.src=obj.src;
    img.style.width='200px';
    img.style.height='200px';
    
    if(img.addEventListener){
        img.addEventListener('mouseout',Out,false);
    } else {
        img.attachEvent('onmouseout',Out);
    }             
    imgbox.innerHTML='';
    imgbox.appendChild(img);

}
function Out()
{
    document.getElementById("imgbox").style.visibility='hidden';
}

</script>

<script>
        
        function archiveFunction(id) {
            // alert(id);
event.preventDefault(); // prevent form submit
var form = event.target.form; // storing the form
        swal({
  title: "Are you sure?",
  text: "This operation could not be reversed",
  type: "warning",
  showCancelButton: true,
  confirmButtonColor: "#DD6B55",
  confirmButtonText: "Yes, Delete it!",
  cancelButtonText: "No, cancel please!",
  closeOnConfirm: false,
  closeOnCancel: false
},
function(isConfirm){
  if (isConfirm) {
     document.getElementById(id).click();         // submitting the form when user press yes
  } else {
    swal("Cancelled", "Record is safe!", "error");
  }
});
}
    </script>

<!--<div id="imgbox"></div>-->

@endsection
