<?php

namespace BalajiDharma\LaravelAdminCore\Grid;

use BalajiDharma\LaravelComment\Models\Comment;
use BalajiDharma\LaravelCrud\CrudBuilder;

class CommentGrid extends CrudBuilder
{
    public $title = 'Comments';

    public $description = 'Manage Comments';

    public $model = Comment::class;

    public $route = 'admin.comment';

    public function columns()
    {
        $statusOptions = [];
        foreach (config('comment.status') as $key => $value) {
            $statusOptions[$value] = __($key);
        }

        return [
            [
                'attribute' => 'id',
                'label' => __('ID'),
                'sortable' => true,
                'searchable' => true,
                'filter' => '=',
                'list' => [
                    'class' => 'BalajiDharma\LaravelCrud\Column\LinkColumn',
                    'route' => 'admin.comment.show',
                    'route_params' => ['comment' => 'id'],
                    'attr' => ['class' => 'link link-primary'],
                ],
            ],
            [
                'attribute' => 'content',
                'label' => __('Content'),
                'searchable' => true,
                'filter' => 'like',
                'list' => [
                    'class' => 'BalajiDharma\LaravelCrud\Column\LinkColumn',
                    'route' => 'admin.comment.show',
                    'route_params' => ['comment' => 'id'],
                    'attr' => ['class' => 'link link-primary'],
                ],
                'form_options' => function ($model) {
                    return [
                        'field_type' => 'textarea',
                        'attr' => [
                            'rows' => 5,
                        ],
                    ];
                },
            ],
            [
                'attribute' => 'commenter_type',
                'label' => __('Commenter Type'),
                'type' => 'select',
                'list' => true,
                'show' => true,
                'form_options' => function ($model) {
                    $commenter_type = [
                        'App\Models\User' => __('User'),
                    ];

                    return [
                        'choices' => $commenter_type,
                        'empty_value' => __('Select an option'),
                        'default_value' => $model ? $model->commenter_type : null,
                    ];
                },
            ],
            [
                'attribute' => 'commenter_id',
                'label' => __('Commenter ID'),
                'list' => false,
                'show' => false,
            ],
            [
                'attribute' => 'commenter',
                'label' => __('Commenter'),
                'value' => function ($model) {
                    return $model->commenter ? $model->commenter->name : null;
                },
                'create' => false,
                'edit' => false,
                'sortable' => true,
            ],
            [
                'attribute' => 'commentable_type',
                'label' => __('Commentable Type'),
                'type' => 'select',
                'list' => false,
                'form_options' => function ($model) {
                    $commentable_type = [
                        'BalajiDharma\LaravelForum\Models\Thread' => __('Thread'),
                    ];

                    return [
                        'choices' => $commentable_type,
                        'empty_value' => __('Select an option'),
                        'default_value' => $model ? $model->commentable_type : null,
                    ];
                },
            ],
            [
                'attribute' => 'commentable_id',
                'label' => __('Commentable ID'),
                'list' => false,
            ],
            [
                'attribute' => 'parent_id',
                'label' => __('Parent ID'),
                'list' => false,
                'form_options' => function ($model) {
                    return [
                        'field_type' => 'text',
                    ];
                },
            ],
            [
                'attribute' => 'status',
                'label' => __('Status'),
                'type' => 'select',
                'filter' => '=',
                'filter_options' => $statusOptions,
                'value' => function ($model) {
                    return __(array_flip(config('comment.status'))[$model->status]);
                },
                'form_options' => function ($model) use ($statusOptions) {
                    return [
                        'choices' => $statusOptions,
                        'default_value' => $model ? $model->status : null,
                    ];
                },
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
