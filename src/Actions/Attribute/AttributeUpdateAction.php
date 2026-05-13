<?php

namespace BalajiDharma\LaravelAdminCore\Actions\Attribute;

use BalajiDharma\LaravelAdminCore\Data\Attribute\AttributeUpdateData;
use BalajiDharma\LaravelAttributes\Models\Attribute;

class AttributeUpdateAction
{
    public function handle(AttributeUpdateData $data, Attribute $attribute)
    {
        return $attribute->update(
            [
                'data_type' => $data->getDataType(),
                'name' => $data->getName(),
                'value' => $data->getValue(),
                'weight' => $data->getWeight(),
                'attributable_type' => $data->getAttributableType(),
                'attributable_id' => $data->getAttributableId(),
            ]
        );
    }
}
