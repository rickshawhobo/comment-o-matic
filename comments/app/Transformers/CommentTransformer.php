<?php
namespace App\Transformers;

use App\Models\Comment;
use League\Fractal\TransformerAbstract;

class CommentTransformer extends TransformerAbstract
{

    protected $availableIncludes = [
        'user',
        'tags'
    ];
    protected $defaultIncludes = [
        'user',
        'tags',
    ];

    public function transform(Comment $comment) {

        return [
            'id' => $comment->id,
            'body' => $comment->body,
            'created' => $comment->created_at->toIso8601String(),
            'updated' => $comment->updated_at->toIso8601String(),

        ];

    }

    public function includeUser(Comment $comment)
    {
        return $this->item($comment->user, new UserTransformer());
    }
    public function includeTags(Comment $comment)
    {
        return $this->collection($comment->tags, new TagTransformer());
    }
}
