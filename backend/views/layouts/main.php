<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

AppAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="container-fluid">
    <?php
    NavBar::begin([
        'brandLabel' => 'School Management System',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top container-fluid',
        ],
    ]);
if(!Yii::$app->user->isGuest){
    $menuItems = [
        ['label' => 'Home', 'url' => ['/site/index']],
        ['label' => 'User Management', 
            'url' => ['/admin/user/index'],
            'options' => ['class'=>'dropdown'],
            'template' => '<a href="{url}" class="href_class">{label}</a>',
            'items' => [
                ['label' => 'User', 'url' => ['/admin/user/index']],
                ['label' => 'User Profiles', 'url' => ['/user-profile/index']],
                ['label' => 'User Assignments', 'url' => ['/admin/assignment/index']],
                ['label' => 'User Roles', 'url' => ['/admin/role/index']],
                ['label' => 'User Permissions', 'url' => ['/admin/permission/index']],
                ['label' => 'User Routes', 'url' => ['admin/route/index']],
			]
        ],
        ['label' => 'Settings',
            'url' => ['/status/index'],
            'options' => ['class'=>'dropdown'],
            'template' => '<a href="{url}" class="href_class">{label}</a>',
            'items' => [
                ['label' => 'Status', 'url' => ['/status/index']],
                ['label' => 'Countries', 'url' => ['/countries/index']],
                ['label' => 'States', 'url' => ['/states/index']],
                ['label' => 'Cities', 'url' => ['/cities/index']],
                ['label' => 'Classes', 'url' => ['/classes/index']],
                ['label' => 'Fees', 'url' => ['/fees/index']],    
			]
        ],
        ['label' => 'Schools Mangement',
            'url' => ['/schools/index'],
            'options' => ['class'=>'dropdown'],
            'template' => '<a href="{url}" class="href_class">{label}</a>',
            'items' => [
                ['label' => 'Schools', 'url' => ['/schools/index']],   
            ]
        ],
        ['label' => 'Teachers Mangement',
            'url' => ['/teachers/index'],
            'options' => ['class'=>'dropdown'],
            'template' => '<a href="{url}" class="href_class">{label}</a>',
            'items' => [
                ['label' => 'Teachers', 'url' => ['/teachers/index']],   
            ]
        ],
        ['label' => 'Parents Mangement',
            'url' => ['/parents/index'],
            'options' => ['class'=>'dropdown'],
            'template' => '<a href="{url}" class="href_class">{label}</a>',
            'items' => [
                ['label' => 'Parents', 'url' => ['/parents/index']],   
            ]
        ],
        ['label' => 'Students Mangement',
            'url' => ['/students/index'],
            'options' => ['class'=>'dropdown'],
            'template' => '<a href="{url}" class="href_class">{label}</a>',
            'items' => [
                ['label' => 'Students', 'url' => ['/students/index']],   
            ]
        ],
    ];
}
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right container-fluid menu-bar'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>
    

    <div class="container-fluid breadcrumbs-display">
    <?php if(!Yii::$app->user->isGuest){ ?>
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
     <?php } ?>    
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>
<?php if(!Yii::$app->user->isGuest){ ?>
<footer class="footer">
    <div class="container-fluid">
        <p class="pull-left">&copy; Proton Technologies <?= date('Y') ?></p>

        <p class="pull-right"><?= 'Powered By : Proton Technologies'?></p>
    </div>
</footer>
<?php } ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
