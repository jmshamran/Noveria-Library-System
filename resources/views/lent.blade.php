@extends('layout')
@section('content')
<br>
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Lent Books</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active">Lent</li>
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
            <h3 class="card-title">Books lent to the users</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="booktable" class="table table-bordered table-striped">
              <thead>
              <tr>
                  <th>No.</th>
                  <th>Lend ID</th>
                  <th>Book ID</th>
                  <th>Image</th>
                  <th>User ID</th>
                  <th>User Name</th>
                  <th>Title</th>
                  <th>Phone No.</th>
                  <th>Lent Date</th>
                  <th>Lent Action</th>
              </tr>
              </thead>
              <tbody>
              @foreach ($lentbooks as $lent)
                  <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$lent->reserve_books_id}}</td>
                    <td>{{$lent->book_id}}</td>
                    <td><img style = "width:100px;"src="{{asset($lent->image)}}"></td>
                    <td>{{$lent->user_id}}</td>
                    <td><a href="{{route('userpage',['id' => Crypt::encryptString($lent->user_id)])}}">{{$lent->name}}</a></td>
                    <td><a href="{{route('bookpage',['id' => Crypt::encryptString($lent->book_id)])}}">{{$lent->title}}</a></td>
                    <td>{{$lent->phone}}</td>
                    <td>{{$lent->creation}}</td>
                    {{-- <td>{{$lent->email}}</td> --}}
                    <td><a href="{{route('recieve', ['id' => Crypt::encryptString($lent->reserve_books_id)]) }}"><button class="btn btn-success" id="recieve">Recieve Book</button></a></td>
                  </tr>
              @endforeach
              </tbody>
              <tfoot>
                  <tr>
                      <th>No.</th>
                      <th>Lend ID</th>
                      <th>Book ID</th>
                      <th>Image</th>
                      <th>User ID</th>
                      <th>User Name</th>
                      <th>Title</th>
                      <th>Phone No.</th>
                      <th>Lent Date</th>
                      <th>Lent Action</th>
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