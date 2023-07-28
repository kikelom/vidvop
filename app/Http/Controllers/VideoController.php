<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::with('comments', 'ratings')->get();

        // Calculate average ratings for each video
        foreach ($videos as $video) {
            $video->average_rating = $video->ratings->avg('rating_value');
        }
        return view('video.index', compact('videos'));
    }

    public function create()
    {
        return view('video.create');
    }

    public function store(Request $request)
    {
        // Check if the authenticated user has the 'creator' role
        if (!auth()->user()->role == 'creator') {
            return redirect()->route('home')->with('error', 'You do not have permission to create videos.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'user_id' => 'required|int|max:255',
            'producer' => 'nullable|string|max:255',
            'genre' => 'nullable|string|max:255',
            'age_rating' => 'nullable|string|max:10',
            'video' => 'required|mimes:mp4|max:50000', // Adjust max file size as needed
        ]);

        $video = $request->file('video');
        $filePath = $video->store('videos', 'videos'); // Store the video file in the 'videos' disk

        Video::create([
            'title' => $request->title,
            'user_id' => $request->user_id,
            'producer' => $request->producer,
            'genre' => $request->genre,
            'age_rating' => $request->age_rating,
            'file_path' => $filePath,
        ]);

        return redirect()->route('video.index')->with('success', 'Video uploaded successfully.');
    }
}
