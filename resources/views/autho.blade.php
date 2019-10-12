@extends('layout')
@section('content')
<br>
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Authorize Books</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active">Authorize</li>
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
            <h3 class="card-title">Books reserved by users</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="booktable" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>No.</th>
                <th>Reserve ID</th>
                <th>Book ID</th>
                <th>Image</th>
                <th>User ID</th>
                <th>User Name</th>
                <th>Title</th>
                <th>Phone No.</th>
                <th>Reserved Date</th>
                <th>Reserve Action</th>
              </tr>
              </thead>
              <tbody>
                @foreach ($authobooks as $autho)
                    <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$autho->reserve_books_id}}</td>
                      <td>{{$autho->book_id}}</td>
                      <td><img style = "width:100px;"src="{{asset($autho->image)}}"></td>
                      <td>{{$autho->user_id}}</td>
                      <td><a href="{{route('userpage',['id' => Crypt::encryptString($autho->user_id)])}}">{{$autho->name}}</a></td>
                      <td><a href="{{route('bookpage',['id' => Crypt::encryptString($autho->book_id)])}}">{{$autho->title}}</a></td>
                      <td>{{$autho->phone}}</td>
                      <td>{{$autho->creation}}</td>
                      <td><div class="btn-group-vertical">
                          <a href="{{route('accept', ['id' => Crypt::encryptString($autho->reserve_books_id)]) }}"><button class="btn btn-success" id="accept">Authorize Book</button></a>
                          <a href="{{route('decline', ['id' => Crypt::encryptString($autho->book_id)]) }}"><button class="btn btn-danger" id="decline">Decline Book</button></a>
                        </div></td>
                    </tr>
                @endforeach
              </tbody>
              <tfoot>
                <tr>
                  <th>No.</th>
                  <th>Reserve ID</th>
                  <th>Book ID</th>
                  <th>Image</th>
                  <th>User ID</th>
                  <th>User Name</th>
                  <th>Title</th>
                  <th>Phone No.</th>
                  <th>Reserved Date</th>
                  <th>Reserve Action</th>
                </tr>
              </tfoot>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>    
@endsection