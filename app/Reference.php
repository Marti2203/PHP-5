<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Reference extends Model
{
    //
           public $timestamps=false;
       
 protected $fillable=[ 'post_id','post_user_id','tag_id'];
    
    public function tag(){ return $this->belongsTo('App\Tag');}
    public function decrementTag()
    {		$tag=$this->tag;
			$tag->reference_count--;
			$tag->save();
		}
    public function post(){ $this->belongsTo('App\Post');}
}

