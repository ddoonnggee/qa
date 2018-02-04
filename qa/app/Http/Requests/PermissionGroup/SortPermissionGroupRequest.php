<?php namespace App\Http\Requests\PermissionGroup;

use App\Http\Requests\Request;

class SortPermissionGroupRequest extends Request {

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
        ];
    }
}