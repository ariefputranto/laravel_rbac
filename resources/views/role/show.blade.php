@extends('layouts.app')
 
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <h1>Showing Role {{ $role->name }}</h1>
      <a href="{{URL::to('role')}}" class="btn btn-success btn-add">Back</a>
      <div class="jumbotron text-center">
          <p>
              <strong>Name:</strong> {{ $role->name }}<br>
              <strong>Description:</strong> {{ $role->description }}<br>
              <strong>Permission:</strong> <br>
          </p>
          <div class="row">
            <div class="col-md-6 offset-md-3">
              <ul class="list-group">
                @foreach($role->Permission as $permission)
                <li class="list-group-item">{{ $permission->name }}</li>
                @endforeach
              </ul>
            </div>
          </div>
      </div>
    </div>
  </div>
</div>
@endsection