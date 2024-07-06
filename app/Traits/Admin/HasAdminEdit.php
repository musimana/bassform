<?php

namespace App\Traits\Admin;

use App\Services\ReflectionService;

trait HasAdminEdit
{
    /** Get the admin URL for the resource's edit view. */
    public function getUrlAdminEdit(): string|false
    {
        $class_name = ReflectionService::getClassName(self::class);

        return $class_name
            ? route('admin.' . strtolower($class_name) . '.edit', $this->id)
            : false;
    }
}
