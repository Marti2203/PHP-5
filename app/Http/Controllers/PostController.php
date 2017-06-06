<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use App\Tag;
use App\Reference;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Kris\LaravelFormBuilder\FormBuilder;
use Kris\LaravelFormBuilder\FormBuilderTrait;
use Illuminate\Support\Facades\Auth;
use Michelf\MarkdownExtra;
use App\Forms\PostForm;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PostController extends BaseController
{
	use FormBuilderTrait;
		
    public function listAll()
    {
		$users=User::all();
		return view('blog.list',compact('users'));
	}
	public function viewID($id,$chunk=0,$size=20)
	{
		$user=User::where('id',$id)->firstOrFail();
		return $this->viewUser($user,$chunk,$size);
	}
	public function viewName(Request $request,$name="empty",$chunk=0,$size=20)
	{
		if($name==="empty")
		$name=$request->get('name');
		
		return $this->viewUser(User::where('username',$name)->firstOrFail(),$chunk,$size);
	}
	
	public function viewDate($year,$month=null,$chunk=0,$size=20)
	{
		$postBuilder=Post::whereYear('created_at',$year);
		if($month!=null)
		$postBuilder=Post::whereMonth('created_at', $month);
		
		$hasMore=$postBuilder->count()>($chunk+1)*$size;
		$posts=$postBuilder->orderBy('created_at','desc')->skip($chunk*$size)->take($size)->get();
		$title='All posts of year '.$year.($month==null ? "" : "Month ".$month);
		
		return $this->loadPosts($posts,$year,'search',$hasMore,$chunk,$size,$title);
	}
	
	private function viewUser($user,$chunk,$size)
	{
		$posts=$user->latestPosts($chunk,$size);
		$hasMore=$user->hasMorePosts($chunk,$size);
		$title="All posts of ".$user->username." page :".($chunk+1);
		
		return $this->loadPosts($posts,$user->id,'blogger',$hasMore,$chunk,$size,$title);
	}
	
	private function loadPosts($posts,$tag,$action,$hasMore,$chunk,$size,$title)
	{
		return view('post.viewAll',compact('posts','tag','action','hasMore','chunk','size','title'));
	}
	
	public function viewPost(FormBuilder $formBuilder,$postID)
	{
		$post=Post::find($postID);
		$comments=$post->comments;
		$form = $formBuilder->create('App\Forms\CommentForm', ['method' => 'POST', 'class' => 'form-horizontal','url' => action('CommentController@store')]);
		return view('post.viewSingle',compact('post','comments','form'));
	}
	
	public function search(Request $request,$tag=null,$chunk=0,$size=20)
	{
		if($tag==null)
		$tag=$request->get('name');
		
		$tag=Tag::where('name',$tag)->first();
		$posts=array();
		$action='search';
		
		
		$hasMore=Reference::where('tag_id','=',$tag->id)->count()>(($chunk+1)*$size);
		
		foreach(Reference::where('tag_id','=',$tag->id)->orderBy('post_id','desc')->skip($chunk*$size)->take($size)->get() as $reference)
		array_push($posts,Post::find($reference["post_id"]));
		
		$tag=$tag->name;
		$title="Posts with tag ".$tag." page:".($chunk+1);
		return view('post.viewAll',compact('posts','tag','action','hasMore','chunk','size','title'));
	}
	
	public function store(Request $request)
	{	
		$form=$this->form(PostForm::class);
		
		if (!$form->isValid()) return redirect()->back()->withErrors($form->getErrors())->withInput();
        
        $count=0;
        foreach($request->input('tags') as $tagInput)
        if($tagInput!=null) $count++;
        
        if($count==0) return redirect()->back()->withErrors('No Valid Tags. Post must have atleast one.');
        
        $post=Post::create(['title'=>$request->input('title'),'text'=>$request->input('text'),'user_id'=>Auth::id(),]); 
        
        $createdTags=array();
        foreach($request->input('tags') as $tagInput)
        {
			if($tagInput==null || in_array($tagInput,$createdTags)) continue;
			
			$tag=Tag::firstOrCreate(['name'=>$tagInput]);
			
			Reference::create(['post_id'=>$post->id,'post_user_id'=>Auth::id(),'tag_id'=>$tag->id]);
			
			$tag->reference_count++;
			$tag->save();
			array_push($createdTags,$tagInput);
		}
		
        return redirect()->action('PostController@viewID',['id'=>Auth::id()]); 
	}
	
	public function create(FormBuilder $formBuilder)
	{
		$form = $formBuilder->create('App\Forms\PostForm', ['method' => 'POST','url' => action('PostController@store')]);
		 return view('post.create',compact('form')); 
	}
    public function delete($id)
    {
		$post=Post::where('id',$id)->first();
		foreach($post->references as $reference){
		$reference->decrementTag();
		Reference::destroy($reference->id);
		}
		Post::destroy($id);
		return redirect('/');
	}
	public function deleteTag($post_id,$tag_id)
	{
		$reference=Reference::where([['post_id',$post_id],['tag_id',$tag_id]])->first();
		$tag=Tag::where('id',$tag_id)->first();
		$tag->reference_count--;
		$tag->save();
		Reference::destroy($reference->id);
		return redirect('/');
	}
}
?>
