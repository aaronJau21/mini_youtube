<?php

namespace App\Models;

use App\Enums\VideosStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'status',
        'image',
        'video_path'
    ];

    protected $casts = ['status' => VideosStatusEnum::class];

    // One to Many
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // One to One
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
