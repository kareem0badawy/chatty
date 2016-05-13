<?php

namespace Chatty\Http\Controllers;


use Illuminate\Http\Request;


use Auth;
use Chatty\Http\Requests;
use Chatty\Models\Status;
use Chatty\Http\Controllers\Controller;


class HomeController extends Controller
{

	public function index()
	{
		
		if (Auth::check()) {
			$statuses = Status::notReply()->where(function($query){
				return $query->where('user_id', Auth::user()->id)
				->orWhereIn('user_id', Auth::user()->friends()->lists('id')
					);
			})
			->orderBy('created_at', 'desc')
			->paginate(5);

			return view('timeline.index', compact('statuses'));
		}

		return view('home');
	}

}
