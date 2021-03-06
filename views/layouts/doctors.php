<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
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
		$.ajaxSetup ({
			cache: true
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
	    </div><!--/left-->
      	<!--right-->
        <div class="col-md-9"> 
      	<?php $pjax = Pjax::begin(['id' => 'test', 'linkSelector' => '#sidebar a, .pjax-link', 'scrollTo' => 1]); ?>       
       		<?= $content ?>
       	<?php Pjax::end(); ?>
        </div>
       
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
