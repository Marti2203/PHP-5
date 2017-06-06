<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Reference;

class TagController extends Controller
{
	public function delete($id)
	{
		$tag=Tag::where('id',$id)->first();
		foreach($tag->references() as $reference)
		$reference->decrementTag();
		Reference::destroy($reference->id);
		
		Tag::destroy($id);
		return redirect()->back();
	}
	public function edit($id)
	{
		
	}
}

?>
