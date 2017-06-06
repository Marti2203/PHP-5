<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

       public $timestamps=false;
       
       protected $fillable=['text','title','user_id'];
       
       public function user(){ return $this->belongsTo('App\User');}
       public function tag(){ return $this->hasOne('App\Tag');}
       public function references() { return $this->hasMany('App\Reference'); }
       public function comments() { return $this->hasMany('App\Comment');}
       public function visitors() {return $this->hasManyThrough('App\Visitor','App\Comment');}
}
