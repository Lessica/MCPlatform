<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Mscripts */

$this->title = '查看';
$this->params['breadcrumbs'][] = ['label' => '脚本', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mscripts-view">
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
            'name',
            'version',
            'update_logs',
            'md5',
            'sha1',
            'sha256',
            'size',
            'download_url:url',
            'createtime:datetime',
            'runtimes',
        ],
    ]) ?>

</div>
