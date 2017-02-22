<?php

namespace App\Policies;

use App\Article;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArticlePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Check a user has access to an article.
     *
     * @param User $user
     * @param Article $article
     * @return bool
     */
    public function show(User $user, Article $article)
    {
        if ($user->articles->find($article->id))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}
