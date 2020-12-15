/* Abhilash script starts */
$(document).ready(function(){

	var site_url = 'http://localhost:8080/RTA/';
	
	$('#country').change(function(){
		var selectedCountry = $('#country').val();;
		var options = '<option value="0">Select State</option>';
		if(selectedCountry){
			$.ajax({
				url: site_url+'Base/ajax_get_states_by_country/'+selectedCountry,
				type: 'GET',
				success: function (data) {
					var myJSONObject = JSON.parse(data);
					for (var i=0; i < myJSONObject.length;i++){
						options += '<option value="'+myJSONObject[i].id+'">'+myJSONObject[i].state_name+'</option>';
					}
					if(myJSONObject.length > 0){
						$('#state').html(options);
						$('select#state').prop('disabled',null);
						$('#location').html('<option value="0">--Select Location--</option>');
					}
					else{
						$('#state').html(options);
						$('select#state').prop('disabled',true);
						$('#location').html('<option value="0">--Select Location--</option>');
					}
				}
			});
		}
	});

	$('#jobseeker_filters #states_list input[type=checkbox]').on('change', function(){
		$.post(site_url+'base/ajax_render_location_filters', $("#jobseeker_filters_form").serialize()).done(function(data){
			if(data){
				$('#locations_message').hide();
				$('#locations_list').html(data);
			}
			else{
				$('#locations_message').show();
				$('#locations_list').html('');
			}
		});
	});

/* Abhilash code for RTA starts */
	$('#location_filters #states_list input[type=checkbox]').on('change', function(){
		$.post(site_url+'ajax/ajax_render_location_filters', $("#location_filters_form").serialize()).done(function(data){
			if(data){
				$('#locations_message').hide();
				$('#locations_list').html(data);
			}
			else{
				$('#locations_message').show();
				$('#locations_list').html('');
			}
		});
	});

	$('#location_filters').on('change', 'input[type=checkbox]', function(){
		$('#search_loader').show();  
		$.post(site_url+'ajax/ajax_search_photos', $("#location_filters_form").serialize()).done(function(data){
			$('#search_loader').hide();
			$('#Matched_photos').html(data);
		});
		$.post(site_url+'ajax/ajax_search_videos', $("#location_filters_form").serialize()).done(function(data){
			$('#search_loader').hide();
			$('#Matched_videos').html(data);
		});
	});
	// $('#location_filters').on('select', 'input[type=date]', function(){
	// 	$.post(site_url+'ajax/ajax_search_videos', $("#location_filters_form").serialize()).done(function(data){
	// 		$('#search_loader').hide();
	// 		$('#Matched_videos').html(data);
	// 	});
	// });
/* Abhilash code for RTA ends */

	$('#jobseeker_filters #categories_list input[type=checkbox]').on('change', function(){
		$.post(site_url+'base/ajax_render_departments_filters', $("#jobseeker_filters_form").serialize()).done(function(data){
			if(data){
				$('#departments_message').hide();
				$('#departments_list').html(data);
			}
			else{
				$('#departments_message').show();
				$('#departments_list').html('');
			}
		});
	});
/*
	$('#jobseeker_filters').on('change', 'input[type=checkbox]', function(){
		$('#search_loader').show();
		$.post(site_url+'base/ajax_search_contractors_team', $("#jobseeker_filters_form").serialize()).done(function(data){
			$('#search_loader').hide();
			$('#Filtered_Contractors_Team').html(data);
		});
	});

	$('#jobseeker_filters').on('change', 'input[type=checkbox]', function(){
		$('#search_loader').show();
		$.post(site_url+'base/ajax_search_suppliers_team', $("#jobseeker_filters_form").serialize()).done(function(data){
			$('#search_loader').hide();
			$('#Filtered_Suppliers_Team').html(data);
		});
	});

	$('#jobseeker_filters').on('change', 'input[type=checkbox]', function(){
		$('#search_loader').show();
		$.post(site_url+'base/ajax_search_harvesters_team', $("#jobseeker_filters_form").serialize()).done(function(data){
			$('#search_loader').hide();
			$('#Filtered_Harvesters_Team').html(data);
		});
	});

	$('#jobseeker_filters').on('change', 'input[type=checkbox]', function(){
		$('#search_loader').show();  
		$.post(site_url+'base/ajax_search_jobseekers', $("#jobseeker_filters_form").serialize()).done(function(data){
			$('#search_loader').hide();
			$('#Matched_jobseekers').html(data);
		});
	});
*/
	$(document).on('click','#business_user_actions .btn-secondary.btn-sm',function (e) {
		$('#Matched_jobseekers .alert-dismissible').hide();
		var button_id_action = e.currentTarget.id;
		var button_id_array = button_id_action.split('-'); 
		var jobseeker_id = button_id_array[0];
		var action = button_id_array[1];
		$.ajax({
			url: site_url+'base/ajax_set_jobseeker_action/'+jobseeker_id+'/'+action,
			type: 'GET',
			success: function (data) {
				$('#Matched_jobseekers #'+button_id_action).text(action.charAt(0).toUpperCase() + action.slice(1));
				$('#Matched_jobseekers #'+button_id_action).addClass('active');
				var alert_message = "Selected jobseeker has been copied to your "+action+" list.<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button>";
				$('#Matched_jobseekers .alert-dismissible').html(alert_message);
				$('#Matched_jobseekers .alert-dismissible').show();
			},
	      	complete: function (data) {
	        refresh_list(action,jobseeker_id);
	    	}        
	   	});
	});

	$(document).on('click','#Saved_jobseekers #business_user_actions .btn-secondary.btn-sm',function (e) {
		var button_id_action = e.currentTarget.id;
	   	var button_id_array = button_id_action.split('-'); 
	   	var jobseeker_id = button_id_array[0];
	   	var action = button_id_array[1];	   
	   	$.ajax({
	      	url: site_url+'base/ajax_set_jobseeker_action/'+jobseeker_id+'/'+action,
	      	type: 'GET',
	      	success: function (data) {
	         	$('#Saved_jobseekers #'+button_id_action).text(action.charAt(0).toUpperCase() + action.slice(1));
	         	$('#Saved_jobseekers #'+button_id_action).addClass('active');
	      	}
	   	});
	});

	$(document).on('click','#job_apply #business_user_actions .btn-secondary.btn-sm',function (e) {

	   	var button_id_action = e.currentTarget.id;
	   	var button_id_array = button_id_action.split('-'); 
	   	var jobseeker_id = button_id_array[0];
	   	var action = button_id_array[1];	   
	   	$.ajax({
	      	url: site_url+'base/ajax_set_jobseeker_action/'+jobseeker_id+'/'+action,
	      	type: 'GET',
	      	success: function (data) {
	         	if(action=="applied"){
	            	$('#job_apply .alert-dismissible').removeClass('hide');
	            	$('#job_apply .alert-dismissible').addClass('show');
	         	}        
	         	$('#job_apply #'+button_id_action).text(action.charAt(0).toUpperCase() + action.slice(1));
	         	$('#job_apply #'+button_id_action).addClass('active');
	      	}
	   	});
	});

	function refresh_list(action, jobseeker_id){
		$.ajax({
			url: site_url+'base/ajax_get_jobseekers_by_action/'+action,
			type: 'GET',
			success: function (data) {
				$('#'+action.charAt(0).toUpperCase()+action.slice(1)+'_jobseekers').html(data);
			}
		});
	}

	$("#profile_pdf").on("click", function(){

		var doc = new jsPDF('p', 'mm', 'a4');

		var elementHTML = $('#jobseeker_profile').html();
		var name = $('#fullname').text();
		// var specialElementHandlers = {
		// 	'#elementH' : function (element, renderer) {
		// 		return true;
		// 	}
		// };
		doc.fromHTML(elementHTML, 15, 15, {
			'width': 100
    		// 'width': 170,
    		// 'elementHandlers': specialElementHandlers
		});
		doc.setFont("courier");
		doc.setFontType("normal");
		doc.setFontSize(16);

		// Save the PDF
		doc.save(name+'-profile.pdf');
	});
	
});
/* Abhilash script ends */