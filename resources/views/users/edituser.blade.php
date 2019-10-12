@extends('layout')
@section('content')
<br>
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Edit Users</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="/">Home</a></li>
          <li class="breadcrumb-item"><a href="{{route('users')}}">Users</a></li>
          <li class="breadcrumb-item active">Edit Users</li>
        </ol>
      </div>
    </div>
  </div>
  <!-- /.container-fluid -->
  <div class="container-fluid">
    <div class="tab-pane">
      <div class="callout callout-info">
        <h5><i class="fa fa-info mr-2"></i> Edit user note:</h5>
        <label class="text-primary">Please enter the correct details of the user.</label>
        <div>
          <span class="text-danger">Exisiting Records of the user :-</span>
          <ul>
            <li>Name: <span class="ml-3">{{$edituser->name}}</span></li>
            <li>Address: <span class="ml-3">{{$edituser->address}}</span></li>
            <li>Phone: <span class="ml-3">{{$edituser->phone}}</span></li>
            <li>Profession: <span class="ml-3">{{$edituser->job}}</span></li>
            <li>Date of Birth: <span class="ml-3">{{$edituser->dob}}</span></li>
            <li>About: <span class="ml-3">{{$edituser->about}}</span></li>
          </ul>
        </div>
      </div>
      <form class="form-horizontal" action="{{route('userupdate', ['id' => Crypt::encryptString($edituser->id)])}}" method="POST" enctype="multipart/form-data">
        <input type="hidden" name = "_token" value="{{csrf_token()}}">
        @if(count($errors) > 0)
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
          </ul>
        </div>
        @endif
        <div class="form-group">
          <label for="name" class="col-sm-2 control-label">Name</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="name" placeholder="Name">
          </div>
        </div>
        <div class="form-group">
          <label for="address" class="col-sm-2 control-label">Address</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="address" placeholder="Address">
          </div>
        </div>
        <div class="form-group">
          <label for="phone" class="col-sm-2 control-label">Phone No.</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="phone" placeholder="Phone No.">
          </div>
        </div>
        <div class="form-group">
          <label for="job" class="col-sm-2 control-label">Profession</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="job" placeholder="Job.">
          </div>
        </div>
        <div class="form-group">
          <label for="dob" class="col-sm-2 control-label">Date of Birth</label>
          <div class="col-sm-10">
            <input type="date" class="form-control" name="dob" ></textarea>
          </div>
        </div>
        <div class="form-group">
            <label for="about" class="col-sm-2 control-label">About</label>
            <div class="col-sm-10">
              <textarea class="form-control" id="about" placeholder="About" name="about"></textarea>
            </div>
          </div>
        <div class="form-group">
          <label for="image" class="col-sm-2 control-label">Upload Image</label>
          <div class="col-sm-10">
            <input type="file" class="form-control" name="image" ></textarea>
          </div>
        </div>
        <br>
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-danger">Update Records</button>
          </div>
        </div>
      </form>
    </div>
    <!-- /.tab-pane -->
  </div>
</section>
@endsection