<?php

namespace BalajiDharma\LaravelAdminCore\Grid;

use BalajiDharma\LaravelAttributes\Models\Attribute;
use BalajiDharma\LaravelCrud\CrudBuilder;

class AttributeGrid extends CrudBuilder
{
    public $title = 'Attributes';

    public $description = 'Manage Attributes';

    public $model = Attribute::class;

    public $route = 'admin.attribute';

    public function columns()
    {
        $type = collect(config('attributes.data_types'))->pluck('type', 'type')->toArray();

        return [
            [
                'attribute' => 'id',
                'label' => __('ID'),
                'sortable' => true,
                'searchable' => true,
                'filter' => '=',
                'form_options' => function ($model) {
                    return [
                        'hide' => true,
                    ];
                },
            ],
            [
                'attribute' => 'attributable_type',
                'label' => __('Attributable Type'),
                'type' => 'select',
                'list' => false,
                'form_options' => function ($model) {
                    $attributable_type = [
                        'BalajiDharma\LaravelForum\Models\Thread' => __('Thread'),
                    ];

                    return [
                        'choices' => $attributable_type,
                        'empty_value' => __('Select an option'),
                        'default_value' => $model ? $model->attributable_type : null,
                    ];
                },
            ],
            [
                'attribute' => 'attributable_id',
                'label' => __('Attributable ID'),
                'list' => false,
            ],
            [
                'attribute' => 'data_type',
                'label' => __('Type'),
                'type' => 'select',
                'fillable' => true,
                'sortable' => true,
                'filter' => '=',
                'filter_options' => $type,
                'value' => function ($model) {
                    return $model->data_type;
                },
                'form_options' => function ($model) use ($type) {
                    return [
                        'choices' => $type,
                        'default_value' => $model ? $model->data_type : 'string',
                    ];
                },
            ],
            [
                'attribute' => 'name',
                'label' => __('Name'),
                'sortable' => true,
                'filter' => 'like',
                'searchable' => true,
            ],
            [
                'attribute' => 'value',
                'label' => __('Value'),
                'sortable' => true,
                'filter' => 'like',
                'searchable' => true,
            ],
            [
                'attribute' => 'created_at',
                'label' => __('Created At'),
                'sortable' => true,
                'filter' => 'between',
                'fillable' => false,
            ],
            [
                'attribute' => 'updated_at',
                'sortable' => true,
            ],
        ];
    }
}
