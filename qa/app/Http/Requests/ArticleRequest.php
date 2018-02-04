<?php namespace App\Http\Requests;

use App\Http\Requests\Request;
use Lang;

class ArticleRequest extends Request {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'description' => 'required'
        ];
    }

    public function attributes()
    {
        $messages =[
            'name' => '文章标题 ',
        ];
        return array_merge(Lang::get('messages'),$messages);//覆盖同名字段定义
    }


}