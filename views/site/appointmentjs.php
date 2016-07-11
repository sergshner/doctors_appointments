<?php
namespace app\views\site;
use yii\web\JsExpression;

class AppointmentJS {
	public static function onDayClick() {
		return new JsExpression("
			function(moment, element, view) {
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
				
					var clientEvents = $('#w0').fullCalendar('clientEvents');
					for (var key in clientEvents) {
						var event = clientEvents[key];
						console.log(event);
					}
				
					var endmoment = moment.clone().add(1, 'hours');
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
				var title = prompt('Event Title:');
      		}
		");
	}
}