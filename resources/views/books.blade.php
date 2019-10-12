@extends('layout')
@section('content')
<br>
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Books</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active">Books</li>
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
            <h3 class="card-title">Choose Your Book</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="booktable" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>No.</th>
                <th>Image</th>
                <th>Title</th>
                <th>ISBN</th>
                <th>Genre</th>
                <th>Author</th>
                <th>Avilablity</th>
              </tr>
              </thead>
              <tbody>
              @foreach($books as $book)
              <tr>
              <td>{{$loop->iteration}}</td>
              <td><img style = "width:100px;"src="{{asset($book->image)}}"></td>
              <td><a href="{{route('bookpage',['id' => Crypt::encryptString($book->id)])}}">{{$book->title}}</a></td>
              <td>{{$book->isbn}}</td>
              <td>{{$book->genre_name}}</td>
              <td>{{$book->author}}</td>
              @if ($book->issued == '0')
              <th><a href="{{route('reserve', ['id' => Crypt::encryptString($book->id)]) }}"><button class="btn btn-success">Reserve Book</button></a></th>
              @else
                  <th class="text-danger"> Unavilable</th>
              @endif
              </tr>
              @endforeach
              </tbody>
              <tfoot>
              <tr>
                <th>No.</th>
                <th>Image</th>
                <th>Title</th>
                <th>ISBN</th>
                <th>Genre</th>
                <th>Author</th>
                <th>Avilablity</th>
              </tr>
              </tfoot>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
        <div class="card callout callout-info">
          <div class="card-header">
            <h4 class="card-title">Dind't find the book you need?</h4><br>
            <p>Request your favourite books! so we can add them to our colection and make everyone happy!</p>
            <button class="btn btn-info">Request Books</button>
            <a href="{{route('addbook')}}"><button class="btn btn-success ml-2">Add Books</button></a>
          </div>
        </div> 
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
@endsection