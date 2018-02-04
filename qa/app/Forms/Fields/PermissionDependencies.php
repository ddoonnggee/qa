<?php namespace App\Forms\Fields;

use Kris\LaravelFormBuilder\Fields\FormField;

class PermissionDependencies extends FormField {

    protected function getTemplate()
    {
        return 'rbac.permission_dependencies';
    }
}