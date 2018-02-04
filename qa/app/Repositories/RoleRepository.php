<?php namespace App\Repositories;

use App\Models\Role;

class RoleRepository extends Repository
{

    public function __construct(Role $role)
    {
        $this->model = $role;
    }

    public function save($id, $data)
    {
        $role = parent::save($id, $data);
        //Assing user roles
        $permissions = strlen($data['permissions']) ? explode(",", $data['permissions']) : [];
        $permissions =  explode(',',trim($data['permissions']));
        if (count($permissions) > 0) {
            $role->permissions()->sync($permissions);
        }
        return $role;
    }

}