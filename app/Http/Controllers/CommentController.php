<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bb;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    private const COMMENT_VALIDATOR = [
        'content'=>'required|string'
    ];

    public function store(Bb $bb,Request $request){
        $validated = $request->validate(self::COMMENT_VALIDATOR);
        $bb->comments()->create([
            'user_id' => Auth::id(),
            'bb_id'=>$bb->id,
            'content' => $validated['content'],
        ])
        ->save();
        return redirect()->back();
    }
    public function edit()
    {
        return view('comment.edit');
    }
}
