@extends('layouts.app')
 
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <h1>Edit Assignment</h1>
      <hr>
      <form action="{{url('assignment', [$assignment->id])}}" method="post">
        <input type="hidden" name="_method" value="PUT">
        {{ csrf_field() }}
        <div class="form-group">
          <label for="user_id">User</label>
          <select class="form-control" id="assignmentUserId" name="user_id">
            @foreach($users as $user)
              @if($user->id == $assignment->User->id)
                <option value="{{$user->id}}" selected="selected">{{$user->name}}</option>
              @else
                <option value="{{$user->id}}">{{$user->name}}</option>
              @endif
            @endforeach
          </select>
        </div>
        <div class="form-group">
          <label for="role">Role</label>
          <select class="form-control" id="assignmentRole" name="role_id">
            @foreach($roles as $role)
              @if($role->id == $assignment->Role->id)
                <option value="{{$role->id}}" selected="selected">{{$role->name}}</option>
              @else
                <option value="{{$role->id}}">{{$role->name}}</option>
              @endif
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