<?php

namespace app\service;

use app\models\News;
use app\models\User;

class NewsUserService
{
    public function hasUserEditNews(News $news, User $user): bool
    {
        return $news->user_id === $user->id;
    }
}