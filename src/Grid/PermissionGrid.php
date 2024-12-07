<?php

namespace BalajiDharma\LaravelAdminCore\Grid;

use App\Models\Permission;
use BalajiDharma\LaravelCrud\CrudBuilder;

class PermissionGrid extends CrudBuilder
{
    public $title = 'Permissions';

    public $description = 'Manage Permissions';

    public $model = Permission::class;

    public $route = 'admin.permission';

    public function columns()
    {
        return [
            [
                'label' => __('#'),
                'attribute' => 'label',
                'list' => [
                    'class' => 'BalajiDharma\LaravelCrud\Column\SerialColumn',
                ],
                'show' => false,
            ],
            [
                'attribute' => 'id',
                'label' => __('ID'),
                'sortable' => true,
                'searchable' => true,
                'filter' => '=',
                'list' => [
                    'class' => 'BalajiDharma\LaravelCrud\Column\LinkColumn',
                    'route' => 'admin.permission.show',
                    'route_params' => ['permission' => 'id'],
                    'attr' => ['class' => 'link link-primary'],
                ],
            ],
            [
                'attribute' => 'name',
                'label' => __('Name'),
                'sortable' => true,
                'filter' => 'like',
                'searchable' => true,
                'list' => [
                    'class' => 'BalajiDharma\LaravelCrud\Column\LinkColumn',
                    'route' => 'admin.permission.show',
                    'route_params' => ['permission' => 'id'],
                    'attr' => ['class' => 'link link-primary'],
                ],
            ],
            GridHelper::getTagsField('admin_tags', config('admin.tag_name')),
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
