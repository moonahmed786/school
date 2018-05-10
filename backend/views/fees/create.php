<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Fees */

$this->title = 'Create Fees';
$this->params['breadcrumbs'][] = ['label' => 'Fees', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fees-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
