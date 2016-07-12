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

			$Event = new \yii2fullcalendar\models\Event ();
			
			$Event->id = 0;
			$Event->title = 'Testing';
			$Event->start = date ( 'Y-m-d\TH:00:00\Z' );
			$Event->end = date ( 'Y-m-d\TH:00:00\Z', strtotime('+1 hour') );
			$Event->allDay = false;
			$Event->editable = true;
			$events [] = $Event;
			foreach ($appointments as $appointment) {
				$Event = new \yii2fullcalendar\models\Event ();
				$Event->id = $appointment->id;
				$Event->title = $appointment->title;
				$Event->start = gmdate ( 'Y-m-d\TH:i:00\Z', $appointment->start);
				$Event->end = gmdate ( 'Y-m-d\TH:i:00\Z', $appointment->end );
				$events [] = $Event;
			}
			echo \yii2fullcalendar\yii2fullcalendar::widget ( [ 
					'id' => 'fCalendar',
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
							'businessHours' => [
							    'start' => '9:00',
							    'end' => '19:00',
							
							    'dow' => [ 1, 2, 3, 4, 5, 6 ]							
							]
					],
					
					'events' => $events 
			] );
		?>
	    
	    
	    <?php 
	    Modal::begin([
	    		'header' => '<h2><i class="glyphicon glyphicon-thumbs-up" style="padding-right: 10px;"></i>' . \Yii::t ( 'app', 'Appointment approve' ) . '</h2>',
	    		'id' => 'appointmentForm',
	    		'headerOptions' => [ 'class' => 'modal-header-success'],
	    ]);
	    
	    echo Html::label(\Yii::t ( 'app', 'FIO' ));
	    echo Html::input('input', 'fio', '', ['class' => 'form-control', 'id' => 'fio']);
	    echo Html::input('hidden', 'doctor_id', $doctor->id, ['class' => 'form-control', 'id' => 'doctor_id']);
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
</div>
