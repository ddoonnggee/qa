<?php namespace App\Forms;

use App\Models\Permission;
use App\Repositories\PermissionGroupRepository as PermissionGroup;
use Kris\LaravelFormBuilder\Form;
use DB;

class PermissionForm extends Form
{
    public function __construct(Permission $permission,PermissionGroup $permissiongroup)
    {
        $this->permission = $permission;
        $this->permissiongroup = $permissiongroup;
    }

    protected function getGroupsSelected()
    {
        return !isset($this->model->id) ?'': $this->model->group_id;
    }

    protected function getdDependencies()
    {
        return !isset($this->model->id)?[]:$this->permission->find($this->model->id)->dependencies()->lists('dependency_id')->toArray();
    }

    public function buildForm()
    {
        $this->addCustomField('dependencies', Fields\PermissionDependencies::class);
        $this
            ->add('name', 'text', ['label' => trans('messages.name'),'rules' => 'required'])
            ->add('display_name', 'text', ['label' => trans('messages.display_name'),'rules' => 'required'])
            ->add('group_id', 'select', [
                'label' => trans('messages.group_id'),
                'rules' => 'required',
                'choices' => $this->permissiongroup->getOrderdGroups(),
                'selected' => $this->getGroupsSelected(),
                'empty_value' => trans('messages.please_select'),
			])
			->add('sort', 'text', ['label' => trans('messages.sort')])
            ->add('dependencies', 'dependencies', [
                'label' => trans('messages.permissiondependencies'),
                'choices' => $this->permissiongroup->getOrderdPermissions(),
                'current' => isset($this->model->id)?$this->model->id:0,
                'selected' => $this->getdDependencies(),
            ])
            ->add('task', 'hidden')
        ;
    }
}