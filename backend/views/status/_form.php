<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Status */
/* @var $form yii\widgets\ActiveForm */
?>                      
<?php $form = ActiveForm::begin(); ?>
<?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
<?= $form->field($model, 'status')->dropDownList(['1'=>'Active','2'=>'In Active'], ['id'=>'status-id','prompt' => 'Select Status',]); ?>
<div class="form-group action-button">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a('Back', Yii::$app->request->referrer, ['class' => 'btn btn-info fa fa-angle-left']) ?>
</div>
<?php ActiveForm::end(); ?>
                           

