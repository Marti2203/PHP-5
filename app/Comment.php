<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

       public $timestamps=false;
       
       	protected $fillable=[ 'text','visitor_id','post_id','post_user_id',];
	

       public function visitor() { return $this->belongsTo('App\Visitor'); }
       public function post() { return $this->belongsTo('App\Post'); }
}
