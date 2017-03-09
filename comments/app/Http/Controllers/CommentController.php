<?php
namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Tag;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;

class CommentController extends Controller
{


    /**
     * @api {get} /api/comments List comments
     * @apiDescription Get all comments owned by the authenticated user
     * @apiName ListComments
     * @apiGroup Comments
     *
     * @apiSuccess {CommentObject} data The collection of found comments
     */

    public function index(Request $request)
    {

        return $request->user()->comments;

    }

    /**
     * @api {post} /api/comments Create comments
     * @apiDescription Create a new comment
     * @apiName CreateComment
     * @apiGroup Comments
     *
     * @apiParam {String} body The body of the comment
     * @apiParam {String} tags The list of tags, separted by commas

     * @apiSuccess {CommentObject} data The newly created comment object
     */

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

    /**
     * @api {get} /api/comments/:id Fetch a comment
     * @apiDescription Fetch a singular comment, requires the authenticated user to own the comment
     * @apiName GetComment
     * @apiGroup Comments
     *
     * @apiSuccess {CommentObject} data The found comment object
     */

    public function show(Request $request, $commentId)
    {

        $comment = Comment::findOrFail($commentId);
        if ($comment->user->id !== $request->user()->id) {
            throw new AuthorizationException();
        }
        return $comment;

    }

    /**
     * @api {delete} /api/comments/:id Delete a comment
     * @apiDescription Delete a comment that's owned by the authenticated user
     * @apiName DeleteComment
     * @apiGroup Comments
     *
     * @apiSuccess {CommentObject} data The found comment object
     */

    public function destroy(Request $request, $commentId)
    {

        $comment = Comment::findOrFail($commentId);
        if ($comment->user->id !== $request->user()->id) {
            throw new AuthorizationException();
        }
        $comment->delete();

        return $comment;
    }

    /**
     * @api {patch} /api/comments/:id Update a comment
     * @apiDescription Updates a comment that's owned by the authenticated user
     * @apiName UpdateComment
     * @apiGroup Comments
     *
     * @apiSuccess {CommentObject} data The found comment object
     */
    public function update(Request $request, $commentId)
    {

        $comment = Comment::findOrFail($commentId);
        if ($comment->user->id !== $request->user()->id) {
            throw new AuthorizationException();
        }

        if ($request->exists('tags')) {
            $tagIds = [];

            $tags = explode(",", $request->input('tags'));
            foreach ($tags as $tag) {
                $tagIds[] = Tag::firstOrCreate(['name' => $tag])->id;
            }
            $comment->tags()->sync($tagIds);
        }

        $comment->body = $request->input('body');
        $comment->save();

        return $comment;
    }

}