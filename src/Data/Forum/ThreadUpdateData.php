<?php

namespace BalajiDharma\LaravelAdminCore\Data\Forum;

use BalajiDharma\LaravelAdminCore\Data\BaseData;
use Spatie\LaravelData\Support\Validation\ValidationContext;

class ThreadUpdateData extends BaseData
{
    public function __construct(
        public string $title,
        public ?string $slug,
        public ?string $content,
        public ?int $category_id,
        public ?string $author_type,
        public ?int $author_id,
        public ?int $status
    ) {}

    public static function rules(ValidationContext $context): array
    {
        return [
            'category_id' => 'required',
            'title' => 'required|max:255',
            'content' => 'required',
        ];
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function getAuthorType(): ?string
    {
        return $this->author_type;
    }

    public function getAuthorId(): ?string
    {
        return $this->author_id;
    }

    public function getCategoryId(): ?string
    {
        return $this->category_id;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }
}
