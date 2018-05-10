<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Status */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Statuses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-md-12 status-view">
        <div class="card">
        <div class="card-header" data-background-color="blue">
                <h1 class="title"><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="pull-right action-button">
                    <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                    <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => 'Are you sure you want to delete this item?',
                            'method' => 'post',
                        ],
                    ]) ?>
                    <?= Html::a('Back', Yii::$app->request->referrer, ['class' => 'btn btn-info fa fa-angle-left']) ?>
        </div>
        <div class="card-content table-responsive">
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'id',
                        'title',
                        // 'created_by',
                        [
                            'attribute'=>'created_by',
                            'label' => 'Created By',
                            'format'=>'raw',
                            'value'=>function($data){
                                return (($data->created_by)? $data->createdBy->username :false );
                              },
                        ],
                        'created_date',
                        // 'updated_by',
                        [
                            'attribute'=>'updated_by',
                            'label' => 'Updated By',
                            'format'=>'raw',
                            'value'=>function($data){
                                return (($data->updated_by)? $data->updatedBy->username :false );
                              },
                        ],
                        'updated_date',
                        // 'status',
                    ],
                ]) ?>
        </div>        
    </div>
</div>
