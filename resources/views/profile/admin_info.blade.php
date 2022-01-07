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
         margin-right: 282px;
}
</style>
    <div class="content">
    <div class="row">
        @if(Session::has('message'))
            <p class="alert alert-success">{{ Session::get('message') }}</p>
        @endif
        <div class="col-md-12">
            <div style="float: right;">
                <a href="{{route('password-change')}}" class="btn btn-primary">Change Password</a>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card ">
             <div class="card-header">
                <div class="row">
                <div class="col-2">
                    <h4 class="card-title" style="width:200px !important;">Global Admin Settings</h4>
                </div>
                <div  class="col-3"> </div>
                </div>
                <div  class="col-2"> </div>

                </div>
            
            <div class="card-body">

            <div class="" id="transection-data">
            <table  class="text-primary display table tablesorter">
                <thead class="text-primary">
                <tr>
                    <th scope="col">Email Address</th>
                    <th scope="col">Function</th>
                    <th scope="col">Action</th>
                   
                </tr></thead>
                    <tbody>
                    @for($i=0; $i<=3; $i++)
                        <tr class="custom_color" >
                            <td>{{$data[$i]->admin_email}}</td>
                             <td>{{$data[$i]->type}}</td>
                             <td><button type="button" class="btn btn-sm" data-toggle="modal" data-target="#myBtn{{$data[$i]->id}}"><i class="tim-icons icon-pencil"></button></td>
                        </tr>
                         <div class="modal fade in" id="myBtn{{$data[$i]->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                         <div class="modal-dialog" role="document">
                         <form method="POST" action="{{ route('updateAdminEmail') }}">
                               @csrf
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">{{$data[$i]->type}}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                <div class="modal-body">
                                  <div>
                                    <label class="" style="color: black;">Value:</label>
                                    <input type="text" hidden="" value="{{$data[$i]->id}}" name="id"></input>
                                    <input <?php if($data[$i]->id <7 ) { ?> type="text" <?php }  ?>  name="admin_email" value="{{$data[$i]->admin_email}}" class="form-control"  style="color: black;"/>
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button type="submit" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Update</button>
                              </div>
                            </div>
                            </form>
                          </div>
                        </div>

                    @endfor
                    </tbody>
                </table>
             </div>
            </div>
            
        </div>
    </div>

    <div class="col-md-12">
            <div class="card ">
             <div class="card-header">
                <div class="row">
                <div class="col-2">
                    <h4 class="card-title" style="width:200px !important;">App Session Limits</h4>
                </div>
                <div  class="col-3"> </div>
                </div>
                <div  class="col-2"> </div>

                </div>
            
            <div class="card-body">

            <div class="" id="transection-data">
            <table  class="text-primary display table tablesorter">
                <thead class="text-primary">
                <tr>
                    <th scope="col">Limit (in seconds)</th>
                    <th scope="col">App Type</th>
                    <th scope="col">Action</th>
                   
                </tr></thead>
                    <tbody>
                    @for($i=4; $i<=5; $i++)
                        <tr class="custom_color" >
                            <td>{{$data[$i]->admin_email}}</td>
                             <td>{{$data[$i]->type}}</td>
                             <td><button type="button" class="btn btn-sm" data-toggle="modal" data-target="#myBtn{{$data[$i]->id}}"><i class="tim-icons icon-pencil"></button></td>
                        </tr>
                         <div class="modal fade in" id="myBtn{{$data[$i]->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                         <div class="modal-dialog" role="document">
                         <form method="POST" action="{{ route('updateAdminEmail') }}">
                               @csrf
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">{{$data[$i]->type}}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                <div class="modal-body">
                                  <div>
                                    <label class="" style="color: black;">Value:</label>
                                    <input type="text" hidden="" value="{{$data[$i]->id}}" name="id"></input>
                                    <input <?php if($data[$i]->id <7 ) { ?> type="text" <?php }  ?>  name="admin_email" value="{{$data[$i]->admin_email}}" class="form-control"  style="color: black;"/>
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button type="submit" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Update</button>
                              </div>
                            </div>
                            </form>
                          </div>
                        </div>

                    @endfor
                    </tbody>
                </table>
             </div>
            </div>
            
        </div>
    </div>
</div>
</div>
    

 

@endsection

            

