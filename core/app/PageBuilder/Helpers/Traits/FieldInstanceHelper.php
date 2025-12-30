<?php


namespace App\PageBuilder\Helpers\Traits;


trait FieldInstanceHelper
{

    public static function get(array $args): string
    {
        return (new self($args))->render();
    }
}
