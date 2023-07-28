<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'video_id', 'rating_value'];

    // Relationship: Each rating belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relationship: Each rating belongs to a video
    public function video()
    {
        return $this->belongsTo(Video::class, 'video_id');
    }
}
