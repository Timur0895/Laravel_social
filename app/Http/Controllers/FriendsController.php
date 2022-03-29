<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    dd($usermail);
  }
}
