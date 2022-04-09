<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  
  public function index()
  {
    $userPosts = Post::notReply()->where('user_id', Auth::user()->id)->orderBy('updated_at', 'DESC')->get();
    //dd($userPosts);

    return view("profile")->with('posts', $userPosts);
  }

  public function create()
  {
    
  }

  public function store(Request $request){
    //dd($request->input('title'));
    $request->validate([
      'title' => 'required',
      'description' => 'required',
      'image' => 'mimes:jpg,png,jpeg|max:5048'
    ]);

    if($request->image) {
      $newImageName = uniqid() . '-' . $request->title . '.' . $request->image->extension();

      $request->image->move(public_path('images'), $newImageName);
    } else {
      $newImageName = '';
    }

    Post::create([
      'title' => $request->input('title'),
      'description' => $request->input('description'),
      'slug' => SlugService::createSlug(Post::class, 'slug', $request->title),
      'image_path' => $newImageName,
      'user_id' => auth()->user()->id
    ]);

    return redirect('/profile')->with('message', 'Your post has been created!');
  }

  /**
    * Display the specified resource.
    *
    * @param  string $slug
    * @return \Illuminate\Http\Response
    */
  public function show($slug)
  {
    return view('profile')->with([
      'post' => Post::where('slug', $slug)->first(),
      'posts'=> Post::orderBy('updated_at', 'DESC')->get()
    ]);
  }

  public function edit($slug)
  {  
    return view('profile')->with([
      'posts'=> Post::notReply()->where('user_id', Auth::user()->id)->orderBy('updated_at', 'DESC')->get(),
      'post' => Post::notReply()->where('slug', $slug)->first()
    ]);
  }

  public function update(Request $request, $slug) {

    $request->validate([
      'title' => 'required',
      'description' => 'required'
    ]);

    Post::notReply()->where('slug', $slug)->update([
        'title' => $request->input('title'),
        'description' => $request->input('description'),
        'slug' => SlugService::createSlug(Post::class, 'slug', $request->title),
        'user_id' => auth()->user()->id
    ]);

    return redirect('profile')->with('message', 'Your post has been updated!');
  }

  public function destroy($slug)
  {
    Post::where('slug', $slug)->delete();

    return redirect('profile')->with('message', 'Your post has been deleted!');
  }
  
  
}
