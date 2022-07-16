<?php

namespace app\models\forms;

use Yii;
use yii\base\Model;
use app\models\User;
use app\models\News;

class CreateNews extends Model
{
    public User $user;

    public null|int|string $id = null;

    public string $content = '';

    public string $header = '';

    public int $user_id;

    public function rules()
    {
        return [
            ['id', 'safe'],
            [['content','header'], 'required']
        ];
    }

    public function saveNews(): ?News
    {
        $news = $this->id ? News::findOne($this->id) : new News();
        $news->content = $this->content;
        $news->user_id = $this->user->id;
        $news->header = $this->header;
        $news->save();

        return $news;
    }
}