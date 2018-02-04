<?php namespace App\Repositories;

use App\Models\Round;

class RoundRepository extends Repository {

    public function __construct(Round $round)
    {
        $this->model = $round;
    }

}