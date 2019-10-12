@extends('layout')
@section('content')
<br>
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Add Books</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="/">Home</a></li>
          <li class="breadcrumb-item"><a href="{{route('books')}}">Books</a></li>
          <li class="breadcrumb-item active">Add Books</li>
        </ol>
      </div>
    </div>
  </div>
  <!-- /.container-fluid -->
  <div class="container-fluid">
    <div class="tab-pane">
      <div class="callout callout-info">
        <h5><i class="fa fa-info mr-2"></i> Add book note:</h5>
        Please enter the correct details of the books.
      </div>
      <form class="form-horizontal" action="{{route('store')}}" method="POST" enctype="multipart/form-data">
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
          <label for="title" class="col-sm-2 control-label">Title</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="title" placeholder="Title">
          </div>
        </div>
        <div class="form-group">
          <label for="isbn" class="col-sm-2 control-label">ISBN</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="isbn" placeholder="ISBN">
          </div>
        </div>
        <div class="form-group">
          <label for="author" class="col-sm-2 control-label">Author</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="author" placeholder="Author">
          </div>
        </div>
        <div class="form-group">
          <label for="phone" class="col-sm-2 control-label">Language</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="language" placeholder="Language.">
          </div>
        </div>
        <div class="form-group">
          <label for="publisher" class="col-sm-2 control-label">Publisher</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="publisher" placeholder="Publisher">
          </div>
        </div>
        <div class="form-group">
          <label for="dob" class="col-sm-2 control-label">Genre</label>
          <div class="col-sm-10">
            <select class="custom-select" name="genre">
              <option selected>Select Genre...</option>
              @foreach ($genres as $genre)
                <option value="{{$genre->id}}">{{$genre->genre}}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="form-group">
          <label for="publisher" class="col-sm-2 control-label">Price</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="price" placeholder="Price">
          </div>
        </div>
        <div class="form-group">
          <label for="aboutme" class="col-sm-2 control-label">Release Date</label>
          <div class="col-sm-10">
            <input type="date" class="form-control" name="reldate" ></textarea>
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
            <button type="submit" class="btn btn-danger">Add Book to Database</button>
          </div>
        </div>
      </form>
    </div>
    <!-- /.tab-pane -->
  </div>
</section>
@endsection