@extends('layouts.app', ['page' => __('transactions'), 'pageSlug' => 'transactions'])
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

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
.set_size {
        padding: 8px 14px;
}
.search_box input {
    padding: 5px 15px;
    border-radius: 6px;
    border: none;
    outline: none;
    background: #f8f8f8;
    color: #000;
}
.text-align {
    text-align: end;
}
#checkall {
    margin-left: -7px;
    margin-right: 5px;
}
.set_style {
    padding: 10px 15px;
}
#transection-data {
    overflow-x: scroll;
}
.align_input .bootEmail  {
        padding: 0 !important;
    height: 33px;
    border: 1px solid;
    margin-right: 10px;
}
.align_input .bootSendEmail {
    padding: 8px 19px;
    text-align: center;
    display: flex;
    justify-content: center;
}
.dateRange{
        text-align: right;
         margin-right: 212px;
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
                             <div class="col-2">
                                <h4 class="card-title">Transactions</h4>
                            </div>
                             <div  class="col-2">
                                       <div class="form-check">
                                        <label class="form-check-label"> Daily
                                          <input class="form-check-input dailyCheckBox" name="dailyName" type="checkbox" value="daily" @if($status['0']->is_email == "auto") checked @endif>
                                          <span class="form-check-sign">
                                            <span class="check"></span>
                                          </span>
                                        </label>
                                         <label class="form-check-label"> Weekly
                                          <input class="form-check-input weeklyCheckBox" name="weeklyName" type="checkbox" value="weekly" value="daily" @if($status['1']->is_email == 'auto') checked @endif>
                                          <span class="form-check-sign">
                                            <span class="check"></span>
                                          </span>
                                        </label>
                                         <label class="form-check-label"> Monthly
                                          <input class="form-check-input monthlyCheckBox" name="monthlyName" type="checkbox" value="monthly" value="daily" @if($status['2']->is_email == 'auto') checked @endif>
                                          <span class="form-check-sign">
                                            <span class="check"></span>
                                          </span>
                                        </label>
                                      </div>
                                    </div>
                             <div  class="col-2">
                                          <lable>Send Manual Email</lable>
                                         <button type="button" class="btn btn-sm" id="myBtn" data-toggle="modal" data-target="#myBtn">Go</button>
                                        
                                    </div>
                             <div class="col-6 text-align">
                                <form action="{{route('filterTransections')}}" id="filtertransection" method="GET">
                                   <!--@scrf-->
                                    <div class="dateRange">
                                       <span>Select date range of tx's to display</span>
                                   </div>
                                    <div class="search_box">
                                        <input type="text" name="date_from" placeholder="Start Date" onfocus="(this.type='date')" onblur="(this.type='text')">
                                        <input type="text" name="date_to" placeholder="End Date" onfocus="(this.type='date')" onblur="(this.type='text')">
                                        <button type="submit" class="btn set_size"><i class="fa fa-search"></i></button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                    <div class="card-body">

                       <div class="" id="transection-data">
                            @include("transaction._transactions",['data' => $data])
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
    
    <div class="modal fade" id="checkModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="align_checkbox">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                  <label class="form-check-label" for="defaultCheck1">
                    Default checkbox
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                  <label class="form-check-label" for="defaultCheck1">
                    Default checkbox
                  </label>
                </div>
            </div>
          </div>
          <div class="modal-footer">
            <!--<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
            <button type="button" class="btn btn-primary">Send Mail</button>
          </div>
        </div>
      </div>
    </div>
 
 
   <!-- modal for mannual email modal start-->
    <!--Daily Modal-->
   <div class="modal fade in" id="dailyModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
         <form method="POST" action="{{ route('dailyMail') }}">
               @csrf
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Custom Report</h5>
              </div>
              <div class="modal-body">
                  <div>
                    <label class="" style="color: black;">Destination Email:</label>
                    <input type="hidden" name="searchIds[]" id="checkValues" />
                    <input type="email" name="dailyEmail" class="form-control"  style="color: black;"/>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" onClick="closeModal(dailyModal)"  class="btn btn-secondary">Close</button>
                <button type="submit" class="btn btn-primary">Send</button>
              </div>
            </div>
        </form>
      </div>
    </div>
    <!--Weekly Modal-->
    <div class="modal fade in" id="weeklyModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                <button type="button" class="btn btn-secondary" onClick="closeModal(weeklyModal)" >Close</button>
                <button type="submit" name="weekbtn" class="btn btn-primary weeklyBtn">Send</button>
              </div>
            </div>
        </form>
      </div>
    </div>   
    
 
 <script>
     function closeModal(id){
         $(id).modal('hide'); 
        $('.modal-backdrop').remove();
     }
 </script>
 
 <!--Script for multiple chack box   -->
<script>
        $('#checkall').change(function () {
            $('.cb-element').prop('checked',this.checked);
        });
        
        $('.cb-element').change(function () {
         if ($('.cb-element:checked').length == $('.cb-element').length){
          $('#checkall').prop('checked',true);
         }
         else {
          $('#checkall').prop('checked',false);
         }
        });
</script>

<!--Script for data table search-->
<script>
    $("#filtertransection").submit(function (e) {
        e.preventDefault();
        let url = $(this).attr("action");
        $.get(url,$(this).serialize(),function (response) {
            $("#transection-data").html(response)
    });
    });

</script>

<!--Controlling the auto email daily, weekly, monthly-->
<script>
    $(document).ready(function () {
        // daily auto email controlling
    $(".dailyCheckBox").click(function(){
         var dailyCheck =  $("input[name='dailyName']:checked").val();
         if(dailyCheck == 'daily'){
           var daily = 'auto';
         }else{
           var daily = 'manual';
         }
         
         $.ajax({
              headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
                url: "/is-email-allow",
                data: {'type': 'daily', 'userType': 'beta', 'emailStatus': daily},
                type: "POST",
                success: function (response) {
                     if(response == 'auto'){
                        alert('your daily automation is Activated');
                    }else{
                        alert('your daily automation is de-Activated');
                    }
                     if(response == 'no'){
                        alert('something wrong');
                    }
                    
              }
          });
         
         
    });
    // weekly auto email controlling
    $(".weeklyCheckBox").click(function(){
         var weeklyCheck =  $("input[name='weeklyName']:checked").val();
        if(weeklyCheck == 'weekly'){
           var weekly = 'auto';
         }else{
           var weekly = 'manual';
         }
         
         $.ajax({
              headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
                url: "/is-email-allow",
                data: {'type': 'weekly', 'userType': 'beta', 'emailStatus': weekly},
                type: "POST",
                success: function (response) {
                     if(response == 'auto'){
                        alert('your weekly automation is Activated');
                    }else{
                        alert('your weekly automation is de-Activated');
                    }
                     if(response == 'no'){
                        alert('something wrong');
                    }
                    
              }
          });
    });
    // monthly auto email controlling
     $(".monthlyCheckBox").click(function(){
         var monthlyCheck =  $("input[name='monthlyName']:checked").val();
         
          if(monthlyCheck == 'monthly'){
           var monthly = 'auto';
         }else{
           var monthly = 'manual';
         }
         
         $.ajax({
              headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
                url: "/is-email-allow",
                data: {'type': 'monthly', 'userType': 'beta', 'emailStatus': monthly},
                type: "POST",
                success: function (response) {
                     if(response == 'auto'){
                        alert('your monthly automation is Activated');
                    }else{
                        alert('your monthly automation is de-Activated');
                    }
                     if(response == 'no'){
                        alert('something wrong');
                    }
                    
              }
          });
    
    });
    }); 
</script>

<script>
        $(document).ready(function () {

     // Attach Button click event listener 
    $("#myBtn").click(function(){
        
          var searchIDs = $("#bootBody input:checkbox:checked").map(function(){
                 return $(this).val();
               }).get();
               
          $('#checkValues').val(searchIDs);
          
         if(searchIDs.length !== 0){
           
            $('#dailyModal').modal('show');
            
         }else{
             $('#weeklyModal').modal('show');
         }
         
    });
});
</script>

<!--Script for data table entries increment-->
<script>
    $(document).ready(function() {
	  $('#myTable').DataTable({
      pageLength:25,
	  });
	});
</script>

@endsection

            

