$(document).ready(function(){
	
	var t_volunteer_signup = $('#volunteer_signup').DataTable({
		"dom": 'Blfrtip',
		"autoWidth": false,
		"processing":true,
		"serverSide":true,
		"pageLength":15,
		"lengthMenu":[[15, 25, 50, 100, -1], [15, 25, 50, 100, "All"]],
		"processing": true,
		"language": {processing: '<i class="fa fa-spinner fa-spin fa-2x fa-fw"></i>'},
		"order":[],
		"ajax":{
			url:"user_v-action.php",
			type:"POST",
			data:{
					action:'listVolunteerSignup'
				},
			dataType:"json"
		},
		"columnDefs":[ {"targets":[0], "visible":false} ],
		"buttons": [
				{
					extend: 'excelHtml5',
					title: 'Volunteer Events',
					filename: 'Volunteer Events',
					exportOptions: {columns: [1,2,3,4,5,6]}
				},
				{
					extend: 'pdfHtml5',
					title: 'Volunteer Events',
					filename: 'Volunteer Events',
					exportOptions: {columns: [1,2,3,4,5,6]}
				},
				{
					extend: 'print',
					title: 'Volunteer Events',
					filename: 'Volunteer Events',
					exportOptions: {columns: [1,2,3,4,5,6]}
				}]
	});	
	
	
	$("#volunteer_signup").on('click', '.delete', function(){
		var ID = $(this).attr("signupID");		
		var action = "deleteSignup";
		if(confirm("Are you sure you want to cancel this volunteer event sign up?")) {
			$.ajax({
				url:'user_v-action.php',
				method:"POST",
				data:{ID:ID, action:action},
				success:function() {					
					t_volunteer_signup.ajax.reload();
				}
			})
		} else {
			return false;
		}
	});
});