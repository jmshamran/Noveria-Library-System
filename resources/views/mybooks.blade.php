@extends('layout')
@section('content')
<br>
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>My Books</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="/">Home</a></li>
          <li class="breadcrumb-item active">My Books</li>
        </ol>
      </div>
    </div>
  </div>
  <!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Books reserved/taken by {{Auth::user()->name}}</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="booktable" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>No.</th>
                <th>Image</th>
                <th>Title</th>
                <th>Author</th>
                <th>ISBN</th>
                <th>Price</th>
                <th>Reserve Action</th>
              </tr>
            </thead>
            <tbody>
                {{-- {{dd($resbooks)}} --}}
              @foreach ($resbooks as $resbook)
              <tr>
                <td>{{$loop->iteration}}</td>
                <td><img style = "width:100px;"src="{{asset($resbook->image)}}"></td>
                <td><a href="{{route('bookpage',['id' => Crypt::encryptString($resbook->id)])}}">{{$resbook->title}}</a></td>
                <td>{{$resbook->author}}</td>
                <td>{{$resbook->isbn}}</td>
                <td>{{$resbook->price}}</td>
                @if ($resbook->res == 1)
                <td><a href="{{route('rescancel', ['id' => Crypt::encryptString($resbook->id)]) }}"><button class="btn btn-warning" id="rescan">Cancel Reserve</button></a></td>
                @else
                <th class="text-info">
                  Book already in your possession, 
                  <p>return to reserve another book
                </th>
                @endif
              </tr>
              @endforeach
            </tbody>
            <tfoot>
              <tr>
                <th>No.</th>
                <th>Image</th>
                <th>Title</th>
                <th>Author</th>
                <th>ISBN</th>
                <th>Price</th>
                <th>Reserve Action</th>
              </tr>
            </tfoot>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
      <div class="card callout callout-info">
        <div class="card-header">
          <h4 class="card-title ">Book Reserve Instructions</h4>
          @foreach ($settings as $setting)
          <ul>
            <li>
                <p class="text-info">Await Admin to authorize your reservation.</p>
            </li>
            <li>
              <p class="text-info">You can cancel your reservation here if you want to borrow another book.</p>
            </li>
            <li>
              <p class="text-info">You are allowed to borrow only <strong>{{$setting->books}}</strong> books.</p>
            </li>
            <li>
              <p class="text-info">Books are allowed to be borrowed for <strong>{{$setting->days}}</strong> days.</p>
            </li>
            <li>
              <p class="text-danger"><strong>Rs. {{$setting->bkamount}}/-</strong> fine for each passing day of non-return after the deadline.</p>
            </li>
          </ul>
          @endforeach
          <a href="{{route('books')}}"><button class="btn btn-info">Reserve Books</button></a>
        </div>
      </div>
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>
@endsection