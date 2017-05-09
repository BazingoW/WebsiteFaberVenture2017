<?php
namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller{



  public function postSignUp(Request $request)
  {
    $this->validate($request, [
        'email' => 'required|email|unique:users',
        'name' => 'required|unique:users|max:120',
        'password' => 'required|min:4'
    ]);


      $email=$request['email'];
      $name=$request['name'];
      $password=bcrypt($request['password']);

      $user = new User();
      $user->email = $email;
      $user->name = $name;
      $user->password = $password;

      $user->save();

      if(Auth::attempt(['email'=>$request['email'],'password'=>$request['password']]))
      {
                 return redirect()->route('frontpage');
      }
  }



    public function postSignIn(Request $request)
    {
      $this->validate($request, [
          'email' => 'required|email',
          //'username' => 'required|uique|max:120',
          'password' => 'required'
      ]);



      if(Auth::attempt(['email'=>$request['email'],'password'=>$request['password']]))
      {
                 return redirect()->route('dashboard');
      }

      return redirect()->back();
    }


    public function getLogout()
    {
      Auth::logout();
      return redirect()->back();
    }
}
