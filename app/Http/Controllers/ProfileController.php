<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  
  public function index()
  {
    $userPosts = Post::notReply()->where('user_id', Auth::user()->id)->orderBy('updated_at', 'DESC')->get();
    $categories = Category::all();
    //dd($userPosts);

    return view("profile", [
      'posts' => $userPosts,
      'categories' => $categories
    ]);
  }

  public function create()
  {
    
  }

  public function store(Request $request){
    //dd();
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

    /*$categories = ['Nature', 'Space', 'Технологии', 'Юмор'];
    foreach($categories as $category)
    {
      Category::create([
        'title'  =>  $category,
        'slug' => SlugService::createSlug(Post::class, 'slug', $category)
      ]);
    }*/



    
    //dd($categories);
    
    $post = Post::create([
      'title' => $request->input('title'),
      'description' => $request->input('description'),
      'slug' => SlugService::createSlug(Post::class, 'slug', $request->title),
      'image_path' => $newImageName,
      'user_id' => auth()->user()->id,
    ]);

    $arrCat = array_values($request->categories);
    
    $categories = Category::find($arrCat);

    foreach($categories as $category) {
      //dd($category);
      DB::table('category_item')->insert([
        'category_id' => $category->id,
        'post_id' => $post->id
      ]);

    }

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
      'post' => Post::notReply()->where('slug', $slug)->first(),
      'categories' => Category::all()
    ]);
  }

  public function update(Request $request, $slug) {

    //dd($request);

    $request->validate([
      'title' => 'required',
      'description' => 'required'
    ]);

    $post = Post::notReply()->where('id', $slug)->first();
    //dd($post);

    $post->update([
      'title' => $request->input('title'),
      'description' => $request->input('description'),
      'slug' => SlugService::createSlug(Post::class, 'slug', $request->title),
      'user_id' => auth()->user()->id
    ]);

    DB::table('category_item')->where('post_id', $post->id)->delete();

    //dd($post->categories);

    $arrCat = array_values($request->categories);

    
    $categories = Category::find($arrCat);


    foreach($categories as $category) {
      //dd($category);
      DB::table('category_item')->insert([
        'category_id' => $category->id,
        'post_id' => $post->id
      ]);
    }

    return redirect('/profile')->with('message', 'Your post has been updated!');
  }

  public function destroy($slug)
  {
    $post = Post::where('slug', $slug)->first();

    DB::table('category_item')->where('post_id', $post->id)->delete();

    $post->delete();

    

    return redirect('profile')->with('message', 'Your post has been deleted!');
  }
  
  
}
