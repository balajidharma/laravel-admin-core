<?php

namespace BalajiDharma\LaravelAdminCore\Actions\Attribute;

use BalajiDharma\LaravelAdminCore\Data\Attribute\AttributeCreateData;
use BalajiDharma\LaravelAttributes\Models\Attribute;

class AttributeCreateAction
{
    public function handle(AttributeCreateData $data)
    {
        return Attribute::create([
            'data_type' => $data->getDataType(),
            'name' => $data->getName(),
            'value' => $data->getValue(),
            'weight' => $data->getWeight(),
            'attributable_type' => $data->getAttributableType(),
            'attributable_id' => $data->getAttributableId(),
        ]);
    }
}
