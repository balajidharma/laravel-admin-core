<?php

namespace BalajiDharma\LaravelAdminCore\Data\Media;

use Illuminate\Support\Carbon;
use Plank\Mediable\Media;
use Spatie\LaravelData\Data;

#[MapOutputName(SnakeCaseMapper::class)]
class MediaData extends Data
{
    public function __construct(
        public int $id,
        public string $disk,
        public string $directory,
        public string $filename,
        public string $extension,
        public string $mimeType,
        public string $aggregateType,
        public int $size,
        public string $variantName,
        public ?Carbon $createdAt,
        public ?Carbon $updatedAt,
        public ?string $basename,
        public string $alt,
        public string $url,
        public bool $isOriginal,
        public bool $isVariant,
        public ?string $mediaTypeIcon = null,
    ) {}

    public static function fromModel(Media $media): self
    {
        return new self(
            $media->id,
            $media->disk,
            $media->directory,
            $media->filename,
            $media->extension,
            $media->mime_type,
            $media->aggregate_type,
            $media->size,
            $media->variant_name,
            $media->created_at,
            $media->updated_at,
            $media->basename,
            $media->alt,
            $media->getUrl(),
            $media->isOriginal(),
            $media->isVariant(),
            media_type_icon($media)
        );
    }

    public function with(): array
    {
        return [
            'type' => $this->variantName,
        ];
    }
}
