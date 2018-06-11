@extends('layouts.app')
 
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      @if (Session::has('message'))
          <div class="alert alert-info">{{ Session::get('message') }}</div>
      @endif
      <center><h1>Permission</h1></center><br>
      <a href="{{ URL::to('permission/create') }}" class="btn btn-success btn-add">Tambah Baru</a>
      <table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Description</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($permissions as $permission)
          <tr>
            <th scope="row">{{$permission->id}}</th>
            <td><a href="/permission/{{$permission->id}}">{{$permission->name}}</a></td>
            <td>{{$permission->description}}</td>
            <td>
              <div class="btn-group" role="group" aria-label="Basic example">
                  <a href="{{ URL::to('permission/' . $permission->id . '/edit') }}">
                   <button type="button" class="btn btn-warning">Edit</button>
                  </a>&nbsp;
                  <form action="{{url('permission', [$permission->id])}}" method="POST">
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