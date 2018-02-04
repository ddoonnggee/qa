<?php namespace App\Repositories;

use App\Models\Record;

class RecordRepository extends Repository {

    public function __construct(Record $record)
    {
        $this->model = $record;
    }

}