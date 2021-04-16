$(document).ready(function(){
	
	$('#table-volunteer-opportunities').DataTable({
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