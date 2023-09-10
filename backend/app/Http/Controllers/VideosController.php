<?php

namespace App\Http\Controllers;

use App\Http\Requests\VideoRequest;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class VideosController extends Controller
{
    public function video(VideoRequest $request)
    {
        $user = Auth::user();

        $image = $request->file('image');
        if ($image) {
            $image_path = time() . $image->getClientOriginalName();
            Storage::disk('images')->put($image_path, File::get($image));
        }

        $video_file = $request->file('video');
        if ($video_file) {
            $video_path = time() . $video_file->getClientOriginalName();
            Storage::disk('videos')->put($video_path, File::get($video_file));
        }

        $video = Video::create([
            'user_id' => $user->id,
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status == null ? 1 : $request->status,
            'image' => $image_path,
            'video_path' => $video_path
        ]);

        return response()->json([
            'video' => $video
        ]);
    }
}
