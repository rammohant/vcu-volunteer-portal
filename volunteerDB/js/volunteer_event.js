$(document).ready(function(){
	
	$('#volunteer_events').DataTable({
		"dom": 'Blfrtip',
		"ordering":false,
		"bLengthChange": false,
		"searching": false,
		"paging": false,
		"ajax":{
			url:"volunteer_event-action.php",
			type:"POST",
			data:{
					action:'listVolunteerEvent'
				 },
			dataType:"json"
		}
	});
	
});