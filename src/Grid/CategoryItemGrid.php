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
            [
                'attribute' => 'color',
                'label' => __('Color'),
                'type' => 'color',
                'value' => function ($model) {
                    return $model->color ? '<span class="badge w-10" style="background-color: '.$model->color.'">&nbsp;&nbsp;&nbsp;&nbsp;</span>' : '';
                },
                'form_options' => function ($model) {
                    return [
                        'value' => $model->color ?? '#ff0000',
                    ];
                },
            ],
            [
                'attribute' => 'image',
                'label' => __('Image'),
                'fillable' => true,
                'type' => 'file',
                'value' => function ($model) {
                    $media = $model->firstMedia('thumbnail');
                    if (! $media) {
                        return '';
                    }
                    return '<div class="avatar"><div class="w-32 rounded"><image src="'. asset('storage/'. $media->getDiskPath()) .'" alt="'.$media->alt.'"></div><div>';
                },
                'form_options' => function ($model) {
                    return [
                        'attr' => [
                            'accept' => 'image/*',
                        ],
                        'help_block' => [
                            'text' => 'The image must be a PNG, JPG, or GIF, and less than 2MB.',
                        ],
                    ];
                },
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
