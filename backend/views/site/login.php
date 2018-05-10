<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
            <div class="col-md-6 site-login login">
                <div class="card">
                    <div class="card-header" data-background-color="blue">
                        <h1 class="title login-title"><?= Html::encode($this->title) ?></h1>
                    </div>
                    <div class="card-content table-responsive"> 
                    <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
                            <?= $form->field($model, 'password')->passwordInput() ?>
                            <?= $form->field($model, 'rememberMe')->checkbox() ?>
                            <div class="form-group">
                                <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                            </div>
                    <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>                  

