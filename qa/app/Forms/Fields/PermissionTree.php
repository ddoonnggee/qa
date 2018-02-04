<?php namespace App\Forms\Fields;

use Kris\LaravelFormBuilder\Fields\FormField;

class PermissionTree extends FormField {

    protected function getTemplate()
    {
        return 'rbac.permission_tree';
    }
}