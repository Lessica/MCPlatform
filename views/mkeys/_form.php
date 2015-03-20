<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Mkeys */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="mkeys-form">
    <?php $form = ActiveForm::begin(); ?>
    <?php
        if($model->isNewRecord):
    ?>
        <?= $form->field($model, 'key')->textInput()->label('前缀') ?>
        <?= $form->field($model, 'sid')->textInput() ?>
    <?php
        endif;
    ?>
    <?= $form->field($model, 'time')->textInput() ?>
    <?php
        if($model->isNewRecord):
    ?>
    <div class="form-group field-amount required">
<label class="control-label" for="mkeys-amount">张数</label>
<input type="text" id="mkeys-amount" class="form-control" name="Mkeys[amount]" value="100" />
</div>
    <?php
        endif;
    ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '创建' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
