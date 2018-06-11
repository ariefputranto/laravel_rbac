@extends('layouts.app')
 
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <h1>Showing User {{ $user->name }}</h1>
      <a href="{{URL::to('user')}}" class="btn btn-success btn-add">Back</a>
      <div class="jumbotron text-center">
          <p>
              <strong>Name:</strong> {{ $user->name }}<br>
              <strong>Email:</strong> {{ $user->email }}<br>
          </p>
      </div>
    </div>
  </div>
</div>
@endsection