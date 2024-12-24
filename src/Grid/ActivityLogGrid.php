<?php

namespace BalajiDharma\LaravelAdminCore\Grid;

use BalajiDharma\LaravelCrud\CrudBuilder;
use Spatie\Activitylog\Models\Activity;

class ActivityLogGrid extends CrudBuilder
{
    public $title = 'Activity Logs';

    public $description = 'Activity Logs';

    public $model = Activity::class;

    public $route = 'admin.activitylog';

    public $actions = [
        'create' => false,
        'store' => false,
        'edit' => false,
        'update' => false,
    ];

    public function columns()
    {
        return [
            [
                'attribute' => 'id',
                'label' => __('ID'),
                'sortable' => true,
                'searchable' => true,
                'defaultSort' => 'desc',
                'filter' => '=',
                'list' => [
                    'class' => 'BalajiDharma\LaravelCrud\Column\LinkColumn',
                    'route' => 'admin.activitylog.show',
                    'route_params' => ['activitylog' => 'id'],
                    'attr' => ['class' => 'link link-primary'],
                ],
            ],
            [
                'attribute' => 'created_at',
                'label' => __('Date'),
                'sortable' => true,
                'filter' => 'between',
                'searchable' => true,
            ],
            [
                'attribute' => 'event',
                'label' => __(key: 'Event'),
                'sortable' => true,
                'filter' => 'like',
                'searchable' => true,
            ],
            [
                'attribute' => 'description',
                'label' => __(key: 'Description'),
                'sortable' => true,
                'filter' => 'like',
                'searchable' => true,
            ],
            [
                'attribute' => 'username',
                'label' => __(key: 'Username'),
                'sortable' => true,
                'filter' => 'like',
                'relation' => 'causer',
                'searchable' => true,
                'value' => function ($model) {
                    return $model->causer->username;
                },
            ],
            [
                'attribute' => 'properties',
                'label' => __(key: 'Properties'),
                'list' => false,
                'value' => function ($model) {
                    return $this->activityProperties($model->properties);
                },
            ],
        ];
    }

    public function activityProperties($data)
    {
        $html = '<table class="table">
            <thead>
                <tr>
                    <th>Field</th>
                    <th>Old Value</th>
                    <th>New Value</th>
                </tr>
            </thead>
            <tbody>';

        // Only process keys that exist in both 'old' and 'attributes'
        foreach ($data['attributes'] as $key => $Value) {
            if (isset($data['attributes'][$key])) {
                $html .= '<tr>
                    <td>'.htmlspecialchars(ucfirst($key)).'</td>
                    <td>'.htmlspecialchars($data['old'][$key] ?? '').'</td>
                    <td>'.htmlspecialchars($data['attributes'][$key]).'</td>
                </tr>';
            }
        }

        $html .= '</tbody></table>';

        return $html;
    }
}
