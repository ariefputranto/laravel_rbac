<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PermissionDetail extends Model
{
    protected $fillable = ['permission_id','slug'];

    public function Permission()
    {
    	return $this->belongsTo('App\Permission');
    }

}
