<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Reference;

class Tag extends Model
{
       public $timestamps=false;
       
       protected $fillable=[ 'name',];
              
       public function users() { return $this->belongsToMany('App\User'); }
       public function references() { return Reference::where('tag_id','=',$this->id)->get();}
}
