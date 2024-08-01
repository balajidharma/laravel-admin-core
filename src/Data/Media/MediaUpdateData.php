<?php

namespace BalajiDharma\LaravelAdminCore\Data\Media;

use Illuminate\Http\UploadedFile;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Support\Validation\ValidationContext;

class MediaUpdateData extends Data
{
    public function __construct(
        public UploadedFile $file,
        public string $type,
        public ?string $name,
        public ?string $alt,
    ) {}

    public static function rules(ValidationContext $context): array
    {
        return [
            'file' => 'required',
            'type' => 'required',
            'name' => 'max:255',
            'alt' => 'max:255',
        ];
    }

    public function getFile(): UploadedFile
    {
        return $this->file;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getAlt(): ?string
    {
        return $this->alt;
    }
}
