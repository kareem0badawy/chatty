<?php

namespace Chatty\Http\Controllers;

use DB;
use Chatty\Models\User;
use Chatty\Http\Requests;
use Illuminate\Http\Request;
use Chatty\Http\Controllers\Controller;

class SearchController extends Controller
{
    public function getResults(Request $request)
    {
    	$query = $request->input('query');

    	if (!$query) {
    		return redirect()->route('home');
    	}

    	$users = User::where(DB::raw("CONCAT(first_name, ' ', last_name)"),
    	 'LIKE', "%{$query}%")
    	->orWhere('username', 'LIKE', "%{$query}%")
    	->get();

    	return view('search.results',compact('users'));
    }
}
