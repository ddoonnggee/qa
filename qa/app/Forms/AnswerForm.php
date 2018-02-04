<?php namespace App\Forms;

use Kris\LaravelFormBuilder\Form;
use App\Models\Question;

class AnswerForm extends Form
{
    public function buildForm()
    {
        $this->add('question_id', 'select', [
				'label'    => trans('messages.question_id'),
				'choices'  => Question::lists('title', 'id')->toArray(),
				'selected' => function ($data) {
			        return $data;
			    },
			    'empty_value' => '=== 请选择问题 ==='
			])
            ->add('option', 'text', ['label' => trans('messages.option')])
            ->add('is_right', 'checkbox', ['label' => trans('messages.is_right'), 'value' => 1])
            ->add('task', 'hidden')
        ;
    }
}