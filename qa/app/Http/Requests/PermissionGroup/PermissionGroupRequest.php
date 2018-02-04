<?php namespace App\Http\Requests\PermissionGroup;

use App\Http\Requests\Request;

class PermissionGroupRequest extends Request {

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|unique:permission_groups,name,'.$this->route()->parameter('permissiongroups'),
            // 'parent_id' => 'required',
        ];
    }
}