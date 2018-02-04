<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User as User;

class InterfaceController extends Controller
{
    public function getIndex()
    {
        echo 'index';
    }

    /**
     * 用户登录
     **/
    public function anyLogin(Request $request)
    {
        $data = $request->all();
        if(!$data['name']){
            return Helpers::returnErrorJson('缺少用户名');
        }

        if(!$data['password']){
            return Helpers::returnErrorJson('缺少密码');
        }

        $result = User::checklogin($data['name'],$data['password']);
        echo $result;
    }
}
