<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
     
	protected $guarded=[
		'id','is_administrator',
	];
	
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'secret_answer'
    ];
    
       public $timestamps=false;
    
    
    public function latestPosts(int $chunk,int $size) { return $this->posts()->orderBy('created_at','des')->skip($chunk*$size)->take($size)->get();}
    public function hasMorePosts(int $chunk,int $size) {return $this->posts()->count()>($chunk+1)*$size; }
    public function email() { return Email::where('id',$this->emails_id)->first(); }
	public function secretQuestion() { return $this->belongsTo('App\SecretQuestion'); }
	public function posts() { return $this->hasMany('App\Post'); }
	public function gender() { return Gender::where('id',$this->genders_id)->first();}
}
