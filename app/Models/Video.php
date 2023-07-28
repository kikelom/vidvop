<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'file_path', 'user_id', 'producer', 'genre', 'age_rating', 'upload_date'];

    // Relationship: Each video belongs to a user (as a creator)
    public function publisher()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relationship: One video can have many comments
    public function comments()
    {
        return $this->hasMany(Comment::class, 'video_id');
    }

    // Relationship: One video can have many ratings
    public function ratings()
    {
        return $this->hasMany(Rating::class, 'video_id');
    }
}
