<?php

namespace BalajiDharma\LaravelAdminCore\Data\Comment;

use BalajiDharma\LaravelAdminCore\Data\BaseData;
use Spatie\LaravelData\Support\Validation\ValidationContext;

class CommentCreateData extends BaseData
{
    public function __construct(
        public string $content,
        public ?string $commenter_type,
        public ?int $commenter_id,
        public ?string $commentable_type,
        public ?int $commentable_id,
        public ?int $parent_id,
        public ?int $status
    ) {}

    public static function rules(ValidationContext $context): array
    {
        return [
            'content' => 'required',
        ];
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function getCommenterType(): ?string
    {
        return $this->commenter_type;
    }

    public function getCommenterId(): ?int
    {
        return $this->commenter_id;
    }

    public function getCommentableType(): ?string
    {
        return $this->commentable_type;
    }

    public function getCommentableId(): ?int
    {
        return $this->commentable_id;
    }

    public function getParentId(): ?int
    {
        return $this->parent_id;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }
}
