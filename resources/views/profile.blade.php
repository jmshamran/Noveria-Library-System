@extends('layout')
@section('content')
<br>
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Profile</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="/">Home</a></li>
          <li class="breadcrumb-item active">User Profile</li>
        </ol>
      </div>
    </div>
  </div>
  <!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-3">
        <!-- Profile Image -->
        <div class="card card-primary card-outline">
          <div class="card-body box-profile">
            <div class="text-center">
              <img class="profile-user-img img-fluid img-circle"
                src="{{asset(Auth::user()->image)}}"
                alt="User profile picture">
            </div>
            <h3 class="profile-username text-center">{{ Auth::user()->name }}</h3>
            <p class="text-muted text-center">{{ Auth::user()->job }}</p>
            {{-- <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> --}}
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
        <!-- About Me Box -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">About Me</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <strong><i class="fa fa-info-circle mr-1"></i> About</strong>
            <p class="text-muted">
              {{ Auth::user()->about}}
            </p>
            <hr>
            <strong><i class="fa fa-birthday-cake mr-1"></i> Date of Birth</strong>
            <p class="text-muted">{{ Auth::user()->dob }}</p>
            <hr>
            <strong><i class="fa fa-phone-square mr-1"></i> Phone</strong>
            <p class="text-muted">
              <span class="tag tag-danger">{{ Auth::user()->phone }}</span>
            </p>
            <hr>
            <strong><i class="fa fa-envelope mr-1"></i> Email</strong>
            <p class="text-muted">{{ Auth::user()->email }}</p>
            <hr>
            <strong><i class="fa fa-map-marker mr-1"></i> Location</strong>
            <p class="text-muted">{{ Auth::user()->address }}</p>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
      <div class="col-md-9">
        <div class="card">
          <div class="card-header p-2">
            <ul class="nav nav-pills">
              <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Activity</a></li>
              <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li>
              <li class="nav-item"><a class="nav-link" href="#mailpass" data-toggle="tab">Email & Password</a></li>
            </ul>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="tab-content">
              <div class="active tab-pane" id="activity">
                <!-- The timeline -->
                <ul class="timeline timeline-inverse">
                  <!-- timeline time label -->
                  <li class="time-label">
                    <span class="bg-success">
                      {{Auth::user()->created_at->toDateString()}}
                    </span>
                  </li>
                  <!-- /.timeline-label -->
                  <!-- timeline item -->
                  <li>
                    <i class="fa fa-birthday-cake bg-primary"></i>
                    
                    <div class="timeline-item">
                      <span class="time"><i class="fa fa-clock-o"></i>{{Auth::user()->created_at->toTimeString()}}</span>

                      <h3 class="timeline-header"><a href="#">{{Auth::user()->name}}</a> created this account</h3>
                    </div>
                  </li>
                  <!-- END timeline item -->
                  <!-- timeline item -->
                  @if ($condition_1 == 1)
                  <!-- timeline time label -->
                  <li class="time-label">
                    <span class="bg-info">
                      {{$res_1->reserve_time}}
                    </span>
                  </li>
                  <!-- /.timeline-label -->
                  <li>
                    <i class="fa fa-book bg-info"></i>

                    <div class="timeline-item">
                      <span class="time"><i class="fa fa-clock-o"></i>{{$res_1->reserve_time}}</span>

                      <h3 class="timeline-header no-border">You reserved<h3 class="timeline-header"><a href="#">{{$res_1->title}}</a></h3>
                    </div>
                  </li>
                  @endif
                  <!-- END timeline item -->
                  @if ($condition_2 == 1)
                  <!-- timeline time label -->
                  <li class="time-label">
                    <span class="bg-info">
                      {{$res_2->reserve_time}}
                    </span>
                  </li>
                  <!-- /.timeline-label -->
                  <li>
                    <i class="fa fa-book bg-info"></i>

                    <div class="timeline-item">
                      <span class="time"><i class="fa fa-clock-o"></i>{{$res_2->reserve_time}}</span>

                      <h3 class="timeline-header no-border">You reserved<h3 class="timeline-header"><a href="#">{{$res_2->title}}</a></h3>
                    </div>
                  </li>
                  @endif
                  <!-- END timeline item -->
                  <!-- timeline item -->
                  <li>
                    <i class="fa fa-comments bg-warning"></i>

                    <div class="timeline-item">
                      <span class="time"><i class="fa fa-clock-o"></i> 27 mins ago</span>

                      <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>

                      <div class="timeline-body">
                        Take me to your leader!
                        Switzerland is small and neutral!
                        We are more like Germany, ambitious and misunderstood!
                      </div>
                      <div class="timeline-footer">
                        <a href="#" class="btn btn-warning btn-flat btn-sm">View comment</a>
                      </div>
                    </div>
                  </li>
                  <!-- END timeline item -->
                  <!-- timeline time label -->
                  <li class="time-label">
                    <span class="bg-success">
                      3 Jan. 2014
                    </span>
                  </li>
                  <!-- /.timeline-label -->
                  <!-- timeline item -->
                  <li>
                    <i class="fa fa-camera bg-purple"></i>

                    <div class="timeline-item">
                      <span class="time"><i class="fa fa-clock-o"></i> 2 days ago</span>

                      <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>
                      <div class="timeline-body">
                        <img src="http://placehold.it/150x100" alt="..." class="margin">
                        <img src="http://placehold.it/150x100" alt="..." class="margin">
                        <img src="http://placehold.it/150x100" alt="..." class="margin">
                        <img src="http://placehold.it/150x100" alt="..." class="margin">
                      </div>
                    </div>
                  </li>
                  <!-- END timeline item -->
              </div>
              <div class="tab-pane" id="settings">
                <form class="form-horizontal" action="{{route('editprofile', ['id' => Crypt::encryptString(Auth::user()->id)])}}" id="userupdate" method="POST" enctype="multipart/form-data">
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
                      <input type="text" class="form-control" id="name" placeholder="Name" name="name">
                    </div>
                    {{-- @if ($errors->has('name'))
                    <div class="text-danger ml-2">
                      {{$errors->first('name')}}
                    </div>
                    @endif --}}
                  </div>
                  <div class="form-group">
                    <label for="address" class="col-sm-2 control-label">Address</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="address" placeholder="Address" name="address">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="phone" class="col-sm-2 control-label">Phone No.</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="phone" placeholder="Phone No." name="phone">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="profession" class="col-sm-2 control-label">Profession</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="profession" placeholder="Profession" name="job">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="dob" class="col-sm-2 control-label">Date of Birth</label>
                    <div class="col-sm-10">
                      <input type="date" class="form-control" id="dob" placeholder="Date of Birth" name="dob">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="image" class="col-sm-2 control-label">Your Photo</label>
                    <div class="col-sm-10">
                      <input type="file" class="form-control" name="image" ></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="aboutme" class="col-sm-2 control-label">About Me</label>
                    <div class="col-sm-10">
                      <textarea class="form-control" id="about" placeholder="About Me" name="about"></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-danger">Submit</button>
                    </div>
                  </div>
                </form>
              </div>
              <div class="tab-pane" id="mailpass">
                <div class="card card-danger">
                  <div class="card-header">
                    <h3 class="card-title">Change Email and Password</h3>
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                  <form role="form">
                    <div class="card-body">
                      <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" id="updatmail" placeholder="Enter E-Mail">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" id="updatepass" placeholder="Password">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                      </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary">Change E-mail and Password</button>
                    </div>
                  </form>
                </div>
                {{-- This place need to be filled --}}
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.nav-tabs-custom -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection