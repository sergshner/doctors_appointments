<?php
use yii\widgets\Menu;
use yii\helpers\Url;

$menuItems = [];
foreach ($doctorsSpecialities as $speciality) {
	$menuItems[] = ['label' => $speciality->name, 'url' => Url::to(['site/index', 'id' => $speciality->id])];
}

echo Menu::widget([
		'items' => $menuItems,
		'options' => [
				'id'=>'sidebar',
				'class' => 'nav nav-stacked',
		],
		'activeCssClass'=>'active',
		'firstItemCssClass'=>'fist',
		'lastItemCssClass' =>'last',
]);