<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Status */

$this->title = 'Create Status';
$this->params['breadcrumbs'][] = ['label' => 'Statuses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-md-8 status-create create-form">
    <div class="card">
        <div class="card-header" data-background-color="blue">
            <h1 class="title"><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="card-content status-form">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>    
    </div>
</div>    

