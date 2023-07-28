<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;
use App\Models\Comment;

class CommentController extends Controller {
  
public function store(Video $video) {

    $data = request()->validate([
        'user_id' => 'required|int',
        'video_id' => 'required|int',
        'comment'   => 'required|string',
    ]);

    // Create a new comment for the given video using the relationship
    $video->comments()->create($data);

    // Redirect back to the video page or any other desired page
    return redirect()->back();
    
    }

}
