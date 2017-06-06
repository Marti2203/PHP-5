<?php

namespace App\Http\Controllers;

use App\Gender;
use App\User;
use App\Email;
use App\Post;
use App\Reference;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Kris\LaravelFormBuilder\FormBuilder;
use Kris\LaravelFormBuilder\FormBuilderTrait;
use App\Forms\UserForm;

class UserController extends BaseController
{
	use FormBuilderTrait;
	
    public function listAll()
    {
		$users=App\User::all();
		return view('list',compact('users'));
	}
	
	public function create(FormBuilder $formBuilder)
	{
		$form = $formBuilder->create('App\Forms\UserForm', ['method' => 'POST','url' => action('UserController@create')]);
		 return view('user.create',compact('form')); 
	}
	
	public function store(Request $request)
	{
		$form=$this->form(UserForm::class);
		
		$form->validate([],['password.regex'=>'The password must start with a capital letter.']);
		
		if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }
		
		$pictureName='default';
		
		if($request->hasFile('picture'))
		$request->picture->storeAs('public/images',$request->picture->getFilename(),'public');
		
		$email=Email::firstOrCreate(['address'=>$request->input('email')]);
		
		$user = User::create([
		'username'=>$request->input('username'),
		'password'=>Hash::make($request->input('password')),
		'secret_answer'=>Hash::make($request->input('secret_answer')),
		'picture_name'=>$pictureName,
		'genders_id'=>$request->input('gender'),
		'secret_question_id'=>$request->input('secret_question'),
		'date_of_birth'=>$request->input('date_of_birth'),
		'emails_id'=>$email->id,
		]);
		
		return redirect()->route('blogger/profile',['id'=>$user->id]);
	}
	
	public function view($id)
	{
	 return view('user.view',['user'=>User::where('id',$id)->firstOrFail()]);
	}
	
	public function update(Request $request,$id)
	{
		$user=User::find($id);
		$email=Email::firstOrCreate(['address'=>$request->input('email')]);
		$user->email=$email;
	}
	
    public function delete($id)
    {
		$user=User::where('id',$id)->first();
		foreach($user->posts as $post)
		{
			foreach($post->references() as $reference){
			Reference::destroy($reference->id);
			$reference->decrementTag();
			}
			foreach($post->comments as $comment)
			Comment::destroy($comment->id);
			Post::destroy($post->id);
		}
		User::destroy($id);
		return view('main')->with('text','Removed user.');
	}
	
	public function edit(FormBuilder $formBuilder,$id)
	{
		$form = $formBuilder->create('App\Forms\UserForm', ['method' => 'POST','model'=>User::where('id',$id)->first(),'url' => action('UserController@create')]);
		 return view('user.create',compact('form')); 
	}
	
}
?>
