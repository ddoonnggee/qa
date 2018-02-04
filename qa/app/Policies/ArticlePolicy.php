<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Article;

class ArticlePolicy
{
    /**
     * 判断给定文章是否可以被给定用户更新
     */
    public function articles_update(User $user, Article $article)
    {
        return ($user->checkPermission(__FUNCTION__) && $user->id === $article->author);
    }

    /**
     * 判断给定文章是否可以被给定用户删除
     */
    public function articles_delete(User $user, Article $article)
    {
        return ($user->checkPermission(__FUNCTION__) && $user->id === $article->author);
    }


}
