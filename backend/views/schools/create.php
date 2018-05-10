<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Schools */

$this->title = 'Create Schools';
$this->params['breadcrumbs'][] = ['label' => 'Schools', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="col-md-8 schools-create create-form">
    <div class="card">
        <div class="card-header" data-background-color="blue">
            <h3 class="title"><?= Html::encode($this->title) ?></h3>
        </div>
        <div class="card-content schools-form">
            <?= $this->render('_form', [
                'model' => $model,
                'states'=>$states,
                'cities'=>$cities,
            ]) ?>
        </div>    
    </div>
</div> 