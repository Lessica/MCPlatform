<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

$this->title = $name;
?>
<div class="site-error">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>
    <p>
        处理您的请求时发生了一些错误。
    </p>
    <p>
        如果您认为是网站设计缺陷造成了以上错误，请尽快联系我们，谢谢。
    </p>
</div>
