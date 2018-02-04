<?php

Breadcrumbs::register('dashboard', function($breadcrumbs)
{
    $breadcrumbs->push(trans('messages.dashboard'), route('admin.dashboard.index'), ['icon' => config('menus')['dashboard']['icon']]);
});

$models = array_divide(array_where(config('menus'), function($key, $value){return ($key!='dashboard');}))[0];
foreach ($models as $model) {
    Breadcrumbs::register($model.'.index', function($breadcrumbs) use($model )
    {
        $breadcrumbs->parent('dashboard');
        $breadcrumbs->push(trans('messages.'.$model), route('admin.'.$model.'.index'));
    });
    Breadcrumbs::register($model.'.create', function($breadcrumbs,$table) use($model )
    {
        $breadcrumbs->parent($model.'.index');
        $breadcrumbs->push(trans('messages.create').$table, route('admin.'.$model.'.create'));
    });
    Breadcrumbs::register($model.'.edit', function($breadcrumbs,$table) use($model )
    {
        $breadcrumbs->parent($model.'.index');
        $breadcrumbs->push(trans('messages.edit').$table, route('admin.'.$model.'.edit'));
    });
}
