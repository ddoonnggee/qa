<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class AnswerRequest extends Request {

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'question_id' => 'required',
            'option'      => 'required'
        ];
    }
}