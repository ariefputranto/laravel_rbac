@extends('layouts.app')
 
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <h1>Add New Assignment</h1>
      <hr>
      <form action="/assignment" method="post">
        {{ csrf_field() }}
        <div class="form-group">
          <label for="user_id">User</label>
          <select class="form-control" id="assignmentUserId" name="user_id">
            @foreach($users as $user)
              <option value="{{$user->id}}">{{$user->name}}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group">
          <label for="role">Role</label>
          <select class="form-control" id="assignmentRole" name="role_id">
            @foreach($roles as $role)
              <option value="{{$role->id}}">{{$role->name}}</option>
            @endforeach
          </select>
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
        <a href="{{ URL::to('assignment') }}" class="btn btn-success">Back</a>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </div>
</div>
@endsection