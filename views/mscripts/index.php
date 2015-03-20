<?php
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MscriptsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '脚本';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mscripts-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('新建脚本', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            'id',
            'name',
            'version',
            //'md5',
            //'sha1',
            //'sha256',
            //'size',
            'createtime:datetime',
            'runtimes',
            [
                'class' => 'yii\grid\ActionColumn',
                'options' => [
                    'width' => '70',
                ],
            ],
        ],
    ]); ?>
</div>
