<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = \Yii::t('app', 'About');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        Это демо проект, показывающий реализацию механизма записи к врачу поликлиники в упрощённом виде.
    </p>

    <code><?= __FILE__ ?></code>
</div>
