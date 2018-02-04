<?php 
namespace App\Repositories;

use App\Models\Cate;

class CateRepository extends Repository {

    public function __construct(Cate $cate)
    {
        $this->model = $cate;
    }

}