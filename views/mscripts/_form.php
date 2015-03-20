<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Mscripts */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="mscripts-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'name')->textInput(['maxlength' => 64]) ?>
    <?= $form->field($model, 'version')->textInput(['maxlength' => 64]) ?>
    <?= $form->field($model, 'size')->textInput() ?>
    <?= $form->field($model, 'download_url')->textInput() ?>
    <?= $form->field($model, 'update_logs')->textArea(['rows' => 6, 'cols' => 50]) ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '创建' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
