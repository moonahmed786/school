<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
use yii\app\model\School;
use dosamigos\fileupload\FileUpload;

/* @var $this yii\web\View */
/* @var $model backend\models\Schools */
/* @var $form yii\widgets\ActiveForm */
?>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
<div class="row">
    <div class="col-md-12">
        <div class="profile clearfix">                            
            <div class="image">
            <img src="<?= Url::home(true);?>img/school/defualt-background.jpg" class="img-cover">
            </div>                            
            <div class="user clearfix">
                <div class="avatar pull-left school-file">
                    <img src="https://bootdey.com/img/Content/user-453533-fdadfd.png" class="img-thumbnail img-profile"><span>
                    <?= FileUpload::widget([
                                'model' => $model,
                                'attribute' => 'logo',
                                'url' => ['schools/logo-upload', 'id' => $model->id],
                                'options' => [
                                    'accept' => 'image/*',
                                ],
                                'clientOptions' => [
                                    'maxFileSize' => 2000000
                                ],
                                'clientEvents' => [
                                    'fileuploaddone' => 'function(data) {
                                                        alert(data.url);
                                                        jQuery(".img-profile").attr("src",data.url);
                                                            console.log(data);
                                                        }',
                                    'fileuploadfail' => 'function(e, data) {
                                                            console.log(e);
                                                            console.log(data);
                                                        }',
                                ],
                        ]);
                    ?>
                    </span>
                </div>                                                                                                                                                               
            </div>                          
            <div class="info pull-right">
                    <?= $form->field($model, 'background')->fileInput(['class'=>'btn btn-success'])?>                                
            </div>                              
        </div>
    </div>
</div>    
<div class="row">
        <div class="col-md-12">
            <div class="col-md-6">
                <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'ower_name')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'phone_no')->widget(\yii\widgets\MaskedInput::className(),['mask' => '0399-9999999',]) ?>
                <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'cnic')->widget(\yii\widgets\MaskedInput::className(),['mask' => '99999-9999999-9',]) ?>
                <?= $form->field($model, 'status_id')->dropDownList(ArrayHelper::map(backend\models\Status::find()->all(),'id','title'), ['id'=>'status-id','prompt' => 'Select Status',])?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'country_id')->dropDownList(ArrayHelper::map(backend\models\Countries::find()->all(),'id','name'), ['id'=>'country-id','prompt' => 'Select Country',]) ?>
                <?= $form->field($model, 'state_id')->widget(DepDrop::classname(), [
                    'options'=>['id'=>'state-id'],
                    'pluginOptions'=>[
                        'depends'=>['country-id'],
                        'placeholder'=>'Select State',
                        'url'=>Url::to(['schools/sub-states']),
                        'params'=>['state-id']
                    ],
                    'data'=>$states,
                    ]) ?>
                <?= $form->field($model, 'city_id')->widget(DepDrop::classname(), [
                    'pluginOptions'=>[
                        'depends'=>['state-id'],
                        'placeholder'=>'Select city',
                        'url'=>Url::to(['schools/sub-cities'])
                    ],
                    'data'=>$cities,
                    ])?>
                <?= $form->field($model, 'address')->textInput(['rows' => 1]) ?>
                <?= $form->field($model, 'user_id')->dropDownList(ArrayHelper::map(backend\models\User::find()->all(),'id','username'), ['id'=>'user-id','prompt' => 'Select User Name',])?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="form-group pull-right">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>    
    <?php ActiveForm::end(); ?>
