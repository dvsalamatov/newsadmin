<?php

namespace app\models;

use Yii;
use app\models\User;
use yii\db\ActiveRecord;
use app\models\News;

/**
 * @property integer $id
 * @property string $content
 * @property User $user
 * @property News $news
 */
class Comments extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%comments}}';
    }

    public function getNews()
    {
        return $this->hasOne(News::class, ['id' => 'news_id']);
    }

    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}