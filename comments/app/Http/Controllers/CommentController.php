<?php
namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Tag;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    public function index(Request $request)
    {

        return $request->user()->comments;

    }

    public function store(Request $request)
    {

        $user = $request->user();

        $comment = new Comment();

        $comment->body = $request->input('body');
        $comment->user()->associate($user);
        $comment->save();

        $tagIds = [];

        if ($request->input('tags', false)) {
            $tags = explode(",", $request->input('tags'));
            foreach ($tags as $tag) {
                $tagIds[] = Tag::firstOrCreate(['name' => $tag])->id;
            }
            $comment->tags()->sync($tagIds);
        }
        return $comment;
    }
    public function show(Request $request, $commentId)
    {

        $comment = Comment::findOrFail($commentId);
        if ($comment->user->id !== $request->user()->id) {
            throw new AuthorizationException();
        }
        return $comment;

    }
}