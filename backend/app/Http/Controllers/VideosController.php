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

    public function index()
    {
        $videos = Video::all();

        return response()->json([
            'mensaje' => 'Todos los videos',
            'videos' => $videos
        ]);
    }

    public function paginateVideo()
    {
        $videos = Video::paginate(1);
        return response()->json([
            'mensaje' => 'Pagina 1',
            'videos' => $videos
        ]);
    }

    public function saveVideo(VideoRequest $request)
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

    public function getVideoId($video_id)
    {
        $video = Video::find($video_id);

        if (!$video) {
            return response()->json([
                'video' => 'No Video'
            ]);
        }

        return response()->json([
            'Video' => $video
        ]);
    }
}
