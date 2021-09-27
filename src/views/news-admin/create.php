<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\forms\CreateNews;
use app\models\News;

/**
 * @var CreateNews $model
 * @var News $news
 * @var string $successLabel
 * @var string $title
 */

$this->title = $title;
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php
    if (isset($news)){
        echo "<div>" . $successLabel . "</div>";
    }
    ?>
    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'news-add']); ?>
            <?= $form->field($model, 'id')->hiddenInput(['value' => isset($news) ? $news->id : null])->label('') ?>
            <?= $form->field($model, 'header')->textInput()->label('Заголовок') ?>
            <?= $form->field($model, 'content')->textarea()->label('Текст новости') ?>
            <div class="form-group">
                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
