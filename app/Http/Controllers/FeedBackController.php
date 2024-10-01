<?php

namespace App\Http\Controllers;

use App\Models\Feed;
use Illuminate\Http\Request;

class FeedBackController extends Controller
{
    public function create()
    {
        return view('user.feedBack');
    }

    public function store(Request $request)
    {

        // Validate the request
        $validatedData = $request->validate([
            'email' => 'required|email',
            'comment' => 'required|string',
        ]);

        Feed::create($validatedData);

        return redirect()->back()->with('success', 'Thank you for your feedback!');
    }

    public function view_admin()
    {
        $feedBacks = Feed::all();

        return view('admin.feeds', compact('feedBacks'));
    }
}
