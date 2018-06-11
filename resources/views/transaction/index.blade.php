@extends('layouts.app')
 
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      @if (Session::has('message'))
          <div class="alert alert-info">{{ Session::get('message') }}</div>
      @endif
      <center><h1>Transaction</h1></center><br>
      <a href="{{ URL::to('transaction/create') }}" class="btn btn-success btn-add">Tambah Baru</a>
      <table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">#</th>
            <th scope="col">User</th>
            <th scope="col">Total Price</th>
            <th scope="col">Date</th>
            <th scope="col">Time</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($transactions as $transaction)
          <tr>
            <th scope="row">{{$transaction->id}}</th>
            <td><a href="/transaction/{{$transaction->id}}">{{$transaction->User->name}}</a></td>
            <td>Rp. {{ number_format($transaction->total_price) }}</td>
            <td>{{ date('Y-m-d', strtotime($transaction->created_at)) }}</td>
            <td>{{ date('H:i:s', strtotime($transaction->created_at)) }}</td>
            <td>
              <div class="btn-group" role="group" aria-label="Basic example">
                  <!-- <a href="{{ URL::to('transaction/' . $transaction->id . '/edit') }}">
                   <button type="button" class="btn btn-warning">Edit</button>
                  </a>&nbsp; -->
                  <form action="{{url('transaction', [$transaction->id])}}" method="POST">
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