@extends('layout')
@section('content')
<br>
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Users</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active">Users</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">All registered users of NLS</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="booktable" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>No.</th>
                <th>User ID</th>
                <th>Name</th>
                <th>Sex</th>
                <th>Registered date</th>
                <th>E-Mail</th>
                <th>Phone No.</th>
              </tr>
              </thead>
              <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$user->id}}</td>
                    <td><a href="{{route('userpage',['id' => Crypt::encryptString($user->id)])}}">{{$user->name}}</a></td>
                    <td>{{$user->sex}}</td>
                    <td>{{$user->created_at}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->phone}}</td>
                </tr>
                @endforeach
              </tbody>
              <tfoot>
                <tr>
                <th>No.</th>
                <th>User ID</th>
                <th>Name</th>
                <th>Sex</th>
                <th>Registered date</th>
                <th>E-Mail</th>
                <th>Phone No.</th>
                </tr>
              </tfoot>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
        <div class="card callout callout-info">
          <div class="card-header">
            <h4 class="card-title">Admin only</h4><br>
            <button class="btn btn-primary">Add Users</button>
            <button class="btn btn-warning">Edit Users</button>
            <button class="btn btn-danger">Delete Users</button>
          </div>
        </div> 
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
@endsection