<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    protected $fillable = ['user_id','role_id'];

    public function Role()
    {
    	return $this->belongsTo('App\Role');
    }

    public function User()
    {
    	return $this->belongsTo('App\User');
    }
}
