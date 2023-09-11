<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentsRequest;
use App\Models\Comment;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    public function store(CommentsRequest $request)
    {
        $user = Auth::user();

        $video = Video::find($request->input('video_id'));

        if (!$video) {
            return response()->json([
                'error' => 'El video con el ID proporcionado no existe.'
            ], 404);
        }

        $comment = Comment::create([
            'user_id' => $user->id,
            'video_id' => $request->input('video_id'),
            'body' => $request->body
        ]);

        return response()->json([
            'comment' => $comment
        ]);
    }

    public function deleteComments($id)
    {
        $user = Auth::user();
        $comment = Comment::find($id);

        if(!$comment){
            return response()->json([
                'msg' => 'No Comment'
            ],404);
        }


        if($user && ($comment->user_id == $user->id || $comment->video->user_id == $user->id )){
            $comment->delete();
        }

        return response()->json([
            'msg' => 'Comment Delete'
        ]);

    }
}
