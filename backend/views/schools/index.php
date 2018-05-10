<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SchoolsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Schools';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-md-12 schools-index">
    <div class="card">
        <div class="card-header" data-background-color="blue">
            <h1 class="title"><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="pull-right action-button">
                <?= Html::a('Create School', ['create'], ['class' => 'btn btn-success']) ?>
                <?= Html::a('Back', Yii::$app->request->referrer, ['class' => 'btn btn-info fa fa-angle-left']) ?>
        </div> 
        <div class="card-content table-responsive">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                //'id',
                //'title',
                [
                    'attribute'=>'title',
                    'label' => 'School Name',
                    'format'=>'raw', 
                    'filterInputOptions' => [
                        'class'       => 'form-control search-text',
                        'placeholder' => 'Type School Name'
                     ], 
                ],
                //'ower_name',
                [
                    'attribute'=>'ower_name',
                    'label' => 'Owner Name',
                    'format'=>'raw', 
                    'filterInputOptions' => [
                        'class'       => 'form-control search-text',
                        'placeholder' => 'Type Owner Name'
                     ], 
                ],
                //'phone_no',
                [
                    'attribute'=>'phone_no',
                    'label' => 'Phone Number',
                    'format'=>'raw', 
                    'filterInputOptions' => [
                        'class'       => 'form-control search-text',
                        'placeholder' => 'Type Phone Number'
                     ], 
                ],
                //'email:email',
                //'cnic',
                //'address:ntext',
                [
                    'attribute'=>'address',
                    'label' => 'Address',
                    'format'=>'raw', 
                    'filterInputOptions' => [
                        'class'       => 'form-control search-text',
                        'placeholder' => 'Type Address'
                     ], 
                ],
                // 'logo',
                // 'user_id',
                // 'country_id',
                //'state_id',
                // [
                //     'attribute'=>'state_id',
                //     'label' => 'State Name',
                //     'format'=>'raw', 
                //     'filterInputOptions' => [
                //         'class'       => 'form-control search-text',
                //         'placeholder' => 'Type State Name'
                //      ], 
                // ],
                //'city_id',
                [
                    'attribute'=>'city_id',
                    'label' => 'City Name',
                    'format'=>'raw', 
                    'filterInputOptions' => [
                        'class'       => 'form-control search-text',
                        'placeholder' => 'Type City Name'
                     ], 
                ],
                // 'created_by',
                // 'created_date',
                // 'updated_by',
                // 'updated_date',
                // 'status_id',

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
        </div>
    </div>
</div>  
