<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'video_id', 'comment'];

    // Relationship: Each comment belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relationship: Each comment belongs to a video
    public function video()
    {
        return $this->belongsTo(Video::class, 'video_id');
    }
}
