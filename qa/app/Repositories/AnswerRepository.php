<?php namespace App\Repositories;

use App\Models\Answer;

class AnswerRepository extends Repository {

    public function __construct(Answer $answer)
    {
        $this->model = $answer;
    }

}