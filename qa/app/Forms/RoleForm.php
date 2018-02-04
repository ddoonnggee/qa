<?php namespace App\Forms;

use App\Models\Permission;
use App\Repositories\PermissionGroupRepository as PermissionGroup;
use Kris\LaravelFormBuilder\Form;

class RoleForm extends Form
{
    public function __construct(PermissionGroup $permissiongroup)
    {
        $this->permissiongroup = $permissiongroup;
    }

    protected function buildTee(){
        $array = [];
        $selected = !isset($this->model->id) ?[]: $this->model->permissions()->lists('id')->toArray();
        list($keys, $values) = array_divide($this->permissiongroup->getOrderdGroups());
        foreach ($keys as $key) {
            $group = $this->permissiongroup->find($key);
            $parent =  ($group->parent_id != null)?'group_'.$group->parent_id:'#';
            array_push($array,['id'=>'group_'.$group->id, 'parent'=>$parent, 'text'=>$group->name, 'li_attr'=>['group'=>'1']]);
            if($group->permissions->count()){
                foreach ($group->permissions as $permission) {
                    $permission_array =['id'=> $permission->id,'parent'=>'group_'.$group->id,'text'=>$permission->display_name,'li_attr'=>['group'=>'0']];
                    if(!empty($selected) && in_array($permission->id,$selected))$permission_array['state'] = ['selected'=>'true'];
                    $dependencies = $permission->dependencies()->lists('dependency_id');
                    if($dependencies->count()>0) $permission_array['text'] = $permission->display_name.'[D]';
                    $permission_array['li_attr']['dependencies'] = $dependencies->all();
                    array_push($array,$permission_array);
                }
            }
        }
        return json_encode($array);
    }


    public function buildForm()
    {
        $this->addCustomField('permission_tree', Fields\PermissionTree::class);
        $this
            ->add('name', 'text', ['label' => trans('messages.name')])
            ->add('display_name', 'text', ['label' => trans('messages.display_name')])
            ->add('permissions', 'permission_tree', [
                'label' => trans('messages.permissions'),
                'tree' => $this->buildTee(),
            ])
            ->add('task', 'hidden')
        ;
    }
}
