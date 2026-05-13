<?php

namespace BalajiDharma\LaravelAdminCore\Actions\Media;

use BalajiDharma\LaravelAdminCore\Data\Media\MediaCreateData;
use BalajiDharma\LaravelMediaManager\MediaManager;

class MediaCreateAction
{
    protected MediaManager $mediaManager;

    public function __construct(MediaManager $mediaManager)
    {
        $this->mediaManager = $mediaManager;
    }

    public function handle(MediaCreateData $data)
    {
        $media = $this->mediaManager->createFromSource($data->getFile(), $data->getType(), $data->getName(), $data->getAlt());
        syncAdminTags($media, $data->getAdminTags());

        return $media;
    }
}
