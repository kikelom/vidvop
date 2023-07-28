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

                    
                </div>

                <nav>
                    <ul style="list-style-type: none">
                        @if(auth()->user()->role == 'admin')
                        <li><a style="text-decoration: none; font-size:20px; padding:20px;" href=""> Enroll Creator</a> </li>
                        <li><a style="text-decoration: none; font-size:20px; padding:20px;" href="{{ route('video.index') }}"> See Videos</a></li>
                        <li><a style="text-decoration: none; font-size:20px; padding:20px;" href="{{ route('video.create') }}"> Create Video</a></li>
                        @endif
                        
                        @if(auth()->user()->role == 'creator')
                        <li><a style="text-decoration: none; font-size:20px; padding:20px;" href="{{ route('video.index') }}"> See Videos</a></li>
                        <li><a style="text-decoration: none; font-size:20px; padding:20px;" href="{{ route('video.create') }}"> Create Video</a></li>
                        @endif

                        @if(auth()->user()->role == 'consumer')
                        <li><a style="text-decoration: none; font-size:20px; padding:20px;" href="{{ route('video.index') }}"> See Videos</a></li>
                        @endif
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection
