<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Mkeys */

$this->title = '更新';
$this->params['breadcrumbs'][] = ['label' => '充值卡', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => '查看', 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="mkeys-update">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
