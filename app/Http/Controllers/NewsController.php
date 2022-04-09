<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class NewsController extends Controller
{
  
  public function index() {

    $posts = Post::notReply()->orderBy('updated_at', 'DESC')->get();
    //dd($posts);

    return view("news", [
      'posts' => $posts
    ]);
  }
}
