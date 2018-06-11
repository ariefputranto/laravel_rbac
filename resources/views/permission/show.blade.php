@extends('layouts.app')
 
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <h1>Showing permission {{ $permission->name }}</h1>
      <a href="{{URL::to('permission')}}" class="btn btn-success btn-add">Back</a>
      <div class="jumbotron text-center">
          <p>
              <strong>Name:</strong> {{ $permission->name }}<br>
              <strong>Description:</strong> {{ $permission->description }}<br>
              <strong>Slug:</strong> <br>
          </p>
          <div class="row">
            <div class="col-md-6 offset-md-3">
              <ul class="list-group">
                @foreach($permission->PermissionDetail as $detail)
                <li class="list-group-item">{{ $detail->slug }}</li>
                @endforeach
              </ul>
            </div>
          </div>
      </div>
    </div>
  </div>
</div>
@endsection