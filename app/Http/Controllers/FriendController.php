<?php

namespace Chatty\Http\Controllers;

use Illuminate\Http\Request;


use Auth;
use Chatty\Models\User;
use Chatty\Http\Requests;
use Chatty\Http\Controllers\Controller;

class FriendController extends Controller
{
    public function getIndex()
    {
    	$friends   = Auth::user()->friends();
    	$requests  = Auth::user()->friendRequestes();
    	return view('friends.index', compact('friends','requests'));
    }

    public function getAdd($username)
    {
    	$user = User::where('username', $username)->first();
    
    	if (!$user)
    	{
    		return redirect()
    			->route('home')
                ->with('info', 'That user could not be found');
    	}

        if (Auth::user()->id === $user->id) {
            return redirect()->route('home');
        }

    	if (Auth::user()->hasFriendRequestesPending($user) || $user->
    		hasFriendRequestesPending(Auth::user())) {
    			
			return redirect()
				->route('profile.index', ['username'=> $user->username])
				->with('info', 'Friend request already pending');
		}

		if (Auth::user()->isFriendWith($user)) {
    			
			return redirect()
				->route('profile.index', ['username'=> $user->username])
				->with('info', 'You are already friends.');
		}

		Auth::user()->addFriend($user);

		return redirect()
			->route('profile.index', ['username'=> $user->username])
			->with('info', 'Friend request sent.');
    }
    public function getAccept($username)
    {
    	$user = User::where('username', $username)->first();
    
    	if (!$user){
    		return redirect()
    			->route('home')
    			->with('info', 'That user could not be found');
    		}

    	if (!Auth::user()->hasFriendRequestesReceived($user)) {
    		return redirect()->route('home');
    	}

    	Auth::user()->acceptFriendRequestes($user);

		return redirect()
			->route('profile.index', ['username'=> $username])
			->with('info', 'Friend Request Accepted.');
    }

}
