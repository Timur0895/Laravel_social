<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function getSearch(Request $request) 
    {
      $search = $request->input('search');
      
      $users = User::where(DB::raw('concat(name," ",surname)') , 'LIKE' , "%{$search}%")->get();
      $posts = Post::query()->where('title', 'LIKE', "%{$search}%")->get();
      //dd($posts);
      return view('search')->with([
        'users' => $users,
        'posts' => $posts
      ]);
    }
}
