<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use yii\widgets\Menu;
use app\assets\AppAsset;
use kartik\affix\Affix;
use yii\helpers\Url;
use yii\widgets\Pjax;

AppAsset::register($this);

$script = <<< JS
    $(document).ready(function() {
        /* activate sidebar */
        $('#sidebar').affix({
            offset: {
                top: 0
            }
        });
    });
JS;
$this->registerJs($script, yii\web\View::POS_READY);
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => \Yii::t('app', 'Doctors appointments'),
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => \Yii::t('app', 'Home'), 'url' => ['/site/index']],
            ['label' => \Yii::t('app', 'About'), 'url' => ['/site/about']],
            Yii::$app->user->isGuest ? (
                ['label' => \Yii::t('app', 'Login'), 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post', ['class' => 'navbar-form'])
                . Html::submitButton(
                    \Yii::t('app', 'Logout') . ' (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
    NavBar::end();    
    ?>
    


    <div class="container">
    	<div class="row">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        </div>
        
        <div class="col-md-3" id="leftCol">
        	<?= $this->params['sidebar'] ?>
        	<?php 
        	/*
        	echo Menu::widget([
        			'items' => [
        					['label' => 'Главная', 'url' => Url::to(['site/index', 'id' => 100])],
        					['label' => 'О компании', 'url' => ['site/index', 'id' => 101]],
        					['label' => 'Услуги', 'url' => ['site/index', 'id' => 102]],
        					['label' => 'Контакты', 'url' => ['site/index', 'id' => 103]],
        			],
        			'options' => [
        					'id'=>'sidebar',
        					'class' => 'nav nav-stacked',
        			],
        			'activeCssClass'=>'active',
        			'firstItemCssClass'=>'fist',
        			'lastItemCssClass' =>'last',
        	]);
        	*/
        	?>

	    </div><!--/left-->
      <?php $pjax = Pjax::begin(['linkSelector' => '#sidebar a']); ?>
      	<!--right-->
        <div class="col-md-9">        
        	<?= $content ?>
        </div>
        <?php Pjax::end(); ?>
	</div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

        
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
