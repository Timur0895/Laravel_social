<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ColorController extends Controller
{
    public function setColor(Request $request)
    {
      //dd($request);

      $user = Auth::user();

      $user->fill([
        'setColor' => $request->color
      ])->save();

      //dd($user);
      return back();
    }

    public function textColor(Request $request)
    {
      //dd($request->color);

      $user = Auth::user();

      $user->fill([
        'messenger_color' => $request->color
      ])->save();

      //dd($user);
      

      return back();
    }
}
