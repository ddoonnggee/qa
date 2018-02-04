<?php namespace App\Http\Requests\Permission;

use App\Http\Requests\Request;

class PermissionRequest extends Request {

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|unique:permissions,name,'.$this->route()->parameter('permissions'),
            'display_name' => 'required',
            'group_id' => 'required',
        ];
    }
}