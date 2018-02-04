<?php namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class MemberForm extends Form
{
    public function buildForm()
    {
        $this->add('nickname', 'text', ['label' => trans('messages.nickname')])
            ->add('avatar', 'text', ['label' => trans('messages.avatar')])
            ->add('score', 'text', ['label' => trans('messages.score')])
            ->add('count', 'text', ['label' => trans('messages.count')])
            ->add('win_count', 'text', ['label' => trans('messages.win_count')])
            ->add('lose_count', 'text', ['label' => trans('messages.lose_count')])
            ->add('draw_count', 'text', ['label' => trans('messages.draw_count')])
            ->add('task', 'hidden')
        ;
    }
}