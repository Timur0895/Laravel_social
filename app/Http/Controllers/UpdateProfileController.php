<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Image;

class UpdateProfileController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function profile() {

    $userPosts = Post::notReply()->where('user_id', Auth::user()->id)->orderBy('updated_at', 'DESC')->get();

    return view('updateProfile', [
      'user' => Auth::user(),
      'posts' => $userPosts
    ]);
  }

  public function update(Request $request) {

    //dd($request);
    $user = Auth::user();

    if ($request->isMethod('post')) {
      $this->validate($request, $this->validateRules());

      if($request->hasFile('banner')){
        $avatar = $request->file('banner');
        $filename = time() . '.' . $avatar->getClientOriginalExtension();
        $request->banner->move(public_path('banners'), $filename);
        $user->banner_path = $filename;
        $user->save();
      }

      if($request->hasFile('image')){
        $avatar = $request->file('image');
        $filename = time() . '.' . $avatar->getClientOriginalExtension();
        $request->image->move(public_path('images'), $filename);
        $user->image_path = $filename;
        $user->save();
      }
      
      //dd(Hash::check($request->post('password'), $user->password));
      /*if (Hash::check($request->post('password'), $user->password)) {
        //dd(Hash::check($request->post('password'), $user->password));
        
        //dd($user);                  
      } else {
        redirect('/home');
      }*/
      $user->update([
        'name' => $request->post('name'),
        'email' => $request->post('email'),
        'surname' => $request->post('surname'),
      ]);
      //dd($user);
    }
    //dd($user);
    return redirect('profile')->with([
      'message'=> 'Your profile has been updated!',
    ]);
  }


  /*public function update(Request $request) 
  {
    $user = Auth::user();

    if ($request->isMethod('post')) 
    {
      //dd($request->user());

      //$this->validate($request, $this->validateRules(), $this->attributeNames());
      //dd($this);
      //dd($request->post('banner'));

      if (Hash::check($request->post('password'), $user->password)) {
        //dd(Hash::check($request->post('password'), $user->password));
        $user->fill([
            'surname' => $request->post('surname'),
            'name' => $request->post('name'),
            'email' => $request->post('email'),
            'password' => Hash::make($request->post('newPassword'))
        ])->save();
        
        return view('profile', [
          'posts'=> Post::orderBy('updated_at', 'DESC')->get()
        ]);
      } else {
        return view('updateProfile', [
          'user' => $user
        ]);
      }
    }
    //dd($user);
    return view('updateProfile', [
      'user' => $user
    ]);
    
  }*/

  protected function validateRules()
  {
    return [
      'surname' => 'string|max:15',
      'name' => 'string|max:15',
      'email' => 'email|unique:users,email,' . Auth::id(),
      'image' => 'mimes:jpg,png,jpeg|max:5048',
      'banner' => 'mimes:jpg,png,jpeg|max:5048'
    ];
  }

    
}
