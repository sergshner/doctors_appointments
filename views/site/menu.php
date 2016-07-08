<?php
use yii\widgets\Menu;
use yii\helpers\Url;

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