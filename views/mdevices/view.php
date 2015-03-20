<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Mdevices */

$this->title = '查看';
$this->params['breadcrumbs'][] = ['label' => '设备', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mdevices-view">
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
            'uuid',
            'sid',
            'regtime:datetime',
            'totime:datetime',
            'role',
            'runtimes',
        ],
    ]) ?>
</div>
