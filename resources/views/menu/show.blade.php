@extends('layouts.app')
 
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <h1>Showing Menu {{ $menu->name }}</h1>
      <a href="{{URL::to('menu')}}" class="btn btn-success btn-add">Back</a>
      <div class="jumbotron text-center">
          <p>
              <strong>Name:</strong> {{ $menu->name }}<br>
              <strong>Slug:</strong> {{ $menu->slug }}<br>
              <strong>Parent:</strong> {{ $menu->parent }}<br>
          </p>
      </div>
    </div>
  </div>
</div>
@endsection