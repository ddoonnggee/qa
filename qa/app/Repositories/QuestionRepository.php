<?php 
namespace App\Repositories;

use App\Models\Question;

class QuestionRepository extends Repository {

    public function __construct(Question $question)
    {
        $this->model = $question;
    }

}