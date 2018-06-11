<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = ['name','description'];

    public function Role()
    {
    	return $this->belongsToMany('App\Role')
        ->withTimestamps();
    }

    public function PermissionDetail()
    {
        return $this->hasMany('App\PermissionDetail');
    }

}
