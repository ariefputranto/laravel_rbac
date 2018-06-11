@extends('layouts.app')
 
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <h1>Edit Permission</h1>
      <hr>
      <form action="{{url('permission', [$permission->id])}}" method="post">
        <input type="hidden" name="_method" value="PUT">
        {{ csrf_field() }}
        <div class="form-group">
          <label for="title">Name</label>
          <input type="text" value="{{$permission->name}}" class="form-control" id="permissionName"  name="name">
        </div>
        <div class="form-group">
          <label for="slug">Slug</label>
          <select class="form-control" id="permissionSlug" name="slug[]" multiple="multiple">
            @foreach($routes as $route)
              <option value="{{ $route }}" {{ in_array($route, $permission_route) ? "selected='selected'" : ''  }}>{{ $route }}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group">
          <label for="description">Description</label>
          <input type="text" value="{{$permission->description}}" class="form-control" id="permissionDescription" name="description">
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
        <a href="{{ URL::to('permission') }}" class="btn btn-warning">Back</a>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </div>
</div>
@endsection