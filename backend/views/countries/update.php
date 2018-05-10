<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Countries */

$this->title = 'Update Countries: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Countries', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>

<div class="col-md-8 countries-update create-form">
    <div class="card">
        <div class="card-header" data-background-color="blue">
            <h1 class="title"><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="card-content countries-form">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>    
    </div>
</div>
