@extends('layout')
@section('content')
<br>
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Fines</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active">Fines</li>
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
            <h3 class="card-title">Fines recivables from users</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="booktable" class="table table-bordered table-striped">
              <thead>
              <tr>
                  <th>No.</th>
                  <th>User ID</th>
                  <th>Name</th>
                  <th>Phone No.</th>
                  <th>Book ID</th>
                  <th>Book Title</th>
                  <th>Borrowed Date</th>
                  <th>Returned Date</th>
                  <th>Fine Amount</th>
                  <th>Fine Action</th>
              </tr>
              </thead>
              <tbody>
                @foreach ($fines as $fine)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$fine->user_id}}</td>
                    <td>{{$fine->name}}</td>
                    <td>{{$fine->phone}}</td>
                    <td>{{$fine->book_id}}</td>
                    <td>{{$fine->title}}</td>
                    <td>{{$fine->creation}}</td>
                    <td>{{$fine->returned}}</td>
                    <td>Rs.{{$fine->fine}}/-</td>
                    <td><a href="{{route('collect', ['id' => Crypt::encryptString($fine->reserve_books_id)])}}">
                        <button class="btn btn-info" id="collect">Collect</button></a></td>
                </tr>
                @endforeach
              </tbody>
              <tfoot>
                <tr>
                  <th>No.</th>
                  <th>User ID</th>
                  <th>Name</th>
                  <th>Phone No.</th>
                  <th>Book ID</th>
                  <th>Book Title</th>
                  <th>Borrowed Date</th>
                  <th>Returned Date</th>
                  <th>Fine Amount</th>
                  <th>Fine Action</th>
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