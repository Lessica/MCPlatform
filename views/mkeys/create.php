<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Mkeys */

$this->title = '生成充值卡';
$this->params['breadcrumbs'][] = ['label' => '充值卡', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mkeys-create">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
