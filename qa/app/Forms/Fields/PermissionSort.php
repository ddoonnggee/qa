<?php namespace App\Forms\Fields;

use Kris\LaravelFormBuilder\Fields\FormField;

class PermissionSort extends FormField {

    protected function getTemplate()
    {
        return 'rbac.permission_sort';
    }
}