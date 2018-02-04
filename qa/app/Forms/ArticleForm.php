<?php namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class ArticleForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('name', 'text', ['label' => trans('messages.name')])
            ->add('description', 'text', ['label' => trans('messages.description')])
            ->add('content', 'text', ['label' => trans('messages.content')])
            // ->add('author', 'text', ['label' => trans('messages.name')])
            ->add('task', 'hidden')
        ;
    }
}