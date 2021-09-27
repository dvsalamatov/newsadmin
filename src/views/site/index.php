<?php

/**
 * @var $this yii\web\View
 * @var array $news
 */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent">
        <h1 class="display-4">Все новости</h1>
    </div>

    <div class="body-content">
        <div class="row">
            <?php foreach ($news as $item) { ?>
                <div class="col-lg-4">
                    <h2><?= $item->header ?></h2>
                    <p><?= $item->content ?></p>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
