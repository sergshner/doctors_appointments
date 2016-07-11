<?php

/* @var $this yii\web\View */

$this->title = \Yii::t('app', 'Doctors appointments');
?>
<div class="site-index">
    <div class="body-content">
    <?php 
    foreach ($doctors as $doctor) {
    	echo $this->render('_doctor', ['doctor' => $doctor]);
    }
    ?>
    </div>
</div>
