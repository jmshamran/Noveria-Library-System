@extends('layout')
@section('content')
<br>
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>{{$users->name}}</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="/">Home</a></li>
          <li class="breadcrumb-item"><a href="{{route('users')}}">Users</a></li>
          <li class="breadcrumb-item active">User Overview</li>
        </ol>
      </div>
    </div>
  </div>
  <!-- /.container-fluid -->
</section>
<div class="row ml-2">
<div class="col-md-6">
  <!-- Box Comment -->
  <div class="card card-widget">
    <div class="card-header">
      <div class="user-block">
        <img class="img-circle" src="{{asset('asset/dist/img/book2.png')}}" alt="User Image">
        <span class="username">{{$users->name}}</a></span>
        <span class="description">Position - 
        @if ($users->position == 1)
        Admin
        @else
        User
        @endif
        </span>
      </div>
      <!-- /.user-block -->
      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-minus"></i>
        </button>
      </div>
      <!-- /.card-tools -->
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <img class="img-fluid pad" src="{{asset($users->image)}}" alt="Photo">
    </div>
    <!-- /.card-body -->
    <!-- /.card-footer -->
    <!-- /.card-footer -->
  </div>
  <!-- /.card -->
</div>
<!-- /.col -->
<div class="col-md-6">
  <!-- Box Comment -->
  <div class="card card-widget">
    <div class="card-header">
      <div class="user-block">
        <img class="img-circle" src="{{asset('asset/dist/img/description.png')}}" alt="User Image">
        <span class="username">Overview</span>
        <span class="description">Registered on - {{$users->created_at}}</span>
      </div>
      <!-- /.user-block -->
      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-widget="collapse">
          <i class="fa fa-minus"></i>
      </div>
      <!-- /.card-tools -->
    </div>
    <!-- /.card-header -->
    <div class="card-body">
    {{-- <label for="id">ID :</label><span class="ml-3">{{$users->id}}</span><br><br> --}}
    <label for="name">Name :</label><span class="ml-3">{{$users->name}}</span><br><br>
    <label for="dob">Date of Birth :</label><span class="ml-3">{{$users->dob}}</span><br><br>
    <label for="phone">Phone No. :</label><span class="ml-3">{{$users->phone}}</span><br><br>
    <label for="email">E-Mail :</label><span class="ml-3">{{$users->email}}</span><br><br>
    <label for="address">Address :</label><span class="ml-3">{{$users->address}}</span><br><br>
    <label for="job">Profession :</label><span class="ml-3">{{$users->job}}</span><br><br>
    <label for="position">Position :</label><span class="ml-3">
    @if ($users->position == 1)
    Super Admin
    @elseif($users->position == 2)
    Admin
    @else
    User
    @endif</span><br><br>
    <label for="description">About :</label>
    <p>{{$users->about}}</p><br>
    @if ((Auth::user()->position == 1 OR Auth::user()->position == 2) &&  $users->position != 1 )
      <a href="{{route('edituser', ['id' => Crypt::encryptString($users->id)])}}"><button class="btn btn-primary ml-2">Edit User</button></a>
    @endif
    @if ((Auth::user()->position == 1 OR Auth::user()->position == 2) && $users->position == 0)
      <a href="{{route('promote', ['id' => Crypt::encryptString($users->id)])}}"><button class="btn btn-warning ml-2 promote">Promote User</button></a>
    @endif
    @if ((Auth::user()->position == 1 OR Auth::user()->position == 2) &&  $users->position != 1)
      <a href="{{route('deleteuser', ['id' => Crypt::encryptString($users->id)])}}"><button class="btn btn-danger ml-2 userdelete">Delete User</button></a>
    @endif
  </div>
    <!-- /.card -->
  </div>
  <!-- /.col -->
</div>
<!-- /.row -->
</div>
@endsection