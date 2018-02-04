<?php namespace App\Forms;

use App\Repositories\PermissionGroupRepository as PermissionGroup;
use Kris\LaravelFormBuilder\Form;

class PermissionGroupForm extends Form{

    public function __construct(PermissionGroup $permissiongroup)
    {
        $this->permissiongroup = $permissiongroup;
    }

    protected function getGroups()
    {
        $array = $this->permissiongroup->getOrderdGroups();
		return !isset($this->model->id) ? $array : array_except($array,$this->model->id);
    }

    protected function getGroupsSelected()
    {
        return !isset($this->model->id) ?'': $this->model->parent_id;
    }

    protected function getGroupPermissions()
    {
        return !isset($this->model->id) ?['','']: $this->permissiongroup->getPermissionsHierarchy($this->model->id);
    }

    public function buildForm()
    {
        $this->addCustomField('permission_sort', Fields\PermissionSort::class);
        $this
			->add('name', 'text', ['label' => trans('messages.name'),'rules' => 'required'])
            ->add('parent_id', 'select', [
                'label' => trans('messages.parent_id'),
                'choices' => $this->getGroups(),
                'selected' => $this->getGroupsSelected(),
                'empty_value' => trans('messages.please_select'),
			])
            ->add('permission_sort', 'permission_sort', [
                'label' => trans('messages.sort'),
                'permissions' => $this->getGroupPermissions(),
            ])
            ->add('task', 'hidden')
        ;
    }
}