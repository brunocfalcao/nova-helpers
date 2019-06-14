<?php

namespace Brunocfalcao\Helpers\BladeDirectives;

class Fa
{
    protected $icon;
    protected $otherCss;

    public function __construct($icon = 'heart', $otherCss = '')
    {
        [$this->icon, $this->otherCss] = [$icon, $otherCss];
    }

    public function render()
    {
        return "<i class='fa fa-{$this->icon} {$this->otherCss}'>&nbsp;</i>";
    }
}
