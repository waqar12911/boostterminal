@extends('layouts.app', ['page' => __('transactions alpha'), 'pageSlug' => 'transactions alpha'])

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
                            <div class="col-3">
                                <h4 class="card-title">Transactions</h4>
                            </div>
                            <div class="col-9 text-align">
                                <form action="{{route('filterTransection')}}" id="filtertransection" method="GET">
                                   <!--@scrf-->
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
                            @include("admin_settings.alpha-transection._transactions",['data' => $data])
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
    
   
@endsection
@push('js')
<script>
    $("#filtertransection").submit(function (e) {
        e.preventDefault();
        let url = $(this).attr("action");
        $.get(url,$(this).serialize(),function (response) {
            $("#transection-data").html(response)
    });
    });

</script>
@endpush