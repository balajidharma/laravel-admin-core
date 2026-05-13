<?php

if (! function_exists('syncAdminTags')) {

    function syncAdminTags($model, $tags, $type = null)
    {
        if (! $type) {
            $type = config('admin.tag_name');
        }
        $model->syncTags($tags, $type);
    }

}
