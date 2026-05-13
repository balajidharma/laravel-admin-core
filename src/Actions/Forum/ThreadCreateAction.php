<?php

namespace BalajiDharma\LaravelAdminCore\Actions\Forum;

use BalajiDharma\LaravelAdminCore\Data\Forum\ThreadCreateData;
use BalajiDharma\LaravelForum\Models\Thread;

class ThreadCreateAction
{
    public function handle(ThreadCreateData $data)
    {
        $thread = Thread::create([
            'title' => $data->getTitle(),
            'slug' => $data->getSlug(),
            'content' => $data->getContent(),
            'author_type' => $data->getAuthorType(),
            'author_id' => $data->getAuthorId(),
            'status' => $data->getStatus(),
        ]);

        $thread->syncCategories([$data->getCategoryId()], config('forum.category_name'));

        $thread->syncTags($data->getTags(), config('forum.tag_name'));

        return $thread;
    }
}
