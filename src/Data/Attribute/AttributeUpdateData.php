<?php

namespace BalajiDharma\LaravelAdminCore\Data\Attribute;

use BalajiDharma\LaravelAdminCore\Data\BaseData;
use Spatie\LaravelData\Support\Validation\ValidationContext;
use Illuminate\Validation\Rule;

class AttributeUpdateData extends BaseData
{
    public function __construct(
        public string $data_type,
        public string $name,
        public ?string $value,
        public ?int $weight,
        public string $attributable_type,
        public int $attributable_id,
    ) {}

    public static function rules(ValidationContext $context): array
    {
        $id = request()->route('attribute')->id;
        return [
            'data_type' => 'required',
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique(config('attributes.table_names.attributes', 'attributes'))
                    ->where(function ($query) {
                        return $query->where('attributable_type', request()->attributable_type)
                                   ->where('attributable_id', request()->attributable_id);
                    })
                    ->ignore($id)
            ],
            'attributable_type' => 'required',
            'attributable_id' => 'required',
        ];
    }

    public function getDataType(): string
    {
        return $this->data_type;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function getWeight(): ?int
    {
        return $this->weight;
    }

    public function getAttributableType(): string
    {
        return $this->attributable_type;
    }

    public function getAttributableId(): int
    {
        return $this->attributable_id;
    }

}