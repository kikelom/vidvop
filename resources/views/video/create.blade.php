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

                    <h2>Upload Video</h2>
                    <form action="{{ route('video.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <label for="title">Title</label><br>
                        <input type="text" name="title" required>
                        <br><br>
                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}" required>
                    
                        <label for="producer">Producer</label><br>
                        <input type="text" name="producer">
                        <br><br>

                        <label for="genre">Genre</label><br>
                        <input type="text" name="genre">
                        <br><br>
                    
                        <label for="age_rating">Age Rating</label><br>
                        <input type="text" name="age_rating">
                        <br><br>
                    
                        <label for="video">Upload Video</label><br>
                        <input type="file" name="video" accept=".mp4" required>
                        <br>
                    
                        <br><button type="submit">Upload</button>
                    </form>   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection






