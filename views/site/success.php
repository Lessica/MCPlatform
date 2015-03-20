<?php

use yii\helpers\Html;

$this->title = $name;
?>
<div class="site-success">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="alert alert-success">
        <?= nl2br(Html::encode($message)) ?>
    </div>
    <p>
        操作成功，感谢您使用 <b><?= Yii::$app->params['siteName'] ?></b>！
    </p>
</div>
