$(document).ready(function(){
	
	var t_m_volunteer_event = $('#t_m_volunteer_events').DataTable({
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
			url:"manager_v-action.php",
			type:"POST",
			data:{
					action:'listEvent'
				},
			dataType:"json"
		},
		"columnDefs":[ {"targets":[0], "visible":false} ],
		"buttons": [
				{
					extend: 'excelHtml5',
					title: 'VolunteerEvents',
					filename: 'VolunteerEvents',
					exportOptions: {columns: [1,2,3,4,5,6]}
				},
				{
					extend: 'pdfHtml5',
					title: 'VolunteerEvents',
					filename: 'VolunteerEvents',
					exportOptions: {columns: [1,2,3,4,5,6]}
				},
				{
					extend: 'print',
					title: 'VolunteerEvents',
					filename: 'VolunteerEvents',
					exportOptions: {columns: [1,2,3,4,5,6]}
				}]
	});	
	
	$("#addEvent").click(function(){
		$('#event-form')[0].reset();
		$('#event-modal').modal('show');
		$('.modal-title').html("Add Event");
		$('#action').val('addEvent');
		$('#save').val('Add');
	});
	
	$("#event-modal").on('submit','#event-form', function(event){
		event.preventDefault();
		$('#save').attr('disabled','disabled');
		$.ajax({
			url:"manager_v-action.php",
			method:"POST",
			data:{
				eventID: $('#eventID').val(),
				title: $('#title').val(),
				description: $('#description').val(),
				type: $('#type').val(),
				startdate: $('#startdate').val(),
				enddate: $('#enddate').val(),
				link: $('#link').val(),
				available_spots: $('#available_spots').val(),
				needed_skills: $('#needed_skills').val(),
				age_minimum: $('#age_minimum').val(),
				organizer: $('#organizer').val(),
				approved_by: $('#approved_by').val(),
				action: $('#action').val(),
			},
			success:function(){
				$('#event-modal').modal('hide');
				$('#event-form')[0].reset();
				$('#save').attr('disabled', false);
				t_m_volunteer_event.ajax.reload();
			}
		})
	});		
	
	$("#t_m_volunteer_event").on('click', '.update', function(){
		var eventID = $(this).attr("eventID");
		var action = 'getEvent';
		$.ajax({
			url:'manager_v-action.php',
			method:"POST",
			data:{ID:eventID, action:action},
			dataType:"json",
			success:function(data){
				
				$('#event-modal').modal('show');
				$('#eventID').val(eventID);
				$('#title').val(data.title);
				$('#description').val(data.description);
				$('#type').val(data.email);
				$('#startdate').val(data.salary);
				$('#enddate').val(data.department_ID);
				$('#link').val(data.manager_ID);
				$('#available_spots').val(data.job_ID);
				$('#needed_skills').val(data.job_ID);
				$('#age_minimum').val(data.job_ID);
				$('#organizer').val(data.job_ID);
				$('#approved_by').val(data.job_ID);
				$('.modal-title').html("Edit Event");
				$('#action').val('updateEvent');
				$('#save').val('Save');
			}
		})
	});
	
	$("#t_m_volunteer_event").on('click', '.delete', function(){
		var eventID = $(this).attr("eventID");		
		var action = "deleteEvent";
		if(confirm("Are you sure you want to delete this event? This action cannot be undone.")) {
			$.ajax({
				url:'manager_v-action.php',
				method:"POST",
				data:{ID:eventID, action:action},
				success:function() {					
					t_m_volunteer_event.ajax.reload();
				}
			})
		} else {
			return false;
		}
	});
});