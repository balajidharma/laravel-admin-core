<?php

namespace BalajiDharma\LaravelAdminCore\Grid;

use BalajiDharma\LaravelCategory\Models\CategoryType;

class GridHelper
{
    public static function getTagsField($attribute, $tagName, $options = [])
    {
        $label = $options['label'] ?? __('Tags');
        $list = $options['list'] ?? false;
        $fillable = $options['fillable'] ?? true;

        return [
            'attribute' => $attribute,
            'label' => $label,
            'list' => $list,
            'fillable' => $fillable,
            'value' => function ($model) use ($tagName) {
                return collect($model->getCategoriesByType($tagName)->get())->pluck('name')->implode(', ');
            },
            'form_options' => function ($model) use ($attribute, $tagName, $options) {
                $placeholder = $options['placeholder'] ?? 'Enter tag';
                $maxTags = $options['maxTags'] ?? 5;

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
                        'placeholder' => $placeholder,
                        'data-tagify-maxTags' => $maxTags,
                        'data-tagify-url' => route('admin.category.type.item.index', CategoryType::where('machine_name', $tagName)->first()->id),
                    ],
                ];
            },
        ];
    }

    public static function getTagsFieldWithDefault($attribute, $tagName, $options = [])
    {
        $label = $options['label'] ?? __('Tags');
        $list = $options['list'] ?? false;
        $fillable = $options['fillable'] ?? true;

        return [
            'attribute' => $attribute,
            'label' => $label,
            'list' => $list,
            'fillable' => $fillable,
            'value' => function ($model) use ($tagName) {
                return collect($model->getCategoriesByType($tagName)->get())->pluck('name')->implode(', ');
            },
            'form_options' => function ($model) use ($attribute, $tagName, $options) {
                $placeholder = $options['placeholder'] ?? 'Enter tag';
                $maxTags = $options['maxTags'] ?? 5;

                $oldValue = old($attribute);

                if ($oldValue) {
                    $decodedValue = json_decode($oldValue);
                    $value = $decodedValue ?
                        collect($decodedValue)->values()
                        : $oldValue;
                } else {
                    $value = $model ?
                        $model->getCategoriesByType($tagName)
                            ->get()
                            ->map(function ($category) {
                                return [
                                    'id' => $category->id,
                                    'value' => $category->name,
                                    'name' => $category->name,
                                    'weight' => $category->pivot->weight,
                                    'is_default' => (bool) $category->pivot->is_default
                                ];
                            })
                            ->sortByDesc('is_default')
                            ->values()
                        : '';
                }

                return [
                    'field_type' => 'text',
                    'value' => '',
                    'attr' => [
                        'data-tagify-with-default' => 1,
                        'placeholder' => $placeholder,
                        'data-tagify-maxTags' => $maxTags,
                        'data-tagify-value' => htmlspecialchars(json_encode($value), ENT_QUOTES, 'UTF-8'),
                        'data-tagify-whitelist' => htmlspecialchars(json_encode($value), ENT_QUOTES, 'UTF-8'),
                        'data-tagify-enforceWhitelist' => 1,
                        'data-tagify-url' => route('admin.category.type.item.index', CategoryType::where('machine_name', $tagName)->first()->id),
                    ],
                ];
            },
        ];
    }

    public static function getSelectTagFieldWithDefault($attribute, $tagName, $options = [])
    {
        $label = $options['label'] ?? __('Tags');
        $list = $options['list'] ?? false;
        $fillable = $options['fillable'] ?? true;

        return [
            'attribute' => $attribute,
            'label' => $label,
            'list' => $list,
            'fillable' => $fillable,
            'value' => function ($model) use ($tagName) {
                return collect($model->getCategoriesByType($tagName)->get())->pluck('name')->implode(', ');
            },
            'form_options' => function ($model) use ($attribute, $tagName, $options) {
                $placeholder = $options['placeholder'] ?? 'Enter tag';
                $maxTags = $options['maxTags'] ?? 5;

                $oldValue = old($attribute);

                if ($oldValue) {
                    $decodedValue = json_decode($oldValue);
                    $value = $decodedValue ?
                        collect($decodedValue)->values()
                        : $oldValue;
                } else {
                    $value = $model ?
                        $model->getCategoriesByType($tagName)
                            ->get()
                            ->map(function ($category) {
                                return [
                                    'id' => $category->id,
                                    'name' => $category->name,
                                    'value' => $category->id,
                                    'weight' => $category->pivot->weight,
                                    'is_default' => (bool) $category->pivot->is_default
                                ];
                            })
                            ->sortByDesc('is_default')
                            ->values()
                        : '';
                }

                return [
                    'field_type' => 'text',
                    'value' => '',
                    'attr' => [
                        'data-tagify-with-default' => 1,
                        'placeholder' => $placeholder,
                        'data-tagify-maxTags' => $maxTags,
                        'data-tagify-value' => htmlspecialchars(json_encode($value), ENT_QUOTES, 'UTF-8'),
                        'data-tagify-whitelist' => htmlspecialchars(json_encode($options['choices'])),
                        'data-tagify-enforceWhitelist' => 1,
                        'data-tagify-dropdown' => htmlspecialchars(json_encode([
                            'enabled' => 0,
                            'mapValueTo' => 'name',
                            'searchKeys' => ['name'],
                        ])),
                    ],
                ];
            },
        ];
    }
}
