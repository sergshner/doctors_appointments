<?php

/* @var $this yii\web\View */

$this->title = \Yii::t('app', 'Doctors appointments');
?>
<div class="site-index">
    <div class="body-content">
    <?php 
    if (count($doctors) > 0) {
	    foreach ($doctors as $doctor) {
	    	echo $this->render('_doctor', ['doctor' => $doctor]);
	    } 
    } else {
    	echo \Yii::t('app', 'No doctors in the category');
    }
    ?>
    </div>
</div>
