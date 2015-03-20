<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MdevicesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '设备';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mdevices-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            'id',
            'uuid',
            'sid',
            'regtime:datetime',
            'totime:datetime',
            'role',
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
