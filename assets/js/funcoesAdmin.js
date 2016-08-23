$(function(){
  	$('.classe_alerta').delay(5000).fadeOut(5000);

 	var functionSelect = $('#functionSelect').val();

	if(functionSelect == 2){
		$('#driverAdd').collapse("show");
	}else{
		$('#driverAdd').collapse("hide");
	}

	$('link').click(function(){
		alert('chegou!!');
	});

	var tz = jstz.determine(); // Determines the time zone of the browser client
    var timezone = tz.name(); //'Asia/Kolhata' for Indian Time.
    $('#timezone').val(timezone);

});

function truncateText(str, length) {
	return str.length > length ? str.substring(0, length - 3) + '...' : str
}

