<?php namespace App\Forms;

use Kris\LaravelFormBuilder\Form;
use App\Models\Cate;

class QuestionForm extends Form
{
    public function buildForm()
    {
        $this->add('cate_id', 'select', [
				'label'    => trans('messages.cate_id'),
				'choices'  => Cate::lists('name', 'id')->toArray(),
				'selected' => function ($data) {
			        return $data;
			    },
			    'empty_value' => '=== 请选择分类 ==='
			])
            ->add('title', 'text', ['label' => trans('messages.title')])
            ->add('score', 'text', ['label' => trans('messages.score')])
            ->add('task', 'hidden')
        ;
    }
}