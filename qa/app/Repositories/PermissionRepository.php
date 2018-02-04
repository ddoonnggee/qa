<?php namespace App\Repositories;

use App\Models\Permission;
use App\Models\PermissionDependency;

class PermissionRepository extends Repository {

    public function __construct(Permission $permission,PermissionDependency $dependency)
    {
        $this->model = $permission;
        $this->dependency = $dependency;
    }

    public function all()
    {
        return $this->model->with('group','dependencies.permission')->select($this->queryColumns());
    }

    public function saveWithDependencies($id, $data)
    {
        $permission = $this->save($id, $data);
        if (isset($data['dependencies']) && count($data['dependencies'])) {
            $this->dependency->where('permission_id', $id)->delete();
            foreach ($data['dependencies'] as $dependency_id)
                $this->dependency->firstOrCreate(['permission_id' => $id,'dependency_id' => $dependency_id]);
        } else
            $this->dependency->where('permission_id', $id)->delete();
    }

    public function updateSort($hierarchy) {
        foreach ($hierarchy as $sort=>$permission) {
            $this->save($permission['id'], [
                'sort' => (int)($sort+1),
            ]);
        }
        return true;
    }


}