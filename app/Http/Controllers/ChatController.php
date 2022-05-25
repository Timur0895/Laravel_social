<?php

namespace App\Http\Controllers;

use App\Models\ChFavorite;
use App\Models\ChMessage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
  public function index() {

    $lastMessage = ChMessage::all()->last();

    $friends = Auth::user()->friends();
    return view("vendor.Chatify.pages.app", [
      'friends' => $friends,
      'lastMessage' => $lastMessage 
    ]);
  }

  public function chatProfile($id)
  {
    //dd($id);
    //$myMessages = ChMessage::all()->where('from_id', Auth::user()->id)->where('to_id', $id);
    //$toMeMessages = ChMessage::all()->where('from_id', $id)->where('to_id', Auth::user()->id);
    $messages = ChMessage::query()->where('from_id', Auth::user()->id)->orWhere('to_id', Auth::user()->id)->orderBy('created_at', 'DESC')->get();

    //dd($messages->where('from_id', $id));
    
    foreach ($messages->where('from_id', $id) as $message) {
      $message->update([
        'seen' => 1
      ]);     
    }

    $lastMessage = ChMessage::all()->last();

    $favorite = Auth::user()->favorites()->where('favorite_id', $id)->first();//ChFavorite::all()->where('favorite_id', $id);
    
    //dd($favorite);
    //dd($toMeMessages);

    $user = User::find($id);
    //dd($user);
    return view("vendor.Chatify.pages.app", [
      'user' => $user,
      'friends' => Auth::user()->friends(),
      'messages' => $messages,
      'favorite' => $favorite,
      'lastMessage' => $lastMessage 
    ]);
  }

  public function sendMessage(Request $request, $id)
  {
    $user = Auth::user();
    $receiver = User::find($id);
    $type = get_class($receiver);
    
    //dd($request->hasFile('file'));

    if ($request->hasFile('file')) {
      $item = $request->file('file');
      $filename = time() . '.' . $item->getClientOriginalExtension();
      $request->file->move(public_path('messageFiles'), $filename);
      $file = ChMessage::create([
        'attachment' => $filename,
        'type' => $type,
        'from_id' => $user->id,
        'to_id' => $receiver->id,
        'body' => $request->message,
      ]);
      //dd($file);
    } else {
      ChMessage::create([
        'type' => $type,
        'from_id' => $user->id,
        'to_id' => $receiver->id,
        'body' => $request->message,
      ]);
    }
    
    //dd($request->file('file')->getClientOriginalName());

    return back();
  }

  public function makeFavorite($id)
  {
    $favorite = Auth::user()->favorites()->where('favorite_id', $id)->first();//ChFavorite::all()->where('favorite_id', $id);
    
    //dd($favorite);

    //dd(Auth::user()->favorites($id));
    $user = User::find($id);
    
    if ($favorite) {
      $favorite->delete();
    } else {
      ChFavorite::create([
        'user_id' => Auth::user()->id,
        'favorite_id' => $user->id
      ]);
    }

    if ($favorite) {
      $message = "Удален из избранного";
    } else {
      $message = "Добавлен в избранное";
    };
    
    //dd($favorite);

    //dd($user);

    return back()->with('message', $message);
  }

  public function deleteDialog($id)
  {
    $user = User::find($id);
    $userMessages = $user->dialogs()->where('to_id', Auth::user()->id);
    $userMessages->each->delete();

    $dialog = Auth::user()->dialogs()->where('to_id', $id);
    $dialog->each->delete();

    //dd($userMessages);
    return back()->with('message', "Диалог удален!");
  }
}
