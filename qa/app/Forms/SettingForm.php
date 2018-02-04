<?php namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class SettingForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('title', 'text', ['label' => trans('messages.title')])
            ->add('task', 'hidden')
        ;
    }
}