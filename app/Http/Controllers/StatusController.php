<?php

namespace Chatty\Http\Controllers;

use Auth;

use Chatty\Models\User;
use Chatty\Models\Status;
use Chatty\Http\Requests;
use Illuminate\Http\Request;
use Chatty\Http\Controllers\Controller;

class StatusController extends Controller
{
    public function postStatus(Request $request)
    {
        $this->validate($request, [
                'status' => 'required|max:1000',
            ]);

        Auth::user()->statuses()->create([
                'body' => $request->input('status'),
            ]);

        return redirect()
        ->route('home')
        ->with('info', 'Status Posted...');
    }

    public function postRaply(Request $request, $statusId)
    {
        dd($statusId);
    }
}
