<?php

namespace BalajiDharma\LaravelAdminCore\Grid;

use BalajiDharma\LaravelCategory\Models\CategoryType;

class GridHelper
{
    public static function getTagsField($attribute, $tagName)
    {
        return [
            'attribute' => $attribute,
            'label' => __('Tags'),
            'list' => false,
            'fillable' => true,
            'value' => function ($model) use ($tagName) {
                return collect($model->getCategoriesByType($tagName)->get())->pluck('name')->implode(', ');
            },
            'form_options' => function ($model) use ($attribute, $tagName) {
                if (old($attribute)) {
                    if (json_decode(old($attribute))) {
                        $value = collect(json_decode(old($attribute)))->pluck('value')->implode(',');
                    } else {
                        $value = old($attribute);
                    }
                } else {
                    $value = $model ? collect($model->getCategoriesByType($tagName)->get())->pluck('name')->implode(', ') : '';
                }
        
                return [
                    'field_type' => 'text',
                    'value' => $value,
                    'attr' => [
                        'data-tagify' => 1,
                        'placeholder' => 'Enter tag',
                        'data-tagify-maxTags' => 5,
                        'data-tagify-url' => route('admin.category.type.item.index', CategoryType::where('machine_name', $tagName)->first()->id),
                    ],
                ];
            },
        ];
    }
}