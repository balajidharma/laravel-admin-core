<?php

namespace BalajiDharma\LaravelAdminCore\Data;

use Spatie\LaravelData\Data;

class BaseData extends Data
{
    public ?string $admin_tags;

    public ?string $tags;

    public function getAdminTags(): string|array
    {
        if (json_decode($this->admin_tags)) {
            return collect(json_decode($this->admin_tags))->pluck('value')->toArray();
        } else {
            return explode(',', $this->admin_tags);
        }
    }

    public function getTags(): string|array
    {
        if (json_decode($this->tags)) {
            return collect(json_decode($this->tags))->pluck('value')->toArray();
        } else {
            return explode(', ', $this->tags);
        }
    }
}
