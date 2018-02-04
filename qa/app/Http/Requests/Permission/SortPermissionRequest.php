<?php namespace App\Http\Requests\Permission;

use App\Http\Requests\Request;

class SortPermissionRequest extends Request {

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