<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StatusController extends Controller
{
  public function postReply(Request $request, $statusId)
  {
    //dd($statusId);
    $this->validate($request, [
      "reply-{$statusId}" => 'required|max:1000'
    ]);

    //dd($request);
    $post = Post::notReply()->find($statusId);
    //dd($post);
    if(!$post) redirect()->back();

    //dd($status->user->id);
    if (!Auth::user()->isFriendWith($post->user) && Auth::user()->id !== $post->user->id)
    {
      //dd($request);
      return redirect()->back();
    };

    

    $reply = new Post();
    $reply->description = $request->input("reply-{$post->id}");
    $reply->user()->associate(Auth::user());
    $reply->slug = $post->slug;
    $reply->title = $post->title;
    $post->replies()->save($reply);

    return redirect()->back();
  }

  public function deleteReply($statusId)
  {
    //dd($statusId);

    Post::where('id', $statusId)->delete();

    return back();
  }

  public function getLike($statusId)
  {
    $post = Post::find($statusId);

    if(!$post) redirect()->back();

    if(!Auth::user()->isFriendWith($post->user))
    {
      return redirect()->back();
    };

    if(Auth::user()->hasLikedStatus($post))
    {
      return redirect()->back();
    }

    $post->likes()->create(['user_id' => Auth::user()->id]);

    return redirect()->back();
  }
}
