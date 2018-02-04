<?php namespace App\Repositories;

use App\Models\Permission;
use App\Models\PermissionGroup;

class PermissionGroupRepository extends Repository {

    public function __construct(PermissionGroup $permissiongroup,Permission $permission)
    {
        $this->model = $permissiongroup;
        $this->permission = $permission;
    }

    public function getPermissionsHierarchy($id) {
        $group = $this->model->find($id);
        $string = '';
        if($group->permissions->count()){
            $string .= '<ol class="dd-list">';
            foreach ($group->permissions as $permission) {
                $string .= '<li class="dd-item" data-id="'.$permission->id.'"><div class="dd-handle">'.$permission->display_name.'</div></li>';
            }
            $string .= "</ol>";
        }
        return [$group->permissions->count(),$string];
    }

    public function getAllGroups($withChildren = false) {
        if ($withChildren)
            return $this->model->orderBy('name', 'asc')->get();

        return $this->model->with('children', 'permissions')
            ->whereNull('parent_id')
            ->orderBy('sort', 'asc')
            ->get();
    }

    public function getHierarchy($groups){
        $string = '<ol class="dd-list">';
        foreach ($groups as $i => $group) {
            $string .= '<li class="dd-item" data-id="'.$group->id.'">';
            $string .= '<div class="dd-handle">'.$group->name.'<span class="pull-right">'.$group->permissions->count().'个权限</span></div>';
            if($group->children->count()){
                $string .= $this->getHierarchy($group->children()->get());
            }
            $string .= "</li>";
        }
        $string .= "</ol>";
        return $string;
    }

    public function getTree($groups)
    {
        $string = '<ul>';
        foreach ($groups as $i => $group) {
            $string .= '<li data-id="'.$group->id.'" data-name="'.$group->name.'">';
            $string .= $group->name;
            if($group->permissions->count()){
                $string .= '<ul>';
                foreach ($group->permissions as $permission) {
                    $string .= '<li data-jstree=\'{"icon":"fa fa-lock","disabled":true}\'>'.$permission->display_name .'</li>';
                }
                $string .= "</ul>";
            }
            if ($group->children()->count()) {
                $string .= $this->getTree($group->children()->get());
            }
            $string .= "</li>";
        }
        $string .= "</ul>";
        return $string;
    }

/*    public function getMenu()
    {
        return $this->getMenusArray($this->getAllGroups());
    }

    public function getMenusArray($groups)
    {
        $array = [];
        foreach ($groups as $group) {
            $array[$group->id]['name'] = $group->name;
            if($group->permissions()->where('name', 'like', '%view')->count()>0){
                $array[$group->id]['resource_name'] = $group->permissions()->where('name', 'like', '%view')->pluck('display_name');
                $array[$group->id]['resource'] = explode('_', $group->permissions()->where('name', 'like', '%view')->pluck('name'))[0];
            }
            if ($group->children()->count()) {
                $array[$group->id]['children'] = $this->getMenusArray($group->children()->get());
            }
        }
        return $array;
    }*/

    public function getPermissionsArray($groups)
    {
        $array = [];
        foreach ($groups as $group) {
            if($group->permissions->count()){
                $array[$group->id] = $group->permissions->lists('display_name', 'id')->toArray();
            }
            if ($group->children()->count()) {
                array_push($array,$this->getPermissionsArray($group->children()->get()));
            }
        }
        return $array;
    }

    public function getOrderdPermissions()
    {
        $groups = $this->getAllGroups();
        $permissions_array =  [];
        foreach (array_dot($this->getPermissionsArray($groups)) as $key => $permission) {
            $array =  explode('.',$key);
            end($array);
            $group_id =  prev($array);
            $permission_id =last($array);
            if (!isset($permissions_array[$group_id][$permission_id])){
                $permissions_array[$group_id][$permission_id] = [];
            }
            $dependencies = $this->permission->find($permission_id)->dependencies()->lists('dependency_id');
            if($dependencies->count()>0){$permission .= '[D]';}
            $permissions_array[$group_id][$permission_id]['name'] = $permission;
            $permissions_array[$group_id][$permission_id]['dependencies'] =  $dependencies->all();
        }
        return $permissions_array;
    }

    public function getGroupsArray($groups,$pre = '├─')
    {
        $array = [];
        foreach ($groups as $group) {
        	$array[$group->id]['name'] = $pre.$group->name;
            if ($group->children()->count()) {
            	array_push($array,$this->getGroupsArray($group->children()->get(),$pre.'──'));
            }
        }
        return $array;
    }

    public function getOrderdGroups(){
        $orderd_array =  array_dot($this->getGroupsArray($this->getAllGroups()));
        $groups_array =  [];
        foreach ($orderd_array as $key => $group_name) {
            $array =  explode('.',$key);
            end($array);
            $group =  prev($array);
            if(last($orderd_array)==$group_name)$group_name = str_replace('├─', '└─',$group_name);
            $groups_array[$group] = $group_name;
        }
        return $groups_array;
    }

    public function updateSort($hierarchy) {
        foreach ($this->flattenJsonTree($hierarchy) as $group) {
            $this->save($group['id'], [
                'parent_id' => (int)$group['parent_id'],
                'sort' => (int)$group['sort'],
            ]);

        }
        return true;
    }

    private function flattenJsonTree($aJSON, $iParentId = 0, $iLevel = 0){
        $aRetval = [];
        $iPosition = 1;
        foreach ($aJSON as $aChilds) {
            $aDescendents = [];
            if (isset($aChilds['children'])) {
                $aDescendents = $this->flattenJsonTree(
                    $aChilds['children'], $aChilds['id'], $iLevel+1
                );
            }
            $aRetval[] = [
                'id'  => $aChilds['id'],
                'parent_id'   => $iParentId,
                'level'    => $iLevel,
                'sort' => $iPosition++,
            ];
            $aRetval = array_merge($aRetval, $aDescendents);
        }
        return $aRetval;
    }

}