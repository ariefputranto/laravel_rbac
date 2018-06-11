@extends('layouts.app')
 
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <h1>Edit User</h1>
      <hr>
      <form action="{{url('user', [$user->id])}}" method="post">
        <input type="hidden" name="_method" value="PUT">
        {{ csrf_field() }}
        <div class="form-group">
          <label for="name">Name</label>
          <input type="text" value="{{$user->name}}" class="form-control" id="userName"  name="name">
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" value="{{$user->email}}" class="form-control" id="userEmail" name="email">
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" class="form-control" id="userPassword" name="password">
        </div>
        @if ($errors->any())
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
        @endif
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </div>
</div>
@endsection