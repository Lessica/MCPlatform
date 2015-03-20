<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Mdevices */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="mdevices-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'uuid')->textInput(['maxlength' => 64]) ?>
    <?= $form->field($model, 'sid')->textInput() ?>
    <?= $form->field($model, 'regtime')->textInput() ?>
    <?= $form->field($model, 'totime')->textInput() ?>
    <?= $form->field($model, 'role')->textInput() ?>
    <?= $form->field($model, 'runtimes')->textInput() ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '创建' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
