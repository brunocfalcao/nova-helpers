<?php

use Illuminate\Support\Arr;

function nova_current_view_context()
{
    $namespace = Arr::first(explode('@', Route::getCurrentRoute()->getAction()['controller']));

    $controller = Arr::last(explode('\\', $namespace));

    switch ($controller) {
        case "ResourceIndexController":
            return 'index';
            break;

        case "ResourceShowController":
            return 'show';
            break;

        case "ResourceDetailController":
            return 'detail';
            break;

        case "UpdateFieldController":
            return 'update';
            break;

        case "CreationFieldController":
            return 'create';
            break;
    }
}
