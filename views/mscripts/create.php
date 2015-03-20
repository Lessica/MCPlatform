<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Mscripts */

$this->title = '创建脚本';
$this->params['breadcrumbs'][] = ['label' => '脚本', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mscripts-create">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
