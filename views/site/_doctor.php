<?php
use yii\helpers\Url;
use yii\bootstrap\Html;

$appointmentUrl = Url::to ( [ 
		'site/appointment',
		'doctor_id' => $doctor->id, 
		
] );
$backUrl = Url::previous();
?>
<div class="row">	
	<div class="col-md-12">
		<div class="well well-sm">
			<div class="media">
				<a class="thumbnail pull-left pjax-link" href="<?php echo $appointmentUrl; ?>">
					<img class="media-object" src="<?php echo $doctor->photo; ?>"
					width="100px">
				</a>
				<div class="media-body">
					<h4 class="media-heading"><?php echo $doctor->name; ?></h4>
					<p>
						<span class="label label-info"><?php echo \Yii::t('app', 'Profile approved'); ?></span>
					</p>
					<p><?php echo $doctor->description; ?></p>
					<p>
					<?php if (Yii::$app->controller->action->id == 'index') { ?>
						<a href="<?php echo $appointmentUrl; ?>" class="btn btn-default pjax-link"><span
							class="glyphicon glyphicon-time" style="padding-right: 4px;"></span><?php echo \Yii::t('app', 'Make an appointment'); ?></a>
					<?php } else { ?>
						<a href="<?php echo $backUrl; ?>" class="btn btn-default pjax-link"><span
							class="glyphicon glyphicon-list" style="padding-right: 4px;"></span><?php echo \Yii::t('app', 'To doctors list'); ?></a>
					<?php } ?>
					</p>
				</div>
			</div>
		</div>
	</div>
</div>
