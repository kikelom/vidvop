<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;
use App\Models\Rating;

class RatingController extends Controller
{
    public function store(Video $video)
{
    $data = request()->validate([
        'user_id' => 'required|int',
        'video_id' => 'required|int',
        'rating_value' => 'required|integer|min:1|max:5',
    ]);

    // Create a new rating for the given video and authenticated user
    $video->ratings()->create($data);

    // Redirect back to the video page or any other desired page
    return redirect()->back();
}
}
