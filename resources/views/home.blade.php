@extends('layout')
@section('content')
<br>
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Dashboard</div>
        <div class="card-body">
          @if (session('status'))
          <div class="alert alert-success" role="alert">
            {{session('status')}}
          </div>
          @endif
          You are succesfully logged in! You can view your <a href="{{route('profile')}}">profile</a> or <a href="{{route('books')}}">books.</a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection