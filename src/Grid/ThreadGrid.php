<?php

namespace BalajiDharma\LaravelAdminCore\Grid;

use BalajiDharma\LaravelForum\Models\Thread;
use BalajiDharma\LaravelCategory\Models\CategoryType;
use BalajiDharma\LaravelCategory\Models\Category;
use BalajiDharma\LaravelCrud\CrudBuilder;

class ThreadGrid extends CrudBuilder
{
    public $title = 'Threads';

    public $description = 'Manage Threads';

    public $model = Thread::class;

    public $route = 'admin.thread';

    public function columns()
    {
        $type = CategoryType::where('machine_name', config('forum.category_name'))->first();
        $categories = $type ? Category::selectOptions($type->id) : [];
        return [
            [
                'attribute' => 'id',
                'label' => __('ID'),
                'sortable' => true,
                'searchable' => true,
                'filter' => '=',
                'list' => [
                    'class' => 'BalajiDharma\LaravelCrud\Column\LinkColumn',
                    'route' => 'admin.thread.show',
                    'route_params' => ['thread' => 'id'],
                    'attr' => ['class' => 'link link-primary'],
                ],
            ],
            [
                'attribute' => 'category_id',
                'label' => __('Category'),
                'type' => 'select',
                'fillable' => true,
                'sortable' => true,
                'filter' => '=',
                'filter_options' => $categories,
                'relation' => 'modelCategories',
                'relation_field' => 'id',
                'value' => function ($model) {
                    return $model ? optional($model->getCategoriesByType(config('forum.category_name'))->first())->name : null;
                },
                'form_options' => function ($model) use ($categories) {
                    return [
                        'choices' => $categories,
                        'empty_value' => __('Select an option'),
                        'selected' => $model ? optional($model->getCategoriesByType(config('forum.category_name'))->first())->id : null,
                        'attr' => [
                            'data-choices' => '1',
                        ],
                    ];
                },
            ],
            [
                'attribute' => 'title',
                'label' => __('Title'),
                'sortable' => true,
                'filter' => 'like',
                'searchable' => true,
                'list' => [
                    'class' => 'BalajiDharma\LaravelCrud\Column\LinkColumn',
                    'route' => 'admin.thread.show',
                    'route_params' => ['thread' => 'id'],
                    'attr' => ['class' => 'link link-primary'],
                ],
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
                'attribute' => 'content',
                'label' => __('Content'),
                'filter' => 'like',
                'form_options' => function ($model) {
                    return [
                        'field_type' => 'textarea',
                        'attr' => [
                            'rows' => 5
                        ]
                    ];
                },
            ],
            [
                'attribute' => 'author_type',
                'label' => __('Author Type'),
                'type' => 'select',
                'list' => true,
                'show' => true,
                'form_options' => function ($model) {
                    $author_type = [
                        'App\Models\User' => __('User'),
                    ];
                    
                    return [
                        'choices' => $author_type,
                        'empty_value' => __('Select an option'),
                        'default_value' => $model ? $model->author_type : null,
                    ];
                },
            ],
            [
                'attribute' => 'author_id',
                'label' => __('Author ID'),
                'list' => false,
                'show' => false,
            ],
            [
                'attribute' => 'author',
                'label' => __('Author'),
                'value' => function ($model) {
                    return $model->author ? $model->author->name : null;
                },
                'create' => false,
                'edit' => false,
                'sortable' => true,
            ],
            GridHelper::getTagsField('tags', config('forum.tag_name')),
            [
                'attribute' => 'status',
                'label' => __('Status'),
                'type' => 'select',
                'value' => function ($model) {
                    return __(array_flip(config('forum.status'))[$model->status]);
                },
                'form_options' => function ($model) {
                    $status = [];
                    foreach (config('forum.status') as $key => $value) {
                        $status[$value] = __($key);
                    };

                    return [
                        'choices' => $status,
                        'default_value' => $model ? $model->status : null,
                    ];
                },
            ],
            [
                'attribute' => 'comment_count',
                'label' => __('Comment Count'),
                'create' => false,
                'edit' => false,
                'sortable' => true,
            ],
            [
                'attribute' => 'view_count',
                'label' => __('View Count'),
                'create' => false,
                'edit' => false,
                'sortable' => true,
            ],
            [
                'attribute' => 'created_at',
                'sortable' => true,
            ],
            [
                'attribute' => 'updated_at',
                'sortable' => true,
            ],
        ];
    }
}
