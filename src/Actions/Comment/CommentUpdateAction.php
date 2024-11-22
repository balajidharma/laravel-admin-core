<?php

namespace BalajiDharma\LaravelAdminCore\Actions\Comment;

use BalajiDharma\LaravelAdminCore\Data\Comment\CommentUpdateData;
use BalajiDharma\LaravelComment\Models\Comment;

class CommentUpdateAction
{
    public function handle(CommentUpdateData $data, Comment $comment): Comment
    {
        $comment->update([
            'content' => $data->getContent(),
            'commenter_type' => $data->getCommenterType(),
            'commenter_id' => $data->getCommenterId(),
            'commentable_type' => $data->getCommentableType(),
            'commentable_id' => $data->getCommentableId(),
            'parent_id' => $data->getParentId(),
            'status' => $data->getStatus(),
        ]);

        return $comment;
    }
}
