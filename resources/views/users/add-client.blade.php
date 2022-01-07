
    @extends('layouts.app')

@section('content')


    <div class="set_form">
        <div class="card">
            <div class="card-header">
                <h5 class="title">Edit Profile</h5>
            </div>
            <form method="post" action="{{route('addMerchant')}}" autocomplete="off" enctype="multipart/form-data">
                <div class="card-body">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Name</label>
                            <input type="text" name="name" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">client id</label>
                            <input type="text" name="client_id" class="form-control"   >
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">address</label>
                            <input type="text" name="address" class="form-control" >
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Email</label>
                            <input type="text" name="email" class="form-control"  >
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Maxboost Limit</label>
                            <input type="number" min="1" name="maxboost_limit" class="form-control"  >
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Date of Birth</label>
                            <input type="date" name="dob" class="form-control" >
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="btn btn-outline-neutral">client image id
                            <input type="file" name="client_image_id" >
                            </label>
                        </div>
                    </div>
                </div>
                <div class="card-footer pull-right">
                    <button type="submit" class="btn btn-fill btn-primary">save</button>
                </div>
            </form>
        </div>
    </div>

@endsection

