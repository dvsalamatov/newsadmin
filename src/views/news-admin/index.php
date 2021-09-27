<?php
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use app\models\News;

/**
 * @var Array $news
 * @var string $message
 */

$this->title = "Список новостей пользователя";
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="float-left">
        <header>
            <?php $form = ActiveForm::begin([
                'id' => 'add-news-form',
                'layout' => 'horizontal',
                'method' => 'get',
                'action' => Yii::$app->urlManager->createUrl(['news-admin/create']),
                'fieldConfig' => [
                    'labelOptions' => ['class' => 'col-lg-1 col-form-label'],
                ],
            ]); ?>
                <input type="hidden" name="task" value="add-news"/>
                <button>Добавить Новость</button>
            <?php ActiveForm::end(); ?>
        </header>

        <div>
            <ul>
                <?php foreach ($news as $item) { ?>
                    <li style="padding-top: 10px;">
                        <?= $item->header ?>
                        <?= Html::a('Edit', ['news-admin/create', 'id' => $item->id]) ?>
                        <div style="display: inline-block">
                            <?php $form = ActiveForm::begin([
                                'id' => 'delete-news-form-' . $item->id,
                                'layout' => 'horizontal',
                                'method' => 'post',
                                'action' => Yii::$app->urlManager->createUrl(['news-admin/delete']),
                                'fieldConfig' => [
                                    'labelOptions' => ['class' => 'col-lg-1 col-form-label'],
                                ],
                            ]); ?>
                            <input type="hidden" name="id" value="<?= $item->id ?>"/>
                            <button>Delete</button>
                            <?php ActiveForm::end(); ?>
                        </div>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>

    <div class="float-left" style="margin-left: 50px">
        <?= $message ?? '' ?>
    </div>

</div>