<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Mkeys */

$this->title = '查看';
$this->params['breadcrumbs'][] = ['label' => '充值卡', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mkeys-view">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('更新', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '您确定要删除这个项目吗？',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'key',
            'sid',
            'flag',
            'usetime:datetime',
            'createtime:datetime',
            'time',
        ],
    ]) ?>
</div>
