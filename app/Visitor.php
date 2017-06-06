<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
	public $timestamps=false;
	
	       	protected $fillable=['username','email'];
	
	public function comments(){ return $this->hasMany('App\Comment');}
		
}

