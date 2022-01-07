@extends('layouts.app')

@section('content')


    <div class="set_form">
        <div class="card">

            <div class="card-header">
                <h5 class="title">Funding Edit</h5>
            </div>
            @if(Session::has('message'))
                <p class="alert alert-success">{{ Session::get('message') }}</p>
            @endif
            <form method="post" action="{{route('updateFunding',[$data->id])}}" autocomplete="off">
                <div class="card-body">
                    
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="username">username</label>
                            <input type="text" name="username" value="{{$data->username}}" class="form-control" id="username" placeholder="username">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">password</label>
                            <input type="text" name="password" value="{{$data->password}}" class="form-control" id="password">
                        </div>
                    </div>
                    <div class="form-row">
                        <!--<div class="form-group col-md-6">-->
                        <!--    <label for="inputEmail4">merchant_boost_fee</label>-->
                        <!--    <input type="text" name="merchant_boost_fee" value="{{$data->merchant_boost_fee}}" class="form-control" id="merchant_boost_fee" placeholder="Email">-->
                        <!--</div>-->
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">lightning_boost_fee</label>
                            <input type="text" name="lightning_boost_fee" value="{{$data->lightning_boost_fee}}" class="form-control" id="lightning_boost_fee">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="ip">Webssh Server Address</label>
                            <input type="text" name="ip" value="{{$data->ip}}" class="form-control" id="inputEmail4" placeholder="ip">
                        </div>
                      	<div class="form-group col-md-6">
                            <label for="port">Port</label>
                            <input type="text" name="port" value="{{$data->port}}" class="form-control" id="port" placeholder="Port">
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="port">Node Id</label>
                            <input type="text" name="node_id" value="{{$data->node_id}}" class="form-control" id="port">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="port">Instant Registration Fees</label>
                            <input type="text" name="registration_fees" value="{{$data->registration_fees}}" class="form-control" id="port">
                        </div>
                    </div>
                  	
                  	<div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="port">Cronjob: SSH_Username:port</label>
                            <input type="text" name="ssh_username" value="{{$data->ssh_username}}" class="form-control" id="port">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="port">SSH Password</label>
                            <input type="text" name="ssh_password" value="{{$data->ssh_password}}" class="form-control" id="port">
                        </div>
                    </div>
                    
                    
                    {{-- <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="port">Company Email</label>
                            <input type="text" name="company_email" value="{{$data->company_email}}" class="form-control" id="port">
                        </div>
                        
                    </div> --}}
                    
                    
                </div>
                <div class="card-footer pull-right">
                    <button type="submit" class="btn btn-fill btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection