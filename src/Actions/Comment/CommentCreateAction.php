<?php

namespace BalajiDharma\LaravelAdminCore\Actions\Comment;

use BalajiDharma\LaravelAdminCore\Data\Comment\CommentCreateData;
use BalajiDharma\LaravelComment\Models\Comment;

class CommentCreateAction
{
    public function handle(CommentCreateData $data)
    {
        return Comment::create([
            'content' => $data->getContent(),
            'commenter_type' => $data->getCommenterType(),
            'commenter_id' => $data->getCommenterId(),
            'commentable_type' => $data->getCommentableType(),
            'commentable_id' => $data->getCommentableId(),
            'parent_id' => $data->getParentId(),
            'status' => $data->getStatus(),
        ]);
    }
}
