@extends('layouts.app')
 
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <h1>Showing Assignment: {{ $assignment->User->name }}</h1>
      <a href="{{URL::to('assignment')}}" class="btn btn-success btn-add">Back</a>
      <div class="jumbotron text-center">
          <p>
              <strong>User:</strong> {{ $assignment->User->name }}<br>
              <strong>Role:</strong> {{ $assignment->Role->name }}<br>
          </p>
      </div>
    </div>
  </div>
</div>
@endsection