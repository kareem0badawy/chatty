<?php

namespace Chatty\Http\Controllers;


use Illuminate\Http\Request;


use Auth;
use Chatty\Http\Requests;
use Chatty\Http\Controllers\Controller;


class HomeController extends Controller
{

	public function index()
	{
		
		if (Auth::check()) {
			return view('timeline.index');
		}

		return view('home');
	}

}
