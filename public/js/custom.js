$( document ).ready(function() {
    $.ajaxSetup({
	    headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    }
	});
});


$('.change-state').on('click', function() {
	var task_id = $(this).attr('id');

	$.ajax({
	  url: "./change/" + task_id,
	  context: document.body,
	  success: function(response) {
	  	if(response.status == 'success')
	  		location.reload();
	  }
	});
});


$('.delete-task').on('click', function() {
	var task_id = $(this).attr('id');

	$.ajax({
	  url: "./task/" + task_id + "/delete",
	  method: 'DELETE',
	  context: document.body,
	  success: function(response) {
	  	if(response.status == 'success')
	  		location.reload();
	  }
	});
});

$('.delete-user').on('click', function() {
	var user_id = $(this).attr('id');

	$.ajax({
	  url: "./user/" + user_id + "/delete",
	  method: 'DELETE',
	  context: document.body,
	  success: function(response) {
	  	if(response.status == 'success')
	  		location.reload();
	  }
	});
});