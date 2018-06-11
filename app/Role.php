<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name','description'];

    public function Permission()
    {
    	return $this->belongsToMany('App\Permission')
    	->withTimestamps();
    }

    public function Assignment()
    {
    	return $this->hasOne('App\Assignment');
    }
}
