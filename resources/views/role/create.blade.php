@extends('layouts.app')
 
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <h1>Add New Role</h1>
      <hr>
      <form action="/role" method="post">
        {{ csrf_field() }}
        <div class="form-group">
          <label for="title">Name</label>
          <input type="text" class="form-control" id="roleName"  name="name">
        </div>
        <div class="form-group">
          <label for="permission">Permission</label>
          <select class="form-control" id="rolePermission" name="permission[]" multiple="multiple">
            @foreach($permissions as $permission)
              <option value="{{$permission->id}}">{{$permission->name}}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group">
          <label for="description">Description</label>
          <input type="text" class="form-control" id="roleDescription" name="description">
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
        <a href="{{ URL::to('role') }}" class="btn btn-success">Back</a>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </div>
</div>
@endsection