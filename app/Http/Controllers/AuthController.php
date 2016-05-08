<?php

namespace Chatty\Http\Controllers;

use Auth;
use Chatty\Models\User;
use Illuminate\Http\Request;




class AuthController extends Controller
{

	public function getSignup()
	{
		return view('auth.signup');
	}

	public function postSignup(Request $request)
	{
		$this->validate($request, [

			'username'   =>   'required|unique:users|alpha_dash|max:20',

			'password'   =>   'required|min:6',
			
			'email'      =>   'required|unique:users|email|max:255'
			]);

		User::create([

				'username'   =>  $request->input('username'),
				
				'password'   =>  bcrypt($request->input('password')), 
				
				'email'      =>  $request->input('email')
			]);

			return redirect()
			->route('home')
			->with(
				'info',
				'Your account has created and you can sign in . '
			);
	}



	public function getSignin()
	{
		return view('auth.signin');		
	}
	public function postSignin(Request $request)
	{
		$this->validate($request, [
			
			'email'      =>   'required',

			'password'   =>   'required',
			
			]);
		if (!Auth::attempt($request->only(['email', 'password']), $request->has('remember'))){
			return redirect()->back()->with('info', 'Could not signed in you in with those details. ');
		}

		return redirect()->route('home')->with('info', 'You are now signed in');
	}

	public function getSignout()
	{
		Auth::logout();

		return redirect()->route('home'); 
	}

}
