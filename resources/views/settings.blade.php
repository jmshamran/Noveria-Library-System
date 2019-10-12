@extends('layout')
@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Settings</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="/">Home</a></li>
          <li class="breadcrumb-item active">Settings</li>
        </ol>
      </div>
    </div>
  </div>
  <!-- /.container-fluid -->
</section>
<section class="content-header">
  <div class="container-fluid">
    <div class="row ml-2">
    <div class="col-md-7">
      @if (Auth::user()->position == 1)
      <div class="card bg-warning-gradient">
          <div class="card-header">
            <h3 class="card-title">Super Admin Settings</h3>
            <!-- /.card-tools -->
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <form action="{{route('apply')}}" method="get">
              <div class="form-group">
                <label for="books">
                Number of books allowed to be lent for a users:
                </label>
                <input type="number" class="form-control" name="books" id="numofbooks">
                <label for="days">
                Number of days allowed to lend:
                </label>
                <input type="number" class="form-control" name="days" id="numofdays">
                <label for="money">
                Amount of money for lend delay per day:
                </label>
                <input type="number" class="form-control" name="amount" id="amount"> <br>
                <input type="submit" value="Save Settings" class="btn btn-info">
              </div>
            </form>
          </div>
          <!-- /.card-body -->
        </div> 
      @endif
      @if (Auth::user()->position == 2 OR Auth::user()->position == 0)
      <div class="card bg-danger-gradient">
          <div class="card-header">
            <h5 class="card-title">Delete Account!</h5>
            <!-- /.card-tools -->
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            Do you want to permentanly delete your account? Your data and settings will be permentanly deleted.<br><br>
            <a href="{{route('deleteuser', ['id' => Crypt::encryptString(Auth::user()->id)])}}"><button class="btn btn-warning userdelete">Delete Account</button></a>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      @endif
    </div>
    <div class="col-md-5">
      @if (Auth::user()->position == 1)
      <div class="card bg-primary-gradient">
          <div class="card-header">
            <h3 class="card-title">Add Book Genre</h3>
            <!-- /.card-tools -->
          </div>
          <!-- /.card-header -->
          <div class="card-body">
              <form action="{{route('addBookGenre')}}" method="POST">
                <input type="hidden" name = "_token" value="{{csrf_token()}}">
                <div class="form-group">
                  <label for="genre">
                  Add a new name of Genre for the classification of books:
                  </label>
                  <input type="text" class="form-control" name="genre" id="addgenre"><br>
                  <input type="submit" value="Add Genre" class="btn btn-success">
                </div>
              </form>
            </div>
        </div>
        <div class="card bg-info-gradient">
            <div class="card-header">
              <h3 class="card-title">Remove Book Genre</h3>
              <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form action="{{route('removeBookGenre')}}" method="POST">
                    <input type="hidden" name = "_token" value="{{csrf_token()}}">
                  <div class="form-group">
                    <label for="books">
                    Remove an exisiting genre:
                    </label>
                    <div>
                        <select class="custom-select" name="genre">
                          <option selected>Select Genre...</option>
                          @foreach ($genres as $genre)
                          <option value="{{$genre->id}}">{{$genre->genre}}</option>
                          @endforeach
                        </select>
                      </div><br>
                    <input type="submit" value="Remove Genre" class="btn btn-danger">
                  </div>
                </form>
              </div>
          </div>
      @endif
        
    </div>
    <!-- /.col -->
  </div>
</div>
</section>
@endsection