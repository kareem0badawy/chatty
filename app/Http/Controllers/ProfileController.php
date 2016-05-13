<?php

namespace Chatty\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Auth;
use Chatty\Models\User;
use Chatty\Http\Requests;
use Chatty\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function getProfile($username)
    {	
    	$user = User::where('username', $username)->first();
        $statuses = $user->statuses()->notReply()->get();
    	if (!$user) {
    		abort(404);
    	}
    	return view('profile.index', compact('user','statuses'))
        ->with('authUserIsFriend' , Auth::user()->isFriendWith($user));
    }

    public function getEdit()
    {
    	return view('profile.edit');
    }

    public function postEdit(Request $request)
    {
    	$this->validate($request, [

    		'first_name'    =>   'alpha|max:50',

			'last_name'     =>   'alpha|max:50',
			
			'location'      =>   'max:20'
			
			]);
        Auth::user()->update([
            'first_name'    =>   $request->input('first_name'),

            'last_name'     =>   $request->input('last_name'), 
            
            'location'      =>   $request->input('location')
            ]);

            return redirect()
            ->route('profile.edit')
            ->with('info', 'Your profile has been updated.' );
    }
}
