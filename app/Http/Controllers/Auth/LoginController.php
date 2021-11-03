<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{

 public function __construct()
 {

  $this->middleware('guest', ['only' => 'ShowLoginController']);
 }

 public function ShowLoginController()
 {

  return view('auth.login');

 }
 public function login(Request $request)
 {

  $credentials = $request->only('email', 'password');

  if (Auth::attempt($credentials)) {
   return redirect()->intended('Dashboard');

  } else {
   return back()
    ->withErrors(['email' => trans('Auth.failed')])
    ->withInput(request(['email']));

  }

 }
 public function logout()
 {
  Auth::logout();

  return redirect('/');

 }
}
