<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FriendsController extends Controller
{
  public function index() {
    $friends = Auth::user()->friends();
    $currentUser = Auth::user();
    $users = User::all()->except($currentUser->id);
    $requests = Auth::user()->friendRequests();
    //dd($users); 

    return view("friends", [
      'users' => $users,
      'friends' => $friends,
      'requests' => $requests
    ]);
  }

  public function getAdd($usermail)
  {
    //dd($usermail);
    $user = User::where('email', $usermail)->first();

    if (!$user) {
      return redirect()->route('friends')->with('message', 'Пользователь не найден');
    }

    if (Auth::user()->id ===  $user->id)
    {
      return redirect()->route('friends');
    }

    if  (Auth::user()->hasFriendRequestPending($user) || $user->hasFriendRequestPending(Auth::user()))
    {
      return redirect()->route('friends', ['usermail' => $user->mail])->with('message', 'Отправлен запрос в друзья');
    }

    if(Auth::user()->isFriendWith($user))
    {
      return redirect()->route('friends', ['usermail' => $user->mail])->with('message', 'Пользователь уже в друзьях');
    }

    Auth::user()->addFriend($user);

    return redirect()->route('friends', ['usermail' => $usermail])->with('message', 'Отправлен запрос в друзья');
  }

  public function getAccept($usermail)
  {
    //dd($usermail);

    $user = User::where('email', $usermail)->first();

    if (!$user) {
      return redirect()->route('friends')->with('message', 'Пользователь не найден');
    }

    if (!Auth::user()->hasFriendRequestReceived($user))
    {
      return redirect()->route('friends');
    }

    Auth::user()->acceptFriendRequest($user);

    return redirect()->route('friends', ['usermail' => $usermail])->with('message', 'Запрос о дружбе принят');
  }

  public function getProfile($usermail)
  {
    $userProfile = User::where('email', $usermail)->first();
    //dd($userProfile);

    return view('profile')->with('user', $userProfile);
  }

  public function postDelete($usermail)
  {
    $user = User::where('email', $usermail)->first();

    Auth::user()->deleteFriend($user);

    return redirect()->route('friends')->with('message', 'Удален из друзей');
  }

}
