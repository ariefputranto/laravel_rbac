@extends('layouts.app')
 
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <h1>Add New Menu</h1>
      <hr>
      <form action="/menu" method="post">
        {{ csrf_field() }}
        <div class="form-group">
          <label for="title">Name</label>
          <input type="text" class="form-control" id="menuName"  name="name">
        </div>
        <div class="form-group">
          <label for="slug">Slug</label>
          <select class="form-control" id="menuSlug" name="slug">
            <option value="">Select Slug</option>
            @foreach($routes as $route)
              <option value="{{ $route }}">{{ $route }}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group">
          <label for="parent">Parent</label>
          <select class="form-control" id="menuParent" name="parent">
            <option value="">Select Parent</option>
            @foreach($menu_parent as $menu)
              <option value="{{$menu->id}}">{{$menu->name}}</option>
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
        <a href="{{URL::to('menu')}}" class="btn btn-warning">Back</a>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </div>
</div>
@endsection