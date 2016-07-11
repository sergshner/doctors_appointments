<?php
use app\views\site\AppointmentJS;
use yii\bootstrap\Modal;
use yii\bootstrap\Button;
use yii\bootstrap\Html;

/* @var $this yii\web\View */

$this->title = \Yii::t ( 'app', 'Doctors appointments' ) . ' ' . $doctor->name;
?>
<div class="site-index">
	<div class="body-content">
    	<?php
				echo $this->render ( '_doctor', [ 
						'doctor' => $doctor 
				] );
		?>
	    <div>
	    <?php		
				$events = array ();
				// Testing
				$Event = new \yii2fullcalendar\models\Event ();
				$Event->id = 1;
				$Event->title = 'Testing';
				$Event->start = date ( 'Y-m-d\TH:i:s\Z' );
				$Event->editable = true;
				$events [] = $Event;
				
				$Event = new \yii2fullcalendar\models\Event ();
				$Event->id = 2;
				$Event->title = 'Testing';
				$Event->start = date ( 'Y-m-d\TH:i:s\Z', strtotime ( 'tomorrow 6am' ) );
				$Event->editable = true;
				$Event->durationEditable = true;
				$events [] = $Event;
				
				echo \yii2fullcalendar\yii2fullcalendar::widget ( [ 
						'options' => [ 
								'lang' => 'ru' 
						]
						,
						'header' => [ 
								'left' => 'prev,next,today',
								'center' => 'title',
								'right' => 'agendaWeek' 
						],
						'clientOptions' => [ 
								
								'defaultView' => 'agendaWeek',
								
								'selectable' => false,
								'selectHelper' => true,
								// 'editable' => true,
								'eventOverlap' => false,
								'select' => AppointmentJS::onSelect(),
								'dayClick' => AppointmentJS::onDayClick(),
								'eventClick' => AppointmentJS::onEventClick(),
						],
						
						'events' => $events 
				] );
				?>
	    </div>
	    
	    <?php 
	    Modal::begin([
	    		'header' => '<h2><i class="glyphicon glyphicon-thumbs-up" style="padding-right: 10px;"></i>' . \Yii::t ( 'app', 'Appointment approve' ) . '</h2>',
	    		'id' => 'appointmentForm',
	    		'headerOptions' => [ 'class' => 'modal-header-success'],
	    ]);
	    
	    echo Html::label(\Yii::t ( 'app', 'FIO' ));
	    echo Html::input('input', 'fio', '', ['class' => 'form-control', 'id' => 'fio']);
	    ?>
	    <div class="modal-footer">
	    <?php 
	    echo Button::widget([
	    		'id' => 'closeBtn',
	    		'label' => \Yii::t ( 'app', 'Close' ),
	    		'options' => ['class' => 'btn btn-default', 'data-dismiss' => 'modal'],
	    ]);
	    
	    echo Button::widget([
	    		'id' => 'enrollBtn',
	    		'label' => \Yii::t ( 'app', 'Enroll' ),
	    		'options' => ['class' => 'btn btn-primary'],
	    ]);
	    ?>
	    </div>
	    <?php
	    Modal::end();
	    ?>
	    
     	<?php 
	    Modal::begin([
	    		'header' => '<h2><i class="glyphicon glyphicon-thumbs-down" style="padding-right: 10px;"></i>' . \Yii::t ( 'app', 'Appointment approve' ) . '</h2>',
	    		'id' => 'appointmentAlert',
	    		'headerOptions' => [ 'class' => 'modal-header-warning'],
	    ]);
	    
	    echo \Yii::t ( 'app', 'Appointment on this datetime is not possible' );
	    ?>
	    <div class="modal-footer">
	    <?php 
	    echo Button::widget([
	    		'id' => 'closeBtn',
	    		'label' => \Yii::t ( 'app', 'Close' ),
	    		'options' => ['class' => 'btn btn-default', 'data-dismiss' => 'modal'],
	    ]);
	    ?>
	    </div>
	    <?php
	    Modal::end();
	    ?>
	</div>
</div>
