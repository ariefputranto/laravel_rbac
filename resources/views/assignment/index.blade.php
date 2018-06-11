@extends('layouts.app')
 
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      @if (Session::has('message'))
          <div class="alert alert-info">{{ Session::get('message') }}</div>
      @endif
      <center><h1>Assignment</h1></center><br>
      <a href="{{ URL::to('assignment/create') }}" class="btn btn-success btn-add">Tambah Baru</a>
      <table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">#</th>
            <th scope="col">User</th>
            <th scope="col">Role</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($assignments as $assignment)
          <tr>
            <th scope="row">{{$assignment->id}}</th>
            <td><a href="/assignment/{{$assignment->id}}">{{ $assignment->User->name }}</a></td>
            <td>{{$assignment->Role->name}}</td>
            <td>
              <div class="btn-group" assignment="group" aria-label="Basic example">
                  <a href="{{ URL::to('assignment/' . $assignment->id . '/edit') }}">
                   <button type="button" class="btn btn-warning">Edit</button>
                  </a>&nbsp;
                  <form action="{{url('assignment', [$assignment->id])}}" method="POST">
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