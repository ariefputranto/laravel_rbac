<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['user_id','total_price'];

    public function User()
    {
    	return $this->belongsTo('App\User');
    }

    public function TransactionDetail()
    {
    	return $this->hasMany('App\TransactionDetail');
    }
}
