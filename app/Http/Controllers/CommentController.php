<?php

namespace App\Http\Controllers;


use App\Visitor;
use App\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
	public function store(Request $request)
	{
		$this->validate($request,[
        'comment'=>'required|max:200',
        'username'=>'required|max:45',
        'email'=>'nullable|email|max:45' ,
        ]);
		
		$visitor=Visitor::where('username',$request->input('username'))->first();
		if($visitor!=null)
		{if($visitor->email!=null && $visitor->email!=$request->input('email')) 
			return redirect()->back()->withErrors(['Username is secured']);}
		else
		 $visitor=Visitor::create(['username'=>$request->input('username'),'email'=>$request->input('email')]);
		 
		$comment=Comment::create(['post_id'=>$request->input('post_id'),'post_user_id'=>$request->input('post_user_id'),'text'=>$request->input('comment'),'visitor_id'=>$visitor->id]);
		 
		return redirect()->back();
	}
	
	public function delete($id)
	{
		Comment::destroy($id);
		return redirect()->back();
	}
}
