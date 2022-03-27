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
    return view('updateProfile', ['user' => Auth::user()]);
  }

  public function update(Request $request) {

    //dd($request->hasFile('banner'));
    $user = Auth::user();

    if ($request->isMethod('post')) {
      $this->validate($request, $this->validateRules(), $this->attributeNames());

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
      if (Hash::check($request->post('password'), $user->password)) {
        //dd(Hash::check($request->post('password'), $user->password));
        $user->fill([
            'name' => $request->post('name'),
            'email' => $request->post('email'),
            'password' => Hash::make($request->post('newPassword')),
            'surname' => $request->post('surname'),
        ])->save();
        //dd($user);                  
      } else {
        redirect('/home');
      }
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
      'name' => 'required|string|max:15',
      'email' => 'required|email|unique:users,email,' . Auth::id(),
      'password' => 'required',
      'newPassword' => 'required|string|min:3|confirmed',
      'image' => 'mimes:jpg,png,jpeg|max:5048',
      'banner' => 'mimes:jpg,png,jpeg|max:5048'
    ];
  }

    protected function attributeNames()
    {
        return [
            'newPassword' => 'Новый пароль'
        ];
    }
}
