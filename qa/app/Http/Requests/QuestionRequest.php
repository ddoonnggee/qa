<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class QuestionRequest extends Request {

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'cate_id' => 'required',
            'title'   => 'required',
            'score'   => 'required'
        ];
    }
}