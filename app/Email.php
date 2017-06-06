<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{

   public $timestamps=false;
   
   protected $fillable=['address'];
   
   
   public function users(){ return $this->hasMany('App\User');} 
}
