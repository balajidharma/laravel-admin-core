<?php

namespace BalajiDharma\LaravelAdminCore\Grid;

use BalajiDharma\LaravelCategory\Models\Category;
use BalajiDharma\LaravelCrud\CrudBuilder;

class CategoryItemGrid extends CrudBuilder
{
    public $title = 'Categories';

    public $description = 'Manage Categories';

    public $model = Category::class;

    public $route = 'admin.category.type.item';

    public function columns()
    {
        return [
            [
                'attribute' => 'name',
                'label' => __('Name'),
                'sortable' => true,
                'filter' => 'like',
                'searchable' => true,
            ],
            [
                'attribute' => 'slug',
                'label' => __('Slug'),
                'type' => 'text',
                'form_options' => function ($model) {
                    return [
                        'help_block' => [
                            'text' => 'The “slug” is the URL-friendly version of the name. It is usually all lowercase and contains only letters, numbers, and hyphens.',
                        ],
                    ];
                },
            ],
            [
                'attribute' => 'description',
                'label' => __('Description'),
                'list' => false,
            ],
            [
                'attribute' => 'enabled',
                'label' => __('Enabled'),
                'type' => 'checkbox',
                'value' => function ($model) {
                    return $model->enabled ? 'Yes' : 'No';
                },
                'form_options' => function ($model) {
                    return [
                        'value' => 1,
                        'default_value' => 1,
                    ];
                },
            ],
            [
                'attribute' => 'parent_id',
                'label' => __('Parent Item'),
                'type' => 'choice',
                'form_options' => function ($model) {
                    $item_options = Category::selectOptions($this->addtional['type']->id, null, true);

                    return [
                        'choices' => $item_options,
                        'label' => __('Parent Item'),
                        'selected' => $this->model->parent_id ?? null,
                        'empty_value' => '-ROOT-',
                        'hide' => $this->addtional['type']->is_flat ? true : false,
                        'help_block' => [
                            'text' => 'The maximum depth for a link and all its children is fixed. Some type links may not be available as parents if selecting them would exceed this limit.',
                        ],
                    ];
                },
                'list' => false,
            ],
            [
                'attribute' => 'weight',
                'label' => __('Weight'),
                'type' => 'number',
                'form_options' => function ($model) {
                    return [
                        'wrapper' => ['class' => 'form-control py-2 w-40'],
                    ];
                },
                'list' => false,
            ],
            GridHelper::getTagsField('admin_tags', config('admin.tag_name')),
            [
                'attribute' => 'created_at',
                'sortable' => true,
                'list' => false,
            ],
            [
                'attribute' => 'updated_at',
                'sortable' => true,
                'list' => false,
            ],
        ];
    }

    public function buildRoutes($mainRoute = null)
    {
        if (! $mainRoute) {
            $routeName = request()->route()->getName();
            $mainRoute = substr($routeName, 0, strrpos($routeName, '.'));
        }

        return [
            'index' => route($mainRoute.'.index', ['type' => $this->addtional['type']->id]),
            'create' => route($mainRoute.'.create', ['type' => $this->addtional['type']->id]),
            'store' => route($mainRoute.'.store', ['type' => $this->addtional['type']->id]),
            'edit' => function ($id) use ($mainRoute) {
                return route($mainRoute.'.edit', ['type' => $this->addtional['type']->id, 'item' => $id]);
            },
            'update' => function ($id) use ($mainRoute) {
                return route($mainRoute.'.update', ['type' => $this->addtional['type']->id, 'item' => $id]);
            },
            'show' => function ($id) use ($mainRoute) {
                return route($mainRoute.'.show', ['type' => $this->addtional['type']->id, 'item' => $id]);
            },
            'destroy' => function ($id) use ($mainRoute) {
                return route($mainRoute.'.destroy', ['type' => $this->addtional['type']->id, 'item' => $id]);
            },
        ];
    }
}
