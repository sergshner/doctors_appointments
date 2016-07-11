<?php
namespace app\views\site;
use yii\web\JsExpression;

class AppointmentJS {
	public static function onDayClick() {
		return new JsExpression("
			function(moment, element, view) {
				var endmoment = moment.clone().add(1, 'hours');

				var clientEvents = $('#w0').fullCalendar('clientEvents');
				for (var key in clientEvents) {
					var event = clientEvents[key];
					if (!(moment.isSameOrAfter(event.end.stripZone()) || endmoment.isSameOrBefore(event.start.stripZone()))) {
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
					$('#w0').fullCalendar('renderEvent', event, true);
				});
				$('#appointmentForm #closeBtn').bind( 'click', function(event) {
					$('#appointmentForm #enrollBtn').unbind('click');
					$('#appointmentForm #closeBtn').unbind('click');
					$('#w0').fullCalendar( 'rerenderEvents' )				
				});
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