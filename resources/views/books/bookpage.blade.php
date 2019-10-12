@extends('layout')
@section('content')
<br>
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>{{$books->title}}</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item"><a href="{{route('books')}}">Books</a></li>
            <li class="breadcrumb-item active">Book Overview</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <div class="row ml-2">
    <div class="col-md-6">
      <!-- Box Comment -->
      <div class="card card-widget">
        <div class="card-header">
          <div class="user-block">
            <img class="img-circle" src="{{asset('asset/dist/img/book2.png')}}" alt="User Image">
            <span class="username">{{$books->title}}</a></span>
            <span class="description">Published on - {{$books->reldate}}</span>
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
            <img class="img-fluid pad" src="{{asset($books->image)}}" alt="Photo">
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
            <span class="description">Created on - {{$books->created_at}}</span>
          </div>
          <!-- /.user-block -->
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </div>
          <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          @if (Auth::user()->position == 1 OR Auth::user()->position == 2)
          <label for="id">Book ID :</label><span class="ml-3">{{$books->id}}</span><br><br>
          @endif
            <label for="title">Title :</label><span class="ml-3">{{$books->title}}</span><br><br>
            <label for="isbn">ISBN :</label><span class="ml-3">{{$books->isbn}}</span><br><br>
            <label for="author">Aurthor :</label><span class="ml-3">{{$books->author}}</span><br><br>
            <label for="language">Language :</label><span class="ml-3">{{$books->language}}</span><br><br>
            <label for="publisher">Publisher :</label><span class="ml-3">{{$books->publisher}}</span><br><br>
            <label for="genre">Genre :</label><span class="ml-3">{{$books->genre_name}}</span><br><br>
            <label for="price">Price :</label><span class="ml-3">{{$books->price}}</span><br><br>
            <label for="available">Available :</label>
            @if ($books->issued == 1)
                <span class="ml-4 text-danger">Unavialable</span><br><br>
            @else
                <span class="ml-4">Yes</span><br><br>
            @endif
            <label for="description">Description :</label>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, 
                        sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                        Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut 
                        aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in 
                        voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint 
                        occaecat cupidatat non proidenad minim veniam, quis nostrud exercitation ullamco laboris nisi ut 
                        aliquip ex ea commodo consequat.</p><br>
            @if ($books->issued == 1)
              <button class="btn btn-success" disabled="disabled">Reserve Book</button>
            @else
              <a href="{{route('reserve', ['id' => Crypt::encryptString($books->id)])}}"><button class="btn btn-success">Reserve Book</button></a></th>
            @endif
            @if (Auth::user()->position == 1 OR Auth::user()->position == 2)
              <a href="{{route('editbook', ['id' => Crypt::encryptString($books->id)])}}"><button class="btn btn-warning ml-2">Edit Book</button></a>
              <a href="{{route('deletebook', ['id' => Crypt::encryptString($books->id)])}}"><button class="btn btn-danger ml-2">Delete Book</button></a>
            @endif           
            
      </div>
      <!-- /.card -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</div>
@endsection