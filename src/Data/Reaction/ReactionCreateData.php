<?php

namespace BalajiDharma\LaravelAdminCore\Data\Reaction;

use BalajiDharma\LaravelAdminCore\Data\BaseData;
use Spatie\LaravelData\Support\Validation\ValidationContext;

class ReactionCreateData extends BaseData
{
    public function __construct(
        public ?string $reaction_type,
        public ?string $reaction_name,
        public ?int $rate,
        public ?string $reactor_type,
        public ?int $reactor_id,
        public ?string $reactable_type,
        public ?int $reactable_id,
    ) {}

    public static function rules(ValidationContext $context): array
    {
        return [
            'reaction_type' => 'required',
            'reaction_name' => 'required',
            'reactor_type' => 'required',
            'reactor_id' => 'required',
            'reactable_type' => 'required',
            'reactable_id' => 'required',
        ];
    }

    public function getReactionType(): ?string
    {
        return $this->reaction_type;
    }

    public function getReactionName(): ?string
    {
        return $this->reaction_name;
    }

    public function getRate(): ?int
    {
        return $this->rate;
    }

    public function getReactorType(): ?string
    {
        return $this->reactor_type;
    }

    public function getReactorId(): ?int
    {
        return $this->reactor_id;
    }

    public function getReactableType(): ?string
    {
        return $this->reactable_type;
    }

    public function getReactableId(): ?int
    {
        return $this->reactable_id;
    }
}
