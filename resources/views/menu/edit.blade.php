@extends('layouts.app')
 
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <h1>Edit Menu</h1>
      <hr>
      <form action="{{url('menu', [$menu->id])}}" method="post">
        <input type="hidden" name="_method" value="PUT">
        {{ csrf_field() }}
        <div class="form-group">
          <label for="title">Name</label>
          <input type="text" value="{{$menu->name}}" class="form-control" id="menuName"  name="name">
        </div>
        <div class="form-group">
          <label for="slug">Slug</label>
          <select class="form-control" id="menuSlug" name="slug">
            <option value="">Select Slug</option>
            @foreach($routes as $route)
              <option value="{{ $route }}" {{ $route == $menu->slug ? 'selected="selected"' : '' }} >
                {{ $route }}
              </option>
            @endforeach
          </select>
        </div>
        <div class="form-group">
          <label for="parent">Parent</label>
          <select class="form-control" id="menuParent" name="parent">
            <option value="">Select Parent</option>
            @foreach($menu_parent as $menu_p)
              <option value="{{$menu_p->id}}" {{ $menu_p->id == $menu->parent ? 'selected="selected"' : '' }} >
                {{$menu_p->name}}
              </option>
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