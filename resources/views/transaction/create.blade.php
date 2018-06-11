@extends('layouts.app')
 
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/select2.min.css') }}">
@endsection

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <h1>Add New Transaction</h1>
      <hr>
        @if (Session::has('message'))
            <div class="alert alert-info">{{ Session::get('message') }}</div>
        @endif
        <div class="form-group">
          <label for="product">Product</label>
          <select class="form-control transactionProduct" id="transactionProduct">
            <option value="" price="0">Please select product</option>
            @foreach($products as $product)
            <option value="{{$product['id']}}" price="{{$product['price']}}">{{$product['name']}}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group">
          <label for="quantity">Quantity</label>
          <input type="number" class="form-control" id="transactionQuantity">
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
        <button class="btn btn-primary btn-add" type="button" id="BtnAdd">Add</button>
        
        <form action="/transaction" method="post">
          {{ csrf_field() }}
          <table class="table table-striped" id="TransactionTable">
            <thead>
              <th>#</th>
              <th>Product</th>
              <th>Quantity</th>
              <th>Price(product)</th>
              <th>Total Price</th>
            </thead>
            <tbody>
              <tr id="TotalPrice">
                <td colspan="4">Total</td>
                <td>0</td>
              </tr>
            </tbody>
          </table>
          <br>
          <center><button type="submit" class="btn btn-success" id="BtnSubmit">Submit</button></center>
        </form>
    </div>
  </div>
</div>
@endsection

@section('script')
<script src="{{ asset('js/select2.min.js') }}"></script>
<script>
  $(document).ready(function(){
    var NumData = 1;
    var Total = 0;

    $('#BtnSubmit').attr('disabled','disabled');
    $('#transactionProduct').select2();
    $('#BtnAdd').on('click', function(){
      var Quantity = $('#transactionQuantity').val();
      var ProductName = $('#transactionProduct option:selected').text();
      var ProductId = $('#transactionProduct option:selected').val();
      var Price = $('#transactionProduct option:selected').attr("price");

      if (Quantity == '' || ProductId == '' || Price == '' || parseInt(Quantity) < 1) {
        alert("please fill form and make sure it is correct before add!");
        return false;
      }

      var TotalPrice = parseInt(Price) * parseInt(Quantity);
      Total += TotalPrice;
      var TotalNumFormat = parseInt(Total).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,');
      var PriceNumFormat = parseInt(Price).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,');
      var TotalPriceNumFormat = parseInt(TotalPrice).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,');
      var DataAppend = "<tr>"+
      "<td>"+NumData+"</td>"+
      "<td>"+ProductName+"</td>"+
      "<td>"+Quantity+"</td>"+
      "<td>Rp. "+PriceNumFormat+"</td>"+
      "<td>"+
        "Rp. "+TotalPriceNumFormat+""+
        "<input type='hidden' name='product_id[]' value='"+ProductId+"'>"+
        "<input type='hidden' name='quantity[]' value='"+Quantity+"'>"+
        "<input type='hidden' name='price[]' value='"+Price+"'>"+
      "</td>"+
      "</tr>";

      $(DataAppend).insertBefore("#TotalPrice");
      $('#TotalPrice').children().eq(1).text("Rp. "+TotalNumFormat);

      $('#transactionProduct').select2("val",'');
      $('#transactionQuantity').val("0");
      $('#BtnSubmit').removeAttr('disabled');
      NumData++;
    });
  });
</script>
@endsection