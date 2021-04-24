$(document).ready(function(){
	
	$('#t_volunteer_events').DataTable({
		"dom": 'Blfrtip',
		"ordering":false,
		"bLengthChange": false,
		"searching": false,
		"paging": false,
		"ajax":{
			url:"volunteer-opportunities-action.php",
			type:"POST",
			data:{
					action:'listVolunteerOpportunities'
				 },
			dataType:"json"
		}
	});
	
});