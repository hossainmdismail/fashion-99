<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Comments;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        // dd($request->comment);
        $request->validate([
            'name'         => 'required',
            'number' => ['required', 'regex:/^(01[3-9]\d{8,})$/', 'min:10'],
            'comment'      => 'required',
        ], [
            'number.regex' => 'The phone number format is invalid. Please enter a valid Bangladeshi phone number.',
            'number.min'   => 'The phone number must be at least 10 digits.',
        ]);

        $review = new Comments();
        $review->product_id = $request->product_id;
        $review->comment    = $request->comment;
        $review->rating     = $request->rating == null ? 1 : $request->rating;
        $review->name       = $request->name;
        $review->email      = $request->email;
        $review->number     = $request->number;
        $review->save();

        return back()->with('succ', 'We appreciate your feedback and will review it shortly.');
    }
}
