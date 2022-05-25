<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class NewsController extends Controller
{
  
  public function index() {

    $posts = Post::notReply()->orderBy('updated_at', 'DESC')->get();
    $categories = Category::all();
    //dd($posts);

    return view("news", [
      'posts' => $posts,
      'categories' => $categories
    ]);
  }

  public function getCategory($category)
  {
    //dd($category->posts);
    $categor = Category::all()->where('slug', $category)->first();
    //dd($categor->posts->all());
    $posts = $categor->posts;
    //dd($posts);
    $categories = Category::all();
    
    return view("news", [
      'posts' => $posts->sortDesc(),
      'categories' => $categories
    ]);
  }
}
