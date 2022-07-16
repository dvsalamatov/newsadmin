<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use app\models\User;
use app\models\Comments;

/**
 * @property integer $id
 * @property string $content
 * @property string $header
 * @property User $user
 * @property int $user_id
 * @property Comments $comments
 */
class News extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%news}}';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    public function getComments()
    {
        return $this->hasMany(Comments::class, ['news_id' => 'id']);
    }
}