@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h5 style="margin-top: 10px">Welcome, {{ Auth::user()->name }}! </h5></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h2>All Videos</h2>
                    <div class="videos-container">
                        @foreach($videos as $video)
                
                        <div class="video-wrapper">
                            <video controls>
                                <source src="{{ asset($video->file_path); }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                
                            <div class="comments">
                                <h5>Rating: {{ round($video->average_rating,1) ?? 'No ratings yet' }}</h5>
                                @auth
                                    <form action="{{ route('rating.store', $video->id) }}" method="POST">
                                        @csrf
                                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}" required>
                                            <input type="hidden" name="video_id" value="{{ $video->id }}" required>
                                            <select name="rating_value" id="rating" required>
                                                <option value="" disabled selected>Select a rating</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                            </select>
                                            <button style="display: inline;" type="submit">Submit Rating</button>
                                    </form>
                                @endauth

                                <hr style="border-bottom: 1px dashed grey"> 

                                <h5>Comments:</h5>
                                    @foreach ($video->comments as $comment)
                                        <div class="comment">
                                            <strong>{{ $comment->user->name }}</strong> - {{ $comment->comment }}
                                        </div>
                                     @endforeach
                                    <form action="{{ route('comment.store', $video->id) }}" method="POST">
                                        @csrf
                                        <div>
                                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}" required>
                                            <input type="hidden" name="video_id" value="{{ $video->id }}" required>
                                        </div>
                                        <div>
                                            <textarea name="comment" rows="3" placeholder="Your Comment" required></textarea>
                                        </div>
                                        <div>
                                            <button type="submit">Submit Comment</button>
                                        </div>
                                    </form>
                            </div>
                            <hr style="border-bottom: 4px solid blue; margin:40px 0;">
                        @endforeach

                         
                    </div>    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



