<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Mscripts */

$this->title = '更新';
$this->params['breadcrumbs'][] = ['label' => '脚本', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => '查看', 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mscripts-update">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
