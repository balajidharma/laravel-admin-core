<?php

if (! function_exists('attachCategories')) {

    function attachCategories($model, $tags, $type = null)
    {
        if (! $type) {
            $type = config('admin.tag_name');
        }
        $model->attachCategories($tags, $type);

    }

}
