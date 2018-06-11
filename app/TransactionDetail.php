<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    protected $fillable = ['transaction_id','product_id','quantity','price','total_price'];

    public function Transaction()
    {
    	return $this->belongsTo('App\Transaction');
    }
}
