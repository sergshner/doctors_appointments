<?php
namespace app\views\site;
use yii\web\JsExpression;
use Yii;

class AppointmentJS {
	public static function onDayClick() {
		return new JsExpression("
			function(moment, element, view) {
				var endmoment = moment.clone().add(1, 'hours');

				var clientEvents = $('#fCalendar').fullCalendar('clientEvents');
				for (var key in clientEvents) {
					var event = clientEvents[key];

					if (!(moment.isSameOrAfter(event.end.stripZone()) 
						|| endmoment.isSameOrBefore(event.start.stripZone()))
						|| !(moment.hours() >= parseInt(view.calendar.options.businessHours.start) && endmoment.hours() <= parseInt(view.calendar.options.businessHours.end))
						|| (view.calendar.options.businessHours.dow.indexOf(moment.days()) < 0)) {
						$('#appointmentAlert').modal('show');
						return;
					}
				}
				
				$('#appointmentForm #fio').val('');
				$('#appointmentForm').on('shown.bs.modal', function () {
					$('#appointmentForm').off('shown.bs.modal');	
				    $('#appointmentForm #fio').focus();
				})
				$('#appointmentForm').modal('show');
				

				$('#appointmentForm #enrollBtn').bind( 'click', function(event) {
					$('#appointmentForm #enrollBtn').unbind('click');
					$('#appointmentForm #closeBtn').unbind('click');
					$('#appointmentForm').modal('hide');
					
					event = {
						title: $('#appointmentForm #fio').val(),
						start: moment,
						end: endmoment,				
					};
					
					$.ajax({
				       url: '" . Yii::$app->request->baseUrl . "/site/appointmentsave',
				       type: 'post',
				       data: {
				             	event: {
									title: $('#appointmentForm #fio').val(),
									start: moment.unix(),
									end: endmoment.unix(),
									doctor_id: $('#appointmentForm #doctor_id').val(),
								}, 
				                 _csrf : '" . Yii::$app->request->getCsrfToken() . "'
				             },
				       success: function (data) {
				          	console.log(data.search);
							$('#fCalendar').fullCalendar('renderEvent', event, true);
				       }
				  	});
				
					
				});
				$('#appointmentForm #closeBtn').bind( 'click', function(event) {
					$('#appointmentForm #enrollBtn').unbind('click');
					$('#appointmentForm #closeBtn').unbind('click');
					$('#fCalendar').fullCalendar( 'rerenderEvents' )				
				});
				$('#appointmentForm').on('hidden.bs.modal', function () {
				    $('#appointmentForm #enrollBtn').unbind('click');
					$('#appointmentForm #closeBtn').unbind('click');
					$('#fCalendar').fullCalendar( 'rerenderEvents' )
				})
			}
		");
	}
	
	public static function onEventClick() {
		return new JsExpression("
			function(calEvent, jsEvent, view) {
				$('#appointmentAlert').modal('show');
			}
		");
	}
	
	public static function onSelect() {
		return new JsExpression("
			function(start, end) {
      		}
		");
	}
}