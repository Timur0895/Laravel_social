<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use App\Notifications\commentedPost;
use App\Notifications\likedPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

    $user = Auth::user();

    $author = $post->user;
    //dd($author);

    $author->notify(new commentedPost($user, $post));

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
    $user = Auth::user();
    $post = Post::find($statusId);

    //dd($post);

    if(!$post) redirect()->back();

    

    if(Auth::user()->hasLikedStatus($post))
    {
      return redirect()->back();
    }

    $post->likes()->create(['user_id' => Auth::user()->id]);

    $author = $post->user;
    //dd($author);

    $author->notify(new likedPost($user, $post));

    return back();
  }

  public function readNotify($id)
  {
    $notification = Auth::user()->notifications->where('id', $id)->first();

    $notification->markAsRead();

    //dd($notification);

    return back();

  }

  public function deleteLike($statusId)
  {
    //dd($statusId);

    $post = Like::where('likeable_id', $statusId);

    //dd($post);

    $post->delete();

    return back();
  }
}
