@extends('layouts.app')
 
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      @if (Session::has('message'))
          <div class="alert alert-info">{{ Session::get('message') }}</div>
      @endif
      <center><h1>Menu</h1></center><br>
      <a href="{{ URL::to('menu/create') }}" class="btn btn-success btn-add">Tambah Baru</a>
      <table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Slug</th>
            <th scope="col">Parent</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($menus as $menu)
          <tr>
            <th scope="row">{{$menu->id}}</th>
            <td><a href="/menu/{{$menu->id}}">{{$menu->name}}</a></td>
            <td>{{$menu->slug}}</td>
            <td>{{$menu->parent}}</td>
            <td>
              <div class="btn-group" role="group" aria-label="Basic example">
                  <a href="{{ URL::to('menu/' . $menu->id . '/edit') }}">
                   <button type="button" class="btn btn-warning">Edit</button>
                  </a>&nbsp;
                  <form action="{{url('menu', [$menu->id])}}" method="POST">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="submit" class="btn btn-danger" value="Delete"/>
                 	</form>
              </div>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection