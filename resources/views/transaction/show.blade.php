@extends('layouts.app')
 
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <h1>Showing Transaction: {{ $transaction->id }}</h1>
      <a href="{{URL::to('transaction')}}" class="btn btn-success btn-add">Back</a>
      <div class="jumbotron text-center">
        <div class="row">
          <div class="col-md-4">
            <p>
                <strong>User:</strong> {{ $transaction->User->name }}<br>
                <strong>Date:</strong> {{ date('Y-m-d', strtotime($transaction->created_at)) }}<br>
                <strong>Time:</strong> {{ date('H:i:s', strtotime($transaction->created_at)) }}<br>
            </p>
          </div>
          <div class="col-md-8">
            <h2>Detail Transaction</h2>
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Product</th>
                  <th>Quantity</th>
                  <th>Price</th>
                  <th>Total Price</th>
                </tr>
              </thead>
              <tbody>
                @foreach($transaction->TransactionDetail as $key => $val)
                  <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $products[$val->product_id] }}</td>
                    <td class="text-center">{{ $val->quantity }}</td>
                    <td class="text-right">Rp. {{ number_format($val->price) }}</td>
                    <td class="text-right">Rp. {{ number_format($val->total_price) }}</td>
                  </tr>
                @endforeach
                <tr>
                  <td colspan="4" class="text-center">Total</td>
                  <td class="text-right">Rp. {{ number_format($transaction->total_price) }}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection