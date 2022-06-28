<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
  public function index() {
    return view('admin/index');
  }

  public function login(Request $request) {
    //dd($request);
    $user = User::all()->where('email', $request->email)->first();
    //dd($user->is_admin);

    if ($user) {
      if ($user->is_admin) {
        Auth::login($user);
        return redirect('/admin');
      } else {
        return back()->with('message', 'Вы не админ!');
      }
    } else {
      return back()->with('message', 'Пользователь не найден');
    }
    
    return view('admin/index');
  }

  public function dashboard() {

    $posts = Post::notReply();
    $users = User::all();
    $comments = Post::all()->whereNotNull('parent_id');

    //dd($comments);

    return view('admin/dashboard')->with([
      'posts' => $posts,
      'users' => $users,
      'comments' => $comments
    ]);
  }

  public function getUser($id)
  {
    $user = User::find($id);
    //dd($user);
  }
}
