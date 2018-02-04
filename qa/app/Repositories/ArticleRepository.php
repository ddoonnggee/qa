<?php namespace App\Repositories;

use App\Models\Article;

class ArticleRepository extends Repository {

    public function __construct(Article $article)
    {
        $this->model = $article;
    }

    public function all()
    {
        return $this->model->with('user')->select($this->queryColumns());
    }

}