@extends('layouts.app')
 
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <h1>Add New Permission</h1>
      <hr>
      <form action="/permission" method="post">
        {{ csrf_field() }}
        <div class="form-group">
          <label for="name">Name</label>
          <input type="text" class="form-control" id="permissionName"  name="name">
        </div>
        <div class="form-group">
          <label for="slug">Slug</label>
          <select class="form-control" id="permissionSlug" name="slug[]" multiple="multiple">
            @foreach($routes as $route)
              <option value="{{ $route }}">{{ $route }}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group">
          <label for="description">Description</label>
          <input type="text" class="form-control" id="permissionDescription" name="description">
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