<?php

namespace app\repository;

use app\models\User;
use app\models\News;

class NewsRepository
{
    public function getNewsForUser(User $user): array
    {
        return News::find()
            ->where(['user_id' => $user->id])
            ->all();
    }
}