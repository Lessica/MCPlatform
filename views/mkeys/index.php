<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MkeysSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '充值卡';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mkeys-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <p>
        <?= Html::a('生成充值卡', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            'id',
            'key',
            'sid',
            'flag',
            'usetime:datetime',
            //'createtime:datetime',
            'time',
            [
                'class' => 'yii\grid\ActionColumn',
                'options' => [
                    'width' => '70',
                ],
            ],
        ],
    ]); ?>
</div>
