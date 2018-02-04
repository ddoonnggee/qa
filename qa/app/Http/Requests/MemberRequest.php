<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class MemberRequest extends Request {

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nickname' => 'required'
        ];
    }
}