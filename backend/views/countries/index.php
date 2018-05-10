<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\date\DatePicker;
use backend\models\User;
use backend\models\Status;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CountriesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Countries';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-md-12 countries-index">
    <div class="card">
        <div class="card-header" data-background-color="blue">
            <h1 class="title"><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="pull-right action-button">
                <?= Html::a('Create Countries', ['create'], ['class' => 'btn btn-success']) ?>
                <?= Html::a('Back', Yii::$app->request->referrer, ['class' => 'btn btn-info fa fa-angle-left']) ?>
        </div> 
    <div class="card-content table-responsive">    
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    // 'id',
                    //'sortname',
                    [
                        'attribute'=>'sortname',
                        'label' => 'Short Code',
                        'format'=>'raw', 
                        'filterInputOptions' => [
                            'class'       => 'form-control search-text',
                            'placeholder' => 'Type Short Code'
                         ], 
                    ],
                    //'name',
                    [
                        'attribute'=>'name',
                        'label' => 'Country Name',
                        'format'=>'raw', 
                        'filterInputOptions' => [
                            'class'       => 'form-control search-text',
                            'placeholder' => 'Type Country Name'
                         ], 
                    ],
                    //'created_by',
                    [
                        'attribute'=>'created_by',
                        'label' => 'Created By',
                        'format'=>'raw',
                        'filter'=>Html::activeDropDownList($searchModel, 'created_by', \yii\helpers\ArrayHelper::map(User::find()->orderBy('id')->all(),'id', 'username'),['class'=>'form-control','prompt' => 'All User']),
                        'value'=>function($data){
                            return (($data->created_by)? $data->createdBy->username :false );
                          },
                    ],
                    //'created_date',
                    [
                        'attribute'=>'created_date',
                        'format'=>'raw',
                        'filter'=>
                          DatePicker::widget([
                             'name'  => 'CountriesSearch[created_date]',
                             'options' => ['placeholder' => 'Create Date'],
                             'pluginOptions' => [
                            'todayHighlight' => true,
                            'autoclose' => true,
                            'format' => 'yyyy-mm-dd',
                            ], 
                              ]),
                        'value'=>function($data){
                            return $data->created_date;
                        },
                    ],
                    // 'updated_by',
                    [
                        'attribute'=>'updated_by',
                        'label' => 'Updated By',
                        'format'=>'raw',
                        'filter'=>Html::activeDropDownList($searchModel, 'updated_by', \yii\helpers\ArrayHelper::map(User::find()->orderBy('id')->all(),'id', 'username'),['class'=>'form-control','prompt' => 'All User']),
                        'value'=>function($data){
                            return (($data->updated_by)? $data->updatedBy->username :false );
                          },
                    ],
                    //'updated_date',
                    [
                        'attribute'=>'updated_date',
                        'format'=>'raw',
                        'filter'=>
                          DatePicker::widget([
                             'name'  => 'CountriesSearch[updated_date]',
                             'options' => ['placeholder' => 'Update Date'],
                             'pluginOptions' => [
                            'todayHighlight' => true,
                            'autoclose' => true,
                            'format' => 'yyyy-mm-dd',
                            ], 
                              ]),
                        'value'=>function($data){
                            return $data->updated_date;
                        },
                    ],
                    //'status_id',
                    [
                        'attribute'=>'status_id',
                        'label' => 'Status',
                        'format'=>'raw',
                        'filter'=>Html::activeDropDownList($searchModel, 'status_id', \yii\helpers\ArrayHelper::map(Status::find()->orderBy('id')->all(),'id', 'title'),['class'=>'form-control','prompt' => 'Select Status']),
                        'value'=>function($data){
                            return (($data->status_id)? $data->status->title :false );
                          },
                    ],

                    [
                        'header' => 'Actions',
                        'class' => 'yii\grid\ActionColumn',
                        'contentOptions' => ['class' => 'action-td'],
                    ],
                ],
            ]); ?>
        </div>
    </div>
</div>

