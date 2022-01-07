@extends('layouts.app', ['page' => __('Funding Home'), 'pageSlug' => 'fundinghome'])

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
                                <h4 class="card-title">Funding / Receiving Management</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">

                         <div class="">
                            <table id="myTable" class="text-primary display table tablesorter">
                                <thead class="text-primary">
                                <tr><th scope="col">Username</th>
                                    <th scope="col">Password</th>
                                    <th scope="col">Webssh server adddress</th>
                                    <th scope="col">Instant Registration Fee</th>
                                    <th scope="col">Lightning boost fee</th>
                                    <!--<th scope="col">Node Id</th>-->
                                    <!--<th scope="col">Registration Fee</th>-->
                                    <th scope="col">Updated at</th>
                                    <th scope="col">action</th>
                                </tr></thead>
                                <tbody>
                                @foreach($data as $datum)
                                    <tr class="custom_color" >
                                        <td>{{$datum->username}}</td>
                                        <td>{{$datum->password}}</td>
                                        <td>{{$datum->ip}}</td>
                                        <td>{{$datum->merchant_boost_fee}}</td>
                                        <td>{{$datum->lightning_boost_fee}}</td>
                                        <!--<td>{{$datum->node_id}}</td>-->
                                        <!--<td>{{$datum->registration_fees}}</td>-->
                                        <td>{{\Carbon\Carbon::parse($datum->updated_at)->format('M-D-Y / H:I:S')}}</td>
                                        
                                        <!--<td>{{ $datum->created_at}}</td>-->
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    <a class="dropdown-item" href="{{route('editFunding',[$datum->id])}}">Edit</a>
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
    <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Details</h4>
          </div>
          <div class="modal-body">
            <!--<p>Some text in the modal.</p>-->
            <div class="modal_image">
                <img src="http://c-lightning.stepinnsolution.com/black/img/anime3.png" alt="" class="img-fluid w-100">
            </div>
          </div>
          <!--<div class="modal-footer">-->
          <!--  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
          <!--</div>-->
        </div>

      </div>
    </div>
@endsection
