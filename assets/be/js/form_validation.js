
/* ========================================================
*
* Euro Golden Bet
*
* ========================================================
*
* File: form_validation.js;
* Description: Custom form validation settings.
* Version: 1.0
*
* ======================================================== */



$(function() {
	
		/* # Multibets Form
	================================================== */
	$(".set-system-admin-form").validate({
		errorPlacement: function(error, element) {
			if (element.parent().parent().attr("class") == "checker" || element.parent().parent().attr("class") == "choice" ) {
		      error.appendTo( element.parent().parent().parent().parent().parent() );
		    } 
			else if (element.parent().parent().attr("class") == "checkbox" || element.parent().parent().attr("class") == "radio" ) {
		      error.appendTo( element.parent().parent().parent() );
		    } 
		    else {
		      error.insertAfter(element);
		    }
		},
		rules: {
			first_name: {
				required: true,
				maxlength: 50
			},
		},
		rules: {
			last_name: {
				required: true,
				maxlength: 50
			},
		},
		rules: {
			email_address: {
				required: true,
				maxlength: 300,
				email: true
			},
		},
		rules: {
			user_password: {
				required: true
			},
		},
		rules: {
			confirm_password: {
				required: true,
				equalTo: "#user_password"
			},
		},
		messages: {
			first_name: {
				required: "This field is required",
				maxlength: "Please enter no more than 50 characters",
			},		
			confirm_password: {
				required: "This field is required",
				equalTo: "Please retype the correct password",
			},
		},
	    success: function(label) {
	    	label.text('').addClass('valid hidden');
	    }
	});


/* # Multibets Form
================================================== */

	$(".multibets-form").validate({
		errorPlacement: function(error, element) {
			if (element.parent().parent().attr("class") == "checker" || element.parent().parent().attr("class") == "choice" ) {
		      error.appendTo( element.parent().parent().parent().parent().parent() );
		    } 
			else if (element.parent().parent().attr("class") == "checkbox" || element.parent().parent().attr("class") == "radio" ) {
		      error.appendTo( element.parent().parent().parent() );
		    } 
		    else {
		      error.insertAfter(element);
		    }
		},
		rules: {
			multibet_name: {
				required: true,
				maxlength: 300
			},
		},
		messages: {
			custom_message: {
				required: "This field is required",
			},
			agree: "Please accept our policy"
		},
	    success: function(label) {
	    	//label.text('Success!').addClass('valid');
	    }
	});

/* # Tips Categories Form
================================================== */

	$(".tips-categories-form").validate({
		errorPlacement: function(error, element) {
			if (element.parent().parent().attr("class") == "checker" || element.parent().parent().attr("class") == "choice" ) {
		      error.appendTo( element.parent().parent().parent().parent().parent() );
		    } 
			else if (element.parent().parent().attr("class") == "checkbox" || element.parent().parent().attr("class") == "radio" ) {
		      error.appendTo( element.parent().parent().parent() );
		    } 
		    else {
		      error.insertAfter(element);
		    }
		},
		rules: {
			tips_category_name: {
				required: true,
				maxlength: 300
			},
		},
		messages: {
			custom_message: {
				required: "This field is required",
			},
			agree: "Please accept our policy"
		},
	    success: function(label) {
	    	//label.text('Success!').addClass('valid');
	    }
	});
	
/* # Departments Form
================================================== */

	$(".departments-form").validate({
		errorPlacement: function(error, element) {
			if (element.parent().parent().attr("class") == "checker" || element.parent().parent().attr("class") == "choice" ) {
		      error.appendTo( element.parent().parent().parent().parent().parent() );
		    } 
			else if (element.parent().parent().attr("class") == "checkbox" || element.parent().parent().attr("class") == "radio" ) {
		      error.appendTo( element.parent().parent().parent() );
		    } 
		    else {
		      error.insertAfter(element);
		    }
		},
		rules: {
			department_name: {
				required: true,
				maxlength: 300
			},
		},
		messages: {
			custom_message: {
				required: "This field is required",
			},
			agree: "Please accept our policy"
		},
	    success: function(label) {
	    	//label.text('Success!').addClass('valid');
	    }
	});

/* # Access Levels Form
================================================== */

	$(".access-levels-form").validate({
		errorPlacement: function(error, element) {
			if (element.parent().parent().attr("class") == "checker" || element.parent().parent().attr("class") == "choice" ) {
		      error.appendTo( element.parent().parent().parent().parent().parent() );
		    } 
			else if (element.parent().parent().attr("class") == "checkbox" || element.parent().parent().attr("class") == "radio" ) {
		      error.appendTo( element.parent().parent().parent() );
		    } 
		    else {
		      error.insertAfter(element);
		    }
		},
		rules: {
			access_level_name: {
				required: true,
				maxlength: 300
			},
		},
		messages: {
			custom_message: {
				required: "This field is required",
			},
			agree: "Please accept our policy"
		},
	    success: function(label) {
	    	//label.text('Success!').addClass('valid');
	    }
	});

/* # Bookies Form
================================================== */

	$(".bookies-form").validate({
		errorPlacement: function(error, element) {
			if (element.parent().parent().attr("class") == "checker" || element.parent().parent().attr("class") == "choice" ) {
		      error.appendTo( element.parent().parent().parent().parent().parent() );
		    } 
			else if (element.parent().parent().attr("class") == "checkbox" || element.parent().parent().attr("class") == "radio" ) {
		      error.appendTo( element.parent().parent().parent() );
		    } 
		    else {
		      error.insertAfter(element);
		    }
		},
		rules: {
			bookie_name: {
				required: true,
				maxlength: 300
			},
		},
		messages: {
			custom_message: {
				required: "This field is required",
			},
			agree: "Please accept our policy"
		},
	    success: function(label) {
	    	//label.text('Success!').addClass('valid');
	    }
	});

/* # Daily Tips Entry Form
================================================== */

	$(".daily-tips-form").validate({
		errorPlacement: function(error, element) {
			if (element.parent().parent().attr("class") == "checker" || element.parent().parent().attr("class") == "choice" ) {
		      error.appendTo( element.parent().parent().parent().parent().parent() );
		    } 
			else if (element.parent().parent().attr("class") == "checkbox" || element.parent().parent().attr("class") == "radio" ) {
		      error.appendTo( element.parent().parent().parent() );
		    } 
		    else {
		      error.insertAfter(element);
		    }
		},
		rules: {
			daily_tip_date: {
				required: true,
				date: true
			},
			is_free: {
				required: true
			},
			home_team: {
				required: true,
				maxlength: 300
			},
			away_team: {
				required: true,
				maxlength: 300
			},
			odds: {
				required: true,
				maxlength: 50
			},
			pick: {
				required: true,
				maxlength: 50
			},
			
		},
		messages: {
			custom_message: {
				required: "This field is required",
			},
			agree: "Please accept our policy"
		},
	    success: function(label) {
	    	//label.text('Success!').addClass('valid');
	    }
	});

/* # Daily Tips Entry Form
================================================== */

	$(".customers-form").validate({
		errorPlacement: function(error, element) {
			if (element.parent().parent().attr("class") == "checker" || element.parent().parent().attr("class") == "choice" ) {
		      error.appendTo( element.parent().parent().parent().parent().parent() );
		    } 
			else if (element.parent().parent().attr("class") == "checkbox" || element.parent().parent().attr("class") == "radio" ) {
		      error.appendTo( element.parent().parent().parent() );
		    } 
		    else {
		      error.insertAfter(element);
		    }
		},
		rules: {
			customer_name: {
				required: true,
				maxlength: 300
			},
			phone_number: {
				required: true,
				maxlength: 100
			},
			email_address: {
				email: true
			},
			change_password: {
				required: true
			},
			access_code: {
				required: true,
				maxlength: 50
			},
			pick: {
				required: true,
				maxlength: 50
			},
			
		},
		messages: {
			custom_message: {
				required: "This field is required",
			},
			agree: "Please accept our policy"
		},
	    success: function(label) {
	    	//label.text('Success!').addClass('valid');
	    }
	});

/* # Jackpots Form
================================================== */

	$(".jackpots-form").validate({
		errorPlacement: function(error, element) {
			if (element.parent().parent().attr("class") == "checker" || element.parent().parent().attr("class") == "choice" ) {
		      error.appendTo( element.parent().parent().parent().parent().parent() );
		    } 
			else if (element.parent().parent().attr("class") == "checkbox" || element.parent().parent().attr("class") == "radio" ) {
		      error.appendTo( element.parent().parent().parent() );
		    } 
		    else {
		      error.insertAfter(element);
		    }
		},
		rules: {
			bookie_id: {
				required: true
			},
			publish: {
				required: true
			},
			jackpot_amount: {
				required: true
			},
			jackpot_period: {
				required: true
			}
		},
		messages: {
			custom_message: {
				required: "This field is required",
			},
			agree: "Please accept our policy"
		},
	    success: function(label) {
	    	//label.text('Success!').addClass('valid');
	    }
	});
	
/* # Jackpot Details Form
================================================== */

	$(".jackpot-details-form").validate({
		errorPlacement: function(error, element) {
			if (element.parent().parent().attr("class") == "checker" || element.parent().parent().attr("class") == "choice" ) {
		      error.appendTo( element.parent().parent().parent().parent().parent() );
		    } 
			else if (element.parent().parent().attr("class") == "checkbox" || element.parent().parent().attr("class") == "radio" ) {
		      error.appendTo( element.parent().parent().parent() );
		    } 
		    else {
		      error.insertAfter(element);
		    }
		},
		rules: {
			match_position: {
				required: true,
				digits: true
			},
			match_date: {
				required: true,
				date: true
			},
			match_time: {
				required: true
			},
			pick: {
				required: true
			},
			home_team: {
				required: true
			},
			draw: {
				required: true
			},
			away_time: {
				required: true
			}
		},
		messages: {
			custom_message: {
				required: "This field is required",
			},
			agree: "Please accept our policy"
		},
	    success: function(label) {
	    	//label.text('Success!').addClass('valid');
	    }
	});
	

});