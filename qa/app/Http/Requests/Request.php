<?php 
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Lang;

abstract class Request extends FormRequest
{
    public function attributes()
    {
        return Lang::get('messages');
    }
}
