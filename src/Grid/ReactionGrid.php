<?php

namespace BalajiDharma\LaravelAdminCore\Grid;

use BalajiDharma\LaravelReaction\Models\Reaction;
use BalajiDharma\LaravelCrud\CrudBuilder;

class ReactionGrid extends CrudBuilder
{
    public $title = 'Reactions';

    public $description = 'Manage Reactions';

    public $model = Reaction::class;

    public $route = 'admin.reaction';

    public function columns()
    {

        $reaction_types = collect(config('reaction.reaction_types'))->pluck('name', 'name')->all();

        return [
            [
                'attribute' => 'id',
                'label' => __('ID'),
                'sortable' => true,
                'searchable' => true,
                'filter' => '=',
                'list' => [
                    'class' => 'BalajiDharma\LaravelCrud\Column\LinkColumn',
                    'route' => 'admin.reaction.show',
                    'route_params' => ['reaction' => 'id'],
                    'attr' => ['class' => 'link link-primary'],
                ],
            ],
            [
                'attribute' => 'reaction_type',
                'label' => __('Type'),
                'searchable' => true,
                'filter' => 'like',
                'type' => 'select',
                'filter_options' => $reaction_types,
                'form_options' => function ($model) use ($reaction_types) {
                    return [
                        'choices' => $reaction_types,
                        'empty_value' => __('Select an option'),
                        'default_value' => $model ? $model->reaction_type : null,
                    ];
                },
            ],
            [
                'attribute' => 'reaction_name',
                'label' => __('Name'),
                'searchable' => true,
                'filter' => 'like',
            ],
            [
                'attribute' => 'rate',
                'label' => __('Rating'),
                'searchable' => true,
                'filter' => 'like',
            ],
            [
                'attribute' => 'reactor_type',
                'label' => __('Reactor Type'),
                'type' => 'select',
                'list' => true,
                'show' => true,
                'form_options' => function ($model) {
                    $reactor_type = [
                        'App\Models\User' => __('User'),
                    ];

                    return [
                        'choices' => $reactor_type,
                        'empty_value' => __('Select an option'),
                        'default_value' => $model ? $model->reactor_type : null,
                    ];
                },
            ],
            [
                'attribute' => 'reactor_id',
                'label' => __('Reactor ID'),
                'list' => false,
                'show' => false,
            ],
            [
                'attribute' => 'reactor',
                'label' => __('Reactor'),
                'value' => function ($model) {
                    return $model->reactor ? $model->reactor->name : null;
                },
                'create' => false,
                'edit' => false,
                'sortable' => true,
            ],
            [
                'attribute' => 'reactable_type',
                'label' => __('Reactable Type'),
                'type' => 'select',
                'list' => true,
                'form_options' => function ($model) {
                    $reactable_type = [
                        'BalajiDharma\LaravelForum\Models\Thread' => __('Thread'),
                    ];

                    return [
                        'choices' => $reactable_type,
                        'empty_value' => __('Select an option'),
                        'default_value' => $model ? $model->reactable_type : null,
                    ];
                },
            ],
            [
                'attribute' => 'reactable_id',
                'label' => __('Reactable ID'),
                'list' => false,
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
