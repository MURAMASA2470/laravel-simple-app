<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Post;
use App\User;
use Illuminate\Http\Request;

class PostController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$posts = Post::orderBy('id', 'desc')->paginate(10);
		$users = User::select('id','name')->get();
		// $roles = User::getRoleNames();

		return view('posts.index', compact('posts', 'users'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('posts.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request)
	{
		$inputs = $request->all();

		$rules = [
			'title' => 'required', 
			'body' => 'required',
		];

		$validation = \Validator::make($inputs,$rules);

		if($validation->fails()) 
			return redirect()->back()->withErrors($validation->errors())->withInput();
			
		$post = new Post();

		$post->title = $request->input("title");
		$post->body = $request->input("body");
		$post->user_id = \Auth::user()->id;

		$post->save();

		flash('Item created successfully.')->success();
		return redirect()->route('posts.index');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Post $post)
	{
		// $post = Post::findOrFail($id);

		return view('posts.show', compact('post'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(Post $post)
	{
		$this->authorize('updateOrDestoryOfPosts', $post);

		return view('posts.edit', compact('post'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update(Request $request, Post $post)
	{

		$this->authorize('updateOrDestoryOfPosts', $post);

		$inputs = $request->all();

		$rules = [
			'title' => 'required', 
			'body' => 'required',
		];

		$validation = \Validator::make($inputs,$rules);

		if($validation->fails()) 
			return redirect()->back()->withErrors($validation->errors())->withInput();

		$post->title = $request->input("title");
        $post->body = $request->input("body");

		$post->save();

		flash('Item updated successfully.')->success();
		return redirect()->route('posts.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Post $post)
	{
		$this->authorize('updateOrDestoryOfPosts', $post);

		$post->delete();

		flash('Item deleted successfully.')->success();
		return redirect()->route('posts.index');
	}

	//関数化するとうまく動かない
	// public function check(Request $request) {

	// 	$inputs = $request->all();

	// 	$rules = [
	// 		'title' => 'required', 
	// 		'body' => 'required',
	// 	];

	// 	$validation = \Validator::make($inputs,$rules);

	// 	if($validation->fails()) 
	// 		return redirect()->back()->withErrors($validation->errors())->withInput();
	// }

}
