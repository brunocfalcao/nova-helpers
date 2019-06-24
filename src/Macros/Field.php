<?php

use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;

$limitFunction = function ($amount, $ending = '...') {
    if (nova_current_view_context() == 'index') {
        $this->displayUsing(function () use ($amount, $ending) {
            return str_limit($this->value, $amount, $ending);
        });
    }

    return $this;
};

Textarea::macro('limit', $limitFunction);
Text::macro('limit', $limitFunction);
