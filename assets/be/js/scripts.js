function validateEmail(email) {
	var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	return re.test(email);
}
function validateNumeric(num){
    return isNaN(num);
}


//LISTING TYPES
function listing_type_add_clear(){
	//alert('Test');
	$( '#frm_addlistingtype' ).each(function(){
		this.reset();
	});	
	$div_add_listing_type_success.fadeOut("fast");
	$div_add_listing_type_error.fadeOut("fast");
}

function save_listing_type(){
		$div_add_listing_type_error = $("#div_add_listing_type_error");
		$div_add_listing_type_success = $("#div_add_listing_type_success");
				
		$add_listing_type_name = $("#add_listing_type_name").val();
		$add_listing_type_description = $("#add_listing_type_description").val();
	
		$valmsg = "";
		$valmsg2 = "";
		
		if ($add_listing_type_name == "" || $add_listing_type_name == null){$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please enter Listing Type Name <br/>";}
			
		if ($valmsg != $valmsg2){
			$div_add_listing_type_error.html($valmsg);
			$div_add_listing_type_success.fadeOut("fast");
			$div_add_listing_type_error.fadeIn("fast");
		}else{
			$div_add_listing_type_error.fadeOut("fast");
			$div_add_listing_type_success.fadeOut("fast");
				
			$("#add_listing_type_loader").show();
					
			var form = document.getElementById('frm_addlistingtype');
			var formData = new FormData(form);

			$.ajax({
            	url: baseDir+'be/listing_types/save',
            	type: 'POST',
            	data: formData,
				dataType: 'json',
            	xhr: function() {
               		var myXhr = $.ajaxSettings.xhr();
               		return myXhr;
            	},
            	cache: false,
            	contentType: false,
            	processData: false,
            	success: function (res) {
					$("#add_listing_type_loader").hide();
					if(res.status == 'ERR'){
						$div_add_listing_type_error.html(res.message);
						$div_add_listing_type_success.fadeOut("fast");
						$div_add_listing_type_error.fadeIn("fast");
					}else if (res.status == 'SUCCESS'){
						$div_add_listing_type_success.html(res.message);
						$div_add_listing_type_error.fadeOut("fast");
						$div_add_listing_type_success.fadeIn("fast");
						
						$( '#frm_addlistingtype' ).each(function(){
							this.reset();
						});	

						load_listing_types();

					}
            	},
				error: function(){
					$("#add_listing_type_loader").hide();
					$div_add_listing_type_error.html("Something went wrong. Please check your network and try again.");
					$div_add_listing_type_success.fadeOut("fast");
					$div_add_listing_type_error.fadeIn("fast");
				}
        	});
	
		}
		return false;
}
//LOAD LISTING TYPES
function load_listing_types(){
	$('#div_listing_types_loader').oLoader({
		backgroundColor:'#fff',
		image: baseDir+'assets/be/js/plugins/oLoader/images/ownageLoader/loader9.gif',
		fadeInTime: 500,
		fadeOutTime: 1000,
		fadeLevel: 0.8
	});				
	$.ajax({
     	url: baseDir+'be/listing_types/loadjs',
       	type: 'POST',
       	data: '',
       	xhr: function() {
       		var myXhr = $.ajaxSettings.xhr();
       		return myXhr;
       	},
       	cache: false,
       	contentType: false,
       	processData: false,
     	success: function (result) {
			$("#listing_types_div").html(result);
			$('#div_listing_types_loader').oLoader('hide');			
   		},
		error: function(){
			$('#div_listing_types_loader').oLoader('hide');
		}
    });
}
function listing_type_edit_load(listing_type_id){
	$.ajax({
     	url: baseDir+'be/listing_types/get_listing_type/'+listing_type_id,
       	type: 'POST',
       	data: '',
       	xhr: function() {
       		var myXhr = $.ajaxSettings.xhr();
       		return myXhr;
       	},
       	cache: false,
       	contentType: false,
       	processData: false,
     	success: function (res) {
     		try{
     			var obj1 = res;
     			obj1 = obj1.replace('[','');
     			obj1 = obj1.replace(']','');
	     		var obj = $.parseJSON(obj1);
	     		$("#edit_listing_type_id").val(obj['listing_type_id']);
	     		$("#edit_listing_type_name").val(obj['listing_type_name']);
	     		$("#edit_listing_type_description").val(obj['listing_type_description']);

     		}catch(err){
     			alert(err);
     		}
   		},
		error: function(){
		}
    });
   	$div_edit_listing_type_error.fadeOut("fast");
	$div_edit_listing_type_success.fadeOut("fast");

}
function update_listing_type(){
		$div_edit_listing_type_error = $("#div_edit_listing_type_error");
		$div_edit_listing_type_success = $("#div_edit_listing_type_success");
				
		$edit_listing_type_name = $("#edit_listing_type_name").val();
		$edit_listing_type_description = $("#edit_listing_type_description").val();
	
		$valmsg = "";
		$valmsg2 = "";
		
		if ($edit_listing_type_name == ""){$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please enter Listing Type Name <br/>";}
		
		if ($valmsg != $valmsg2){
			$div_edit_listing_type_error.html($valmsg);
			$div_edit_listing_type_success.fadeOut("fast");
			$div_edit_listing_type_error.fadeIn("fast");
		}else{
			$div_edit_listing_type_error.fadeOut("fast");
			$div_edit_listing_type_success.fadeOut("fast");
				
			$("#edit_listing_type_loader").show();
					
			var form = document.getElementById('frm_editlistingtype');
			var formData = new FormData(form);

			$.ajax({
            	url: baseDir+'be/listing_types/update',
            	type: 'POST',
            	data: formData,
				dataType: 'json',
            	xhr: function() {
               		var myXhr = $.ajaxSettings.xhr();
               		return myXhr;
            	},
            	cache: false,
            	contentType: false,
            	processData: false,
            	success: function (res) {
					$("#edit_listing_type_loader").hide();
					if(res.status == 'ERR'){
						$div_edit_listing_type_error.html(res.message);
						$div_edit_listing_type_success.fadeOut("fast");
						$div_edit_listing_type_error.fadeIn("fast");
					}else if (res.status == 'SUCCESS'){
						$div_edit_listing_type_success.html(res.message);
						$div_edit_listing_type_error.fadeOut("fast");
						$div_edit_listing_type_success.fadeIn("fast");
						
						load_listing_types();

					}
            	},
				error: function(){
					$("#edit_listing_type_loader").hide();
					$div_edit_listing_type_error.html("Something went wrong. Please check your network and try again.");
					$div_edit_listing_type_success.fadeOut("fast");
					$div_edit_listing_type_error.fadeIn("fast");
				}
        	});
	
		}
		return false;
}
function delete_listing_type(listing_type_id){
	$div_listing_type_error = $("#div_listing_type_error");
	$div_listing_type_success = $("#div_listing_type_success");

	$div_listing_type_error.fadeOut("fast");
	$div_listing_type_success.fadeOut("fast");

	$.ajax({
     	url: baseDir+'be/listing_types/delete/'+listing_type_id,
       	type: 'POST',
       	data: '',
       	xhr: function() {
       		var myXhr = $.ajaxSettings.xhr();
       		return myXhr;
       	},
       	cache: false,
       	contentType: false,
       	processData: false,
     	success: function (res) {
     		try{
     			var obj1 = res;
	     		var obj = $.parseJSON(obj1);

				if(obj['status'] == 'ERR'){
					$div_listing_type_error.html(obj['message']);
					$div_listing_type_success.fadeOut("fast");
					$div_listing_type_error.fadeIn("fast");
				}else if (obj['status'] == 'SUCCESS'){
					$div_listing_type_success.html(obj['message']);
					$div_listing_type_error.fadeOut("fast");
					$div_listing_type_success.fadeIn("fast");

					load_listing_types();
				}
     		}catch(err){
     			alert(err);
     		}    		
   		},
		error: function(){
			$div_listing_type_error.html("Something went wrong. Please check your network and try again.");
			$div_listing_type_success.fadeOut("fast");
			$div_listing_type_error.fadeIn("fast");
		}
    });
}



//PROPERTY TYPES
function property_type_add_clear(){
	//alert('Test');
	$( '#frm_addpropertytype' ).each(function(){
		this.reset();
		$("#property_type_features").val('').trigger('change');		
	});	
	$("#div_add_property_type_success").fadeOut("fast");
	$("#div_add_property_type_error").fadeOut("fast");
}

function save_property_type(){
	$div_add_property_type_error = $("#div_add_property_type_error");
	$div_add_property_type_success = $("#div_add_property_type_success");
			
	$add_property_type_name = $("#add_property_type_name").val();
	$add_property_type_description = $("#add_property_type_description").val();
	
	$valmsg = "";
	$valmsg2 = "";
		
	if ($add_property_type_name == ""){$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please enter Property Type Name <br/>";}
	//if (!$("#add_bedrooms").is(":checked") && !$("#add_bathrooms").is(":checked") && !$("#add_total_rooms").is(":checked") && !$("#add_living_area").is(":checked") && !$("#add_floor").is(":checked") && !$("#add_total_floors").is(":checked") && !$("#add_land_size").is(":checked") && !$("#add_building_size").is(":checked")){
		//$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please select at least one property type feature <br/>";
	//}
	if ($valmsg != $valmsg2){
		$div_add_property_type_error.html($valmsg);
		$div_add_property_type_success.fadeOut("fast");
		$div_add_property_type_error.fadeIn("fast");
	}else{
		$div_add_property_type_error.fadeOut("fast");
		$div_add_property_type_success.fadeOut("fast");
			
		$("#add_property_type_loader").show();
					
		var form = document.getElementById('frm_addpropertytype');
		var formData = new FormData(form);

		$.ajax({
           	url: baseDir+'be/property_types/save',
           	type: 'POST',
           	data: formData,
			dataType: 'json',
           	xhr: function() {
           		var myXhr = $.ajaxSettings.xhr();
           		return myXhr;
           	},
           	cache: false,
           	contentType: false,
           	processData: false,
           	success: function (res) {
				$("#add_property_type_loader").hide();
				if(res.status == 'ERR'){
					$div_add_property_type_error.html(res.message);
					$div_add_property_type_success.fadeOut("fast");
					$div_add_property_type_error.fadeIn("fast");
				}else if (res.status == 'SUCCESS'){
					$div_add_property_type_success.html(res.message);
					$div_add_property_type_error.fadeOut("fast");
					$div_add_property_type_success.fadeIn("fast");
					
					$( '#frm_addlistingtype' ).each(function(){
						this.reset();
					});	

					load_property_types();

				}
            	},
			error: function(){
				$("#add_property_type_loader").hide();
				$div_add_property_type_error.html("Something went wrong. Please check your network and try again.");
				$div_add_property_type_success.fadeOut("fast");
				$div_add_property_type_error.fadeIn("fast");
			}
       	});
	}
		return false;
}
//LOAD PROPERTY TYPES
function load_property_types(){
	$('#div_property_types_loader').oLoader({
		backgroundColor:'#fff',
		image: baseDir+'assets/be/js/plugins/oLoader/images/ownageLoader/loader9.gif',
		fadeInTime: 500,
		fadeOutTime: 1000,
		fadeLevel: 0.8
	});				
	$.ajax({
     	url: baseDir+'be/property_types/loadjs',
       	type: 'POST',
       	data: '',
       	xhr: function() {
       		var myXhr = $.ajaxSettings.xhr();
       		return myXhr;
       	},
       	cache: false,
       	contentType: false,
       	processData: false,
     	success: function (result) {
			$("#property_types_div").html(result);
			$('#div_property_types_loader').oLoader('hide');			
   		},
		error: function(){
			$('#div_property_types_loader').oLoader('hide');
		}
    });
}
function property_type_edit_load(property_type_id){
	//$("#edit_property_type_features option:selected").removeAttr('selected');
	//$("#edit_property_type_features").change();
	$("#edit_property_type_features option:selected").removeAttr("selected");
	$.ajax({
     	url: baseDir+'be/property_types/get_property_type/'+property_type_id,
       	type: 'POST',
       	data: '',
       	xhr: function() {
       		var myXhr = $.ajaxSettings.xhr();
       		return myXhr;
       	},
       	cache: false,
       	contentType: false,
       	processData: false,
     	success: function (res) {
     		try{
     			var obj1 = res;
     			obj1 = obj1.replace('[','');
     			obj1 = obj1.replace(']','');
	     		var obj = $.parseJSON(obj1);
	     		$("#edit_property_type_id").val(obj['property_type_id']);
	     		$("#edit_property_type_name").val(obj['property_type_name']);
	     		$("#edit_property_type_description").val(obj['property_type_description']);
     		}catch(err){
     			alert(err);
     		}
   		},
		error: function(){
		}
    });
	$.ajax({
     	url: baseDir+'be/property_types/get_property_type_features2/'+property_type_id,
       	type: 'POST',
       	data: '',
       	xhr: function() {
       		var myXhr = $.ajaxSettings.xhr();
       		return myXhr;
       	},
       	cache: false,
       	contentType: false,
       	processData: false,
     	success: function (res) {
     			var obj1 = res;
     			obj1 = obj1.replace('[','');
     			obj1 = obj1.replace(']','');
				//var objArray = obj1.split(',');
				//$('#edit_property_type_features').val(objArray);
     			$.each(obj1.split(","), function(i,e){
     				e = e.replace('"','');
     				e = e.replace('"','');     				
     				$("#edit_property_type_features option[value='" + e + "']").prop('selected', true);
     				//$("#edit_property_type_features").change();
     			});
				//$("#edit_property_type_features").multiselect("refresh");
				$("#edit_property_type_features").change();
   		},
		error: function(){
		}
    });

   	$("#div_edit_property_type_error").fadeOut("fast");
	$("#div_edit_property_type_success").fadeOut("fast");

}
function update_property_type(){
		$div_edit_property_type_error = $("#div_edit_property_type_error");
		$div_edit_property_type_success = $("#div_edit_property_type_success");
				
		$edit_property_type_name = $("#edit_property_type_name").val();
		$edit_property_type_description = $("#edit_property_type_description").val();
	
		$valmsg = "";
		$valmsg2 = "";
		
		if ($edit_property_type_name == ""){$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please enter Property Type Name <br/>";}
		//if (!$("#edit_bedrooms").is(":checked") && !$("#edit_bathrooms").is(":checked") && !$("#edit_total_rooms").is(":checked") && !$("#edit_living_area").is(":checked") && !$("#edit_floor").is(":checked") && !$("#edit_total_floors").is(":checked") && !$("#edit_land_size").is(":checked") && !$("#edit_building_size").is(":checked")){
			//$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please select at least one property type feature <br/>";
		//}
		
		if ($valmsg != $valmsg2){
			$div_edit_property_type_error.html($valmsg);
			$div_edit_property_type_success.fadeOut("fast");
			$div_edit_property_type_error.fadeIn("fast");
		}else{
			$div_edit_property_type_error.fadeOut("fast");
			$div_edit_property_type_success.fadeOut("fast");
				
			$("#edit_property_type_loader").show();
					
			var form = document.getElementById('frm_editpropertytype');
			var formData = new FormData(form);

			//alert($("#edit_property_type_features").val());

			$.ajax({
            	url: baseDir+'be/property_types/update',
            	type: 'POST',
            	data: formData,
				dataType: 'json',
            	xhr: function() {
               		var myXhr = $.ajaxSettings.xhr();
               		return myXhr;
            	},
            	cache: false,
            	contentType: false,
            	processData: false,
            	success: function (res) {
					$("#edit_property_type_loader").hide();
					if(res.status == 'ERR'){
						$div_edit_property_type_error.html(res.message);
						$div_edit_property_type_success.fadeOut("fast");
						$div_edit_property_type_error.fadeIn("fast");
					}else if (res.status == 'SUCCESS'){
						$div_edit_property_type_success.html(res.message);
						$div_edit_property_type_error.fadeOut("fast");
						$div_edit_property_type_success.fadeIn("fast");
						
						load_property_types();

					}
            	},
				error: function(){
					$("#edit_property_type_loader").hide();
					$div_edit_property_type_error.html("Something went wrong. Please check your network and try again.");
					$div_edit_property_type_success.fadeOut("fast");
					$div_edit_property_type_error.fadeIn("fast");
				}
        	});
	
		}
		//$("#edit_property_type_loader").hide();

		return false;
}
function delete_property_type(property_type_id){
    //alert('Am clicked!');
    $div_property_type_error = $("#div_property_type_error");
    $div_property_type_success = $("#div_property_type_success");

    $div_property_type_error.fadeOut("fast");
    $div_property_type_success.fadeOut("fast");

    $.ajax({
        url: baseDir+'be/property_types/delete/'+property_type_id,
        type: 'POST',
        data: '',
        xhr: function() {
            var myXhr = $.ajaxSettings.xhr();
            return myXhr;
        },
        cache: false,
        contentType: false,
        processData: false,
        success: function (res) {
            try{
                var obj1 = res;
                var obj = $.parseJSON(obj1);

                if(obj['status'] == 'ERR'){
                    $div_property_type_error.html(obj['message']);
                    $div_property_type_success.fadeOut("fast");
                    $div_property_type_error.fadeIn("fast");
                }else if (obj['status'] == 'SUCCESS'){
                    $div_property_type_success.html(obj['message']);
                    $div_property_type_error.fadeOut("fast");
                    $div_property_type_success.fadeIn("fast");

                    load_property_types();
                }
            }catch(err){
                alert(err);
            }           
        },
        error: function(){
            $div_property_type_error.html("Something went wrong. Please check your network and try again.");
            $div_property_type_success.fadeOut("fast");
            $div_property_type_error.fadeIn("fast");
        }
    });
}






//PROPERTY SUBCATEGORIES
function property_subcategory_add_clear(){
	//alert('Test');
	$( '#frm_addpropertysubcategory' ).each(function(){
		this.reset();
	});	
	$div_add_property_subcategory_success.fadeOut("fast");
	$div_add_property_subcategory_error.fadeOut("fast");
}

function save_property_subcategory(){
	$div_add_property_subcategory_error = $("#div_add_property_subcategory_error");
	$div_add_property_subcategory_success = $("#div_add_property_subcategory_success");
				
	$add_property_type_id = $("#add_property_type_id").val();
	$add_property_subcategory_name = $("#add_property_subcategory_name").val();
	$add_property_subcategory_description = $("#add_property_subcategory_description").val();
	
	$valmsg = "";
	$valmsg2 = "";
		
	if ($add_property_type_id == ""){$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please select Property Type<br/>";}
	if ($add_property_subcategory_name == ""){$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please enter Property Subcategory Name <br/>";}
				
	if ($valmsg != $valmsg2){
		$div_add_property_subcategory_error.html($valmsg);
		$div_add_property_subcategory_success.fadeOut("fast");
		$div_add_property_subcategory_error.fadeIn("fast");
	}else{
		$div_add_property_subcategory_error.fadeOut("fast");
		$div_add_property_subcategory_success.fadeOut("fast");
				
		$("#add_property_subcategory_loader").show();
				
		var form = document.getElementById('frm_addpropertysubcategory');
		var formData = new FormData(form);

		$.ajax({
           	url: baseDir+'be/property_subcategories/save',
           	type: 'POST',
           	data: formData,
			dataType: 'json',
           	xhr: function() {
           		var myXhr = $.ajaxSettings.xhr();
           		return myXhr;
           	},
           	cache: false,
           	contentType: false,
           	processData: false,
           	success: function (res) {
				$("#add_property_subcategory_loader").hide();
				if(res.status == 'ERR'){
					$div_add_property_subcategory_error.html(res.message);
					$div_add_property_subcategory_success.fadeOut("fast");
					$div_add_property_subcategory_error.fadeIn("fast");
				}else if (res.status == 'SUCCESS'){
					$div_add_property_subcategory_success.html(res.message);
					$div_add_property_subcategory_error.fadeOut("fast");
					$div_add_property_subcategory_success.fadeIn("fast");
				
					$( '#frm_addpropertysubcategory' ).each(function(){
						this.reset();
					});	

					load_property_subcategories();

				}
           	},
			error: function(){
				$("#add_property_subcategory_loader").hide();
				$div_add_property_subcategory_error.html("Something went wrong. Please check your network and try again.");
				$div_add_property_subcategory_success.fadeOut("fast");
				$div_add_property_subcategory_error.fadeIn("fast");
			}
       	});
	}
	return false;
}
//LOAD PROPERTY SUBCATEGORIES
function load_property_subcategories(){
	$('#div_property_subcategories_loader').oLoader({
		backgroundColor:'#fff',
		image: baseDir+'assets/be/js/plugins/oLoader/images/ownageLoader/loader9.gif',
		fadeInTime: 500,
		fadeOutTime: 1000,
		fadeLevel: 0.8
	});				
	$.ajax({
     	url: baseDir+'be/property_subcategories/loadjs',
       	type: 'POST',
       	data: '',
       	xhr: function() {
       		var myXhr = $.ajaxSettings.xhr();
       		return myXhr;
       	},
       	cache: false,
       	contentType: false,
       	processData: false,
     	success: function (result) {
			$("#property_subcategories_div").html(result);
			$('#div_property_subcategories_loader').oLoader('hide');			
   		},
		error: function(){
			$('#div_property_subcategories_loader').oLoader('hide');
		}
    });
}
function property_subcategory_edit_load(property_subcategory_id){
	$.ajax({
     	url: baseDir+'be/property_subcategories/get_property_subcategory/'+property_subcategory_id,
       	type: 'POST',
       	data: '',
       	xhr: function() {
       		var myXhr = $.ajaxSettings.xhr();
       		return myXhr;
       	},
       	cache: false,
       	contentType: false,
       	processData: false,
     	success: function (res) {
     		try{
     			var obj1 = res;
     			obj1 = obj1.replace('[','');
     			obj1 = obj1.replace(']','');
	     		var obj = $.parseJSON(obj1);

	     		$("#edit_property_type_id").val(obj['property_type_id']).change(); 
	     		$("#edit_property_subcategory_id").val(obj['property_subcategory_id']);
	     		$("#edit_property_subcategory_name").val(obj['property_subcategory_name']);
	     		$("#edit_property_subcategory_description").val(obj['property_subcategory_description']);

     		}catch(err){
     			alert(err);
     		}
   		},
		error: function(){
		}
    });
   	$div_edit_property_subcategory_error.fadeOut("fast");
	$div_edit_property_subcategory_success.fadeOut("fast");

}
function update_property_subcategory(){
		$div_edit_property_subcategory_error = $("#div_edit_property_subcategory_error");
		$div_edit_property_subcategory_success = $("#div_edit_property_subcategory_success");
				
		$edit_property_type_id = $("#edit_property_type_id").val();
		$edit_property_subcategory_name = $("#edit_property_subcategory_name").val();
		$edit_property_subcategory_description = $("#edit_property_subcategory_description").val();
	
		$valmsg = "";
		$valmsg2 = "";
		
		if ($edit_property_type_id == ""){$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please select Property Type<br/>";}
		if ($edit_property_subcategory_name == ""){$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please enter Property Subcategory Name <br/>";}
		
		if ($valmsg != $valmsg2){
			$div_edit_property_subcategory_error.html($valmsg);
			$div_edit_property_subcategory_success.fadeOut("fast");
			$div_edit_property_subcategory_error.fadeIn("fast");
		}else{
			$div_edit_property_subcategory_error.fadeOut("fast");
			$div_edit_property_subcategory_success.fadeOut("fast");
				
			$("#edit_property_subcategory_loader").show();
					
			var form = document.getElementById('frm_editpropertysubcategory');
			var formData = new FormData(form);

			$.ajax({
            	url: baseDir+'be/property_subcategories/update',
            	type: 'POST',
            	data: formData,
				dataType: 'json',
            	xhr: function() {
               		var myXhr = $.ajaxSettings.xhr();
               		return myXhr;
            	},
            	cache: false,
            	contentType: false,
            	processData: false,
            	success: function (res) {
					$("#edit_property_subcategory_loader").hide();
					if(res.status == 'ERR'){
						$div_edit_property_subcategory_error.html(res.message);
						$div_edit_property_subcategory_success.fadeOut("fast");
						$div_edit_property_subcategory_error.fadeIn("fast");
					}else if (res.status == 'SUCCESS'){
						$div_edit_property_subcategory_success.html(res.message);
						$div_edit_property_subcategory_error.fadeOut("fast");
						$div_edit_property_subcategory_success.fadeIn("fast");
						
						load_property_subcategories();

					}
            	},
				error: function(){
					$("#edit_property_subcategory_loader").hide();
					$div_edit_property_subcategory_error.html("Something went wrong. Please check your network and try again.");
					$div_edit_property_subcategory_success.fadeOut("fast");
					$div_edit_property_subcategory_error.fadeIn("fast");
				}
        	});
	
		}
		return false;
}
function delete_property_subcategory(property_subcategory_id){
	$div_property_subcategory_error = $("#div_property_subcategory_error");
	$div_property_subcategory_success = $("#div_property_subcategory_success");

	$div_property_subcategory_error.fadeOut("fast");
	$div_property_subcategory_success.fadeOut("fast");

	$.ajax({
     	url: baseDir+'be/property_subcategories/delete/'+property_subcategory_id,
       	type: 'POST',
       	data: '',
       	xhr: function() {
       		var myXhr = $.ajaxSettings.xhr();
       		return myXhr;
       	},
       	cache: false,
       	contentType: false,
       	processData: false,
     	success: function (res) {
     		try{
     			var obj1 = res;
	     		var obj = $.parseJSON(obj1);

				if(obj['status'] == 'ERR'){
					$div_property_subcategory_error.html(obj['message']);
					$div_property_subcategory_success.fadeOut("fast");
					$div_property_subcategory_error.fadeIn("fast");
				}else if (obj['status'] == 'SUCCESS'){
					$div_property_subcategory_success.html(obj['message']);
					$div_property_subcategory_error.fadeOut("fast");
					$div_property_subcategory_success.fadeIn("fast");

					load_property_subcategories();
				}
     		}catch(err){
     			alert(err);
     		}    		
   		},
		error: function(){
			$div_property_subcategory_error.html("Something went wrong. Please check your network and try again.");
			$div_property_subcategory_success.fadeOut("fast");
			$div_property_subcategory_error.fadeIn("fast");
		}
    });
}





//CUSTOMERS
function customer_add_clear(){
	$div_add_customer_error = $("#div_add_customer_error");
	$div_add_customer_success = $("#div_add_customer_success");

	$( '#frm_addcustomer' ).each(function(){
		this.reset();
	});	
	$("#add_country_id").val('').trigger('change');
	$("#add_town_id").val('').trigger('change');						

	$div_add_customer_success.fadeOut("fast");
	$div_add_customer_error.fadeOut("fast");
}

function save_customer(){
	$div_add_customer_error = $("#div_add_customer_error");
	$div_add_customer_success = $("#div_add_customer_success");
				
	$add_first_name = $("#add_first_name").val();
	$add_last_name = $("#add_last_name").val();
	$add_phone_number = $("#add_phone_number").val();
	$add_password = $("#add_password").val();
	$add_confirm_password = $("#add_confirm_password").val();
	$add_email_address = $("#add_email_address").val();
	
	$valmsg = "";
	$valmsg2 = "";
		
	if ($add_first_name == ""){$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please enter First Name <br/>";}
	if ($add_last_name == ""){$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please enter Last Name <br/>";}
	if ($add_phone_number == ""){$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please enter Phone Number <br/>";}
	if ($add_email_address == ""){
		$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please enter Email Address<br/>";
	}else if(!validateEmail($add_email_address)){
		$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please enter the correct Email format <br/>";
	}
	if ($add_password == ""){$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please enter Password <br/>";}
	if ($add_confirm_password == ""){
		$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please enter Confirm Password <br/>";
	}else if ($add_password != $add_confirm_password){
		$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please retype the correct Password <br/>";
	}

		
	if ($valmsg != $valmsg2){
		$div_add_customer_error.html($valmsg);
		$div_add_customer_success.fadeOut("fast");
		$div_add_customer_error.fadeIn("fast");
	}else{
		$div_add_customer_error.fadeOut("fast");
		$div_add_customer_success.fadeOut("fast");
				
		$("#add_customer_loader").show();
					
		var form = document.getElementById('frm_addcustomer');
		var formData = new FormData(form);

		$.ajax({
           	url: baseDir+'be/customers/save',
           	type: 'POST',
           	data: formData,
			dataType: 'json',
           	xhr: function() {
           		var myXhr = $.ajaxSettings.xhr();
           		return myXhr;
           	},
           	cache: false,
           	contentType: false,
           	processData: false,
           	success: function (res) {
				$("#add_customer_loader").hide();
				if(res.status == 'ERR'){
					$div_add_customer_error.html(res.message);
					$div_add_customer_success.fadeOut("fast");
					$div_add_customer_error.fadeIn("fast");
				}else if (res.status == 'SUCCESS'){
					$div_add_customer_success.html(res.message);
					$div_add_customer_error.fadeOut("fast");
					$div_add_customer_success.fadeIn("fast");
					
					$( '#frm_addcustomer' ).each(function(){
						this.reset();
						$("#add_gender").val('').trigger('change');
						$("#add_country_id").val('').trigger('change');
						$("#add_town_id").val('').trigger('change');						
					});	

					load_customers();

				}
           	},
			error: function(){
				$("#add_customer_loader").hide();
				$div_add_customer_error.html("Something went wrong. Please check your network and try again.");
				$div_add_customer_success.fadeOut("fast");
				$div_add_customer_error.fadeIn("fast");
			}
       	});
	
	}
	return false;
}
//LOAD customerS
function load_customers(){
	$('#div_customers_loader').oLoader({
		backgroundColor:'#fff',
		image: baseDir+'assets/be/js/plugins/oLoader/images/ownageLoader/loader9.gif',
		fadeInTime: 500,
		fadeOutTime: 1000,
		fadeLevel: 0.8
	});				
	$.ajax({
     	url: baseDir+'be/customers/loadjs',
       	type: 'POST',
       	data: '',
       	xhr: function() {
       		var myXhr = $.ajaxSettings.xhr();
       		return myXhr;
       	},
       	cache: false,
       	contentType: false,
       	processData: false,
     	success: function (result) {
			$("#customers_div").html(result);
			$('#div_customers_loader').oLoader('hide');			
   		},
		error: function(){
			$('#div_customers_loader').oLoader('hide');
		}
    });
}
function customer_edit_load(customer_id){
	$.ajax({
     	url: baseDir+'be/customers/get_customer/'+customer_id,
       	type: 'POST',
       	data: '',
       	xhr: function() {
       		var myXhr = $.ajaxSettings.xhr();
       		return myXhr;
       	},
       	cache: false,
       	contentType: false,
       	processData: false,
     	success: function (res) {
     		try{
     			var obj1 = res;
     			obj1 = obj1.replace('[','');
     			obj1 = obj1.replace(']','');
	     		var obj = $.parseJSON(obj1);

				$("#edit_customer_id").val(obj['customer_id']);	     			
	     		$("#edit_first_name").val(obj['first_name']);
	     		$("#edit_last_name").val(obj['last_name']);
	     		$("#edit_phone_number").val(obj['phone_number']);
	     		$("#edit_email_address").val(obj['email_address']);
	     		$("#edit_gender").val(obj['gender']).change(); 
	     		$("#edit_country_id").val(obj['country_id']).change(); 
	     		$("#edit_town_id").val(obj['town_id']).change(); 

    		}catch(err){
     			alert(err);
     		}
   		},
		error: function(){
		}
    });
   	$div_edit_customer_error.fadeOut("fast");
	$div_edit_customer_success.fadeOut("fast");

}
function update_customer(){
	$div_edit_customer_error = $("#div_edit_customer_error");
	$div_edit_customer_success = $("#div_edit_customer_success");
				
	$edit_first_name = $("#edit_first_name").val();
	$edit_last_name = $("#edit_last_name").val();
	$edit_phone_number = $("#edit_phone_number").val();
	$edit_email_address = $("#edit_email_address").val();
	
	$valmsg = "";
	$valmsg2 = "";
		
	if ($edit_first_name == ""){$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please enter First Name <br/>";}
	if ($edit_last_name == ""){$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please enter Last Name <br/>";}
	if ($edit_phone_number == ""){$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please enter Phone Number <br/>";}
	if ($edit_email_address == ""){
		$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please enter Email Address<br/>";
	}else if(!validateEmail($edit_email_address)){
		$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please enter the correct Email format <br/>";
	}
		
		if ($valmsg != $valmsg2){
			$div_edit_customer_error.html($valmsg);
			$div_edit_customer_success.fadeOut("fast");
			$div_edit_customer_error.fadeIn("fast");
		}else{
			$div_edit_customer_error.fadeOut("fast");
			$div_edit_customer_success.fadeOut("fast");
				
			$("#edit_customer_loader").show();
					
			var form = document.getElementById('frm_editcustomer');
			var formData = new FormData(form);

			$.ajax({
            	url: baseDir+'be/customers/update',
            	type: 'POST',
            	data: formData,
				dataType: 'json',
            	xhr: function() {
               		var myXhr = $.ajaxSettings.xhr();
               		return myXhr;
            	},
            	cache: false,
            	contentType: false,
            	processData: false,
            	success: function (res) {
					$("#edit_customer_loader").hide();
					if(res.status == 'ERR'){
						$div_edit_customer_error.html(res.message);
						$div_edit_customer_success.fadeOut("fast");
						$div_edit_customer_error.fadeIn("fast");
					}else if (res.status == 'SUCCESS'){
						$div_edit_customer_success.html(res.message);
						$div_edit_customer_error.fadeOut("fast");
						$div_edit_customer_success.fadeIn("fast");
						
						load_customers();

					}
            	},
				error: function(){
					$("#edit_customer_loader").hide();
					$div_edit_customer_error.html("Something went wrong. Please check your network and try again.");
					$div_edit_customer_success.fadeOut("fast");
					$div_edit_customer_error.fadeIn("fast");
				}
        	});
	
		}
		return false;
}

function change_customer_password_load($customer_id){
	$div_change_customer_password_error = $("#div_change_customer_password_error");
	$div_change_customer_password_success = $("#div_change_customer_password_success");

	$( '#password_customer_id' ).val($customer_id);
	$( '#new_password' ).val('');
	$( '#confirm_password' ).val('');	
	$div_change_customer_password_success.fadeOut("fast");
	$div_change_customer_password_error.fadeOut("fast");	
}

function change_customer_password(){
	$div_change_customer_password_error = $("#div_change_customer_password_error");
	$div_change_customer_password_success = $("#div_change_customer_password_success");
				
	//$old_password = $("#old_password").val();
	$new_password = $("#new_password").val();
	$confirm_password = $("#confirm_password").val();
	
	
	$valmsg = "";
	$valmsg2 = "";
		
	//if ($old_password == ""){$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please enter Old Password <br/>";}
	if ($new_password == ""){$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please enter New Password <br/>";}
	if ($confirm_password == ""){
		$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please enter Confirm Password<br/>";
	}else if($new_password != $confirm_password){
		$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please retype the correct Password <br/>";
	}
		
		if ($valmsg != $valmsg2){
			$div_change_customer_password_error.html($valmsg);
			$div_change_customer_password_success.fadeOut("fast");
			$div_change_customer_password_error.fadeIn("fast");
		}else{
			$div_change_customer_password_error.fadeOut("fast");
			$div_change_customer_password_success.fadeOut("fast");
				
			$("#change_customer_password_loader").show();
					
			var form = document.getElementById('frm_changecustomerpassword');
			var formData = new FormData(form);

			$.ajax({
            	url: baseDir+'be/customers/change_customer_password',
            	type: 'POST',
            	data: formData,
				dataType: 'json',
            	xhr: function() {
               		var myXhr = $.ajaxSettings.xhr();
               		return myXhr;
            	},
            	cache: false,
            	contentType: false,
            	processData: false,
            	success: function (res) {
					$("#change_customer_password_loader").hide();
					if(res.status == 'ERR'){
						$div_change_customer_password_error.html(res.message);
						$div_change_customer_password_success.fadeOut("fast");
						$div_change_customer_password_error.fadeIn("fast");
					}else if (res.status == 'SUCCESS'){
						$div_change_customer_password_success.html(res.message);
						$div_change_customer_password_error.fadeOut("fast");
						$div_change_customer_password_success.fadeIn("fast");						
					}
            	},
				error: function(){
					$("#change_customer_password_loader").hide();
					$div_change_customer_password_error.html("Something went wrong. Please check your network and try again.");
					$div_change_customer_password_success.fadeOut("fast");
					$div_change_customer_password_error.fadeIn("fast");

				}
        	});
	
		}
		return false;
}

function delete_customer(customer_id){
    //alert('Am clicked!');
    $div_customer_error = $("#div_customer_error");
    $div_customer_success = $("#div_customer_success");

    $div_customer_error.fadeOut("fast");
    $div_customer_success.fadeOut("fast");

    $.ajax({
        url: baseDir+'be/customers/delete/'+customer_id,
        type: 'POST',
        data: '',
        xhr: function() {
            var myXhr = $.ajaxSettings.xhr();
            return myXhr;
        },
        cache: false,
        contentType: false,
        processData: false,
        success: function (res) {
            try{
                var obj1 = res;
                var obj = $.parseJSON(obj1);

                if(obj['status'] == 'ERR'){
                    $div_customer_error.html(obj['message']);
                    $div_customer_success.fadeOut("fast");
                    $div_customer_error.fadeIn("fast");
                }else if (obj['status'] == 'SUCCESS'){
                    $div_customer_success.html(obj['message']);
                    $div_customer_error.fadeOut("fast");
                    $div_customer_success.fadeIn("fast");

					load_customers();
                    
                }
            }catch(err){
                alert(err);
            }           
        },
        error: function(){
            $div_customer_error.html("Something went wrong. Please check your network and try again.");
            $div_customer_success.fadeOut("fast");
            $div_customer_error.fadeIn("fast");
        }
    });
}





//CATEGORIES
function category_add_clear(){
	$div_add_category_error = $("#div_add_category_error");
	$div_add_category_success = $("#div_add_category_success");

	$( '#frm_addcategory' ).each(function(){
		this.reset();
	});	
	$("#add_category_type").val('').trigger('change');

	$div_add_category_success.fadeOut("fast");
	$div_add_category_error.fadeOut("fast");
}

function save_category(){
	$div_add_category_error = $("#div_add_category_error");
	$div_add_category_success = $("#div_add_category_success");
				
	$add_category_name = $("#add_category_name").val();
	$add_category_type = $("#add_category_type").val();
	
	$valmsg = "";
	$valmsg2 = "";
		
	if ($add_category_name == ""){$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please enter Category Name <br/>";}
	if ($add_category_type == ""){$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please select Category Type <br/>";}
		
	if ($valmsg != $valmsg2){
		$div_add_category_error.html($valmsg);
		$div_add_category_success.fadeOut("fast");
		$div_add_category_error.fadeIn("fast");
	}else{
		$div_add_category_error.fadeOut("fast");
		$div_add_category_success.fadeOut("fast");
				
		$("#add_category_loader").show();
					
		var form = document.getElementById('frm_addcategory');
		var formData = new FormData(form);

		$.ajax({
           	url: baseDir+'be/categories/save',
           	type: 'POST',
           	data: formData,
			dataType: 'json',
           	xhr: function() {
           		var myXhr = $.ajaxSettings.xhr();
           		return myXhr;
           	},
           	cache: false,
           	contentType: false,
           	processData: false,
           	success: function (res) {
				$("#add_category_loader").hide();
				if(res.status == 'ERR'){
					$div_add_category_error.html(res.message);
					$div_add_category_success.fadeOut("fast");
					$div_add_category_error.fadeIn("fast");
				}else if (res.status == 'SUCCESS'){
					$div_add_category_success.html(res.message);
					$div_add_category_error.fadeOut("fast");
					$div_add_category_success.fadeIn("fast");
					
					$( '#frm_addcategory' ).each(function(){
						this.reset();
					});	
					$("#add_category_type").val('').trigger('change');

					load_categories();

				}
           	},
			error: function(){
				$("#add_category_loader").hide();
				$div_add_category_error.html("Something went wrong. Please check your network and try again.");
				$div_add_category_success.fadeOut("fast");
				$div_add_category_error.fadeIn("fast");
			}
       	});
	
	}
		return false;
}

//LOAD categories
function load_categories(){
	$('#div_categories_loader').oLoader({
		backgroundColor:'#fff',
		image: baseDir+'assets/be/js/plugins/oLoader/images/ownageLoader/loader9.gif',
		fadeInTime: 500,
		fadeOutTime: 1000,
		fadeLevel: 0.8
	});				
	$.ajax({
     	url: baseDir+'be/categories/loadjs',
       	type: 'POST',
       	data: '',
       	xhr: function() {
       		var myXhr = $.ajaxSettings.xhr();
       		return myXhr;
       	},
       	cache: false,
       	contentType: false,
       	processData: false,
     	success: function (result) {
			$("#categories_div").html(result);
			$('#div_categories_loader').oLoader('hide');			
   		},
		error: function(){
			$('#div_categories_loader').oLoader('hide');
		}
    });
}
function category_edit_load(category_id){
	$.ajax({
     	url: baseDir+'be/categories/get_category/'+category_id,
       	type: 'POST',
       	data: '',
       	xhr: function() {
       		var myXhr = $.ajaxSettings.xhr();
       		return myXhr;
       	},
       	cache: false,
       	contentType: false,
       	processData: false,
     	success: function (res) {
     		try{
     			var obj1 = res;
     			obj1 = obj1.replace('[','');
     			obj1 = obj1.replace(']','');
	     		var obj = $.parseJSON(obj1);

				$("#edit_category_id").val(obj['category_id']);	     			
	     		$("#edit_category_name").val(obj['category_name']);
	     		$("#edit_category_description").val(obj['category_description']);
				$("#edit_category_type").val(obj['category_type']).trigger('change');

     		}catch(err){
     			alert(err);
     		}
   		},
		error: function(){
		}
    });
   	$div_edit_category_error.fadeOut("fast");
	$div_edit_category_success.fadeOut("fast");

}
function check_category_logo_exists($picture_path){
	$.ajax({
		url: $picture_path,
		type: 'HEAD',
		error: function(){
			$("#img_category_logo").attr('src', '');
		},
		success: function(){
			$("#img_category_logo").attr('src', $picture_path);
		}
	});
}
function update_category(){
	$div_edit_category_error = $("#div_edit_category_error");
	$div_edit_category_success = $("#div_edit_category_success");
				
	$edit_category_name = $("#edit_category_name").val();
	$edit_category_type = $("#edit_category_type").val();
	
	$valmsg = "";
	$valmsg2 = "";
		
	if ($edit_category_name == ""){$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please enter category Name <br/>";}
	if ($edit_category_type == ""){$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please select category Type <br/>";}
		
		if ($valmsg != $valmsg2){
			$div_edit_category_error.html($valmsg);
			$div_edit_category_success.fadeOut("fast");
			$div_edit_category_error.fadeIn("fast");
		}else{
			$div_edit_category_error.fadeOut("fast");
			$div_edit_category_success.fadeOut("fast");
				
			$("#edit_category_loader").show();
					
			var form = document.getElementById('frm_editcategory');
			var formData = new FormData(form);

			$.ajax({
            	url: baseDir+'be/categories/update',
            	type: 'POST',
            	data: formData,
				dataType: 'json',
            	xhr: function() {
               		var myXhr = $.ajaxSettings.xhr();
               		return myXhr;
            	},
            	cache: false,
            	contentType: false,
            	processData: false,
            	success: function (res) {
					$("#edit_category_loader").hide();
					if(res.status == 'ERR'){
						$div_edit_category_error.html(res.message);
						$div_edit_category_success.fadeOut("fast");
						$div_edit_category_error.fadeIn("fast");
					}else if (res.status == 'SUCCESS'){
						$div_edit_category_success.html(res.message);
						$div_edit_category_error.fadeOut("fast");
						$div_edit_category_success.fadeIn("fast");
						
						load_categories();

					}
            	},
				error: function(){
					$("#edit_category_loader").hide();
					$div_edit_category_error.html("Something went wrong. Please check your network and try again.");
					$div_edit_category_success.fadeOut("fast");
					$div_edit_category_error.fadeIn("fast");
				}
        	});
	
		}
		return false;
}


function delete_category(category_id){
    $div_category_error = $("#div_category_error");
    $div_category_success = $("#div_category_success");

    $div_category_error.fadeOut("fast");
    $div_category_success.fadeOut("fast");

    $.ajax({
        url: baseDir+'be/categories/delete/'+category_id,
        type: 'POST',
        data: '',
        xhr: function() {
            var myXhr = $.ajaxSettings.xhr();
            return myXhr;
        },
        cache: false,
        contentType: false,
        processData: false,
        success: function (res) {
            try{
                var obj1 = res;
                var obj = $.parseJSON(obj1);

                if(obj['status'] == 'ERR'){
                    $div_category_error.html(obj['message']);
                    $div_category_success.fadeOut("fast");
                    $div_category_error.fadeIn("fast");
                }else if (obj['status'] == 'SUCCESS'){
                    $div_category_success.html(obj['message']);
                    $div_category_error.fadeOut("fast");
                    $div_category_success.fadeIn("fast");

					load_categories();
                    
                }
            }catch(err){
                alert(err);
            }           
        },
        error: function(){
            $div_category_error.html("Something went wrong. Please check your network and try again.");
            $div_category_success.fadeOut("fast");
            $div_category_error.fadeIn("fast");
        }
    });
}


//BRANDS
function brand_add_clear(){
	$div_add_brand_error = $("#div_add_brand_error");
	$div_add_brand_success = $("#div_add_brand_success");

	$( '#frm_addbrand' ).each(function(){
		this.reset();
	});	
	$("#add_brand_type").val('').trigger('change');

	$div_add_brand_success.fadeOut("fast");
	$div_add_brand_error.fadeOut("fast");
}

function save_brand(){
	$div_add_brand_error = $("#div_add_brand_error");
	$div_add_brand_success = $("#div_add_brand_success");
				
	$add_brand_name = $("#add_brand_name").val();
	$add_brand_type = $("#add_brand_type").val();
	
	$valmsg = "";
	$valmsg2 = "";
		
	if ($add_brand_name == ""){$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please enter Brand Name <br/>";}
	if ($add_brand_type == ""){$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please select Brand Type <br/>";}
		
	if ($valmsg != $valmsg2){
		$div_add_brand_error.html($valmsg);
		$div_add_brand_success.fadeOut("fast");
		$div_add_brand_error.fadeIn("fast");
	}else{
		$div_add_brand_error.fadeOut("fast");
		$div_add_brand_success.fadeOut("fast");
				
		$("#add_brand_loader").show();
					
		var form = document.getElementById('frm_addbrand');
		var formData = new FormData(form);

		$.ajax({
           	url: baseDir+'be/brands/save',
           	type: 'POST',
           	data: formData,
			dataType: 'json',
           	xhr: function() {
           		var myXhr = $.ajaxSettings.xhr();
           		return myXhr;
           	},
           	cache: false,
           	contentType: false,
           	processData: false,
           	success: function (res) {
				$("#add_brand_loader").hide();
				if(res.status == 'ERR'){
					$div_add_brand_error.html(res.message);
					$div_add_brand_success.fadeOut("fast");
					$div_add_brand_error.fadeIn("fast");
				}else if (res.status == 'SUCCESS'){
					$div_add_brand_success.html(res.message);
					$div_add_brand_error.fadeOut("fast");
					$div_add_brand_success.fadeIn("fast");
					
					$( '#frm_addbrand' ).each(function(){
						this.reset();
					});	
					$("#add_brand_type").val('').trigger('change');

					load_brands();

				}
           	},
			error: function(){
				$("#add_brand_loader").hide();
				$div_add_brand_error.html("Something went wrong. Please check your network and try again.");
				$div_add_brand_success.fadeOut("fast");
				$div_add_brand_error.fadeIn("fast");
			}
       	});
	
	}
		return false;
}

//LOAD BRANDS
function load_brands(){
	$('#div_brands_loader').oLoader({
		backgroundColor:'#fff',
		image: baseDir+'assets/be/js/plugins/oLoader/images/ownageLoader/loader9.gif',
		fadeInTime: 500,
		fadeOutTime: 1000,
		fadeLevel: 0.8
	});				
	$.ajax({
     	url: baseDir+'be/brands/loadjs',
       	type: 'POST',
       	data: '',
       	xhr: function() {
       		var myXhr = $.ajaxSettings.xhr();
       		return myXhr;
       	},
       	cache: false,
       	contentType: false,
       	processData: false,
     	success: function (result) {
			$("#brands_div").html(result);
			$('#div_brands_loader').oLoader('hide');			
   		},
		error: function(){
			$('#div_brands_loader').oLoader('hide');
		}
    });
}
function brand_edit_load(brand_id){
	$.ajax({
     	url: baseDir+'be/brands/get_brand/'+brand_id,
       	type: 'POST',
       	data: '',
       	xhr: function() {
       		var myXhr = $.ajaxSettings.xhr();
       		return myXhr;
       	},
       	cache: false,
       	contentType: false,
       	processData: false,
     	success: function (res) {
     		try{
     			var obj1 = res;
     			obj1 = obj1.replace('[','');
     			obj1 = obj1.replace(']','');
	     		var obj = $.parseJSON(obj1);

				$("#edit_brand_id").val(obj['brand_id']);	     			
	     		$("#edit_brand_name").val(obj['brand_name']);
	     		$("#edit_brand_description").val(obj['brand_description']);
				$("#edit_brand_type").val(obj['brand_type']).trigger('change');

	     		if (obj['brand_logo'] == ''){
	     			$("#img_brand_logo").attr('src', '');
	     		}else{
	     			$picture_path = baseDir + 'uploads/brand_logos/' + obj['brand_logo'];
	     			check_brand_logo_exists($picture_path);
	     		}	     		
     		}catch(err){
     			alert(err);
     		}
   		},
		error: function(){
		}
    });
   	$div_edit_brand_error.fadeOut("fast");
	$div_edit_brand_success.fadeOut("fast");

}
function check_brand_logo_exists($picture_path){
	$.ajax({
		url: $picture_path,
		type: 'HEAD',
		error: function(){
			$("#img_brand_logo").attr('src', '');
		},
		success: function(){
			$("#img_brand_logo").attr('src', $picture_path);
		}
	});
}
function update_brand(){
	$div_edit_brand_error = $("#div_edit_brand_error");
	$div_edit_brand_success = $("#div_edit_brand_success");
				
	$edit_brand_name = $("#edit_brand_name").val();
	$edit_brand_type = $("#edit_brand_type").val();
	
	$valmsg = "";
	$valmsg2 = "";
		
	if ($edit_brand_name == ""){$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please enter Brand Name <br/>";}
	if ($edit_brand_type == ""){$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please select Brand Type <br/>";}
		
		if ($valmsg != $valmsg2){
			$div_edit_brand_error.html($valmsg);
			$div_edit_brand_success.fadeOut("fast");
			$div_edit_brand_error.fadeIn("fast");
		}else{
			$div_edit_brand_error.fadeOut("fast");
			$div_edit_brand_success.fadeOut("fast");
				
			$("#edit_brand_loader").show();
					
			var form = document.getElementById('frm_editbrand');
			var formData = new FormData(form);

			$.ajax({
            	url: baseDir+'be/brands/update',
            	type: 'POST',
            	data: formData,
				dataType: 'json',
            	xhr: function() {
               		var myXhr = $.ajaxSettings.xhr();
               		return myXhr;
            	},
            	cache: false,
            	contentType: false,
            	processData: false,
            	success: function (res) {
					$("#edit_brand_loader").hide();
					if(res.status == 'ERR'){
						$div_edit_brand_error.html(res.message);
						$div_edit_brand_success.fadeOut("fast");
						$div_edit_brand_error.fadeIn("fast");
					}else if (res.status == 'SUCCESS'){
						$div_edit_brand_success.html(res.message);
						$div_edit_brand_error.fadeOut("fast");
						$div_edit_brand_success.fadeIn("fast");
						
						load_brands();

					}
            	},
				error: function(){
					$("#edit_brand_loader").hide();
					$div_edit_brand_error.html("Something went wrong. Please check your network and try again.");
					$div_edit_brand_success.fadeOut("fast");
					$div_edit_brand_error.fadeIn("fast");
				}
        	});
	
		}
		return false;
}


function delete_brand(brand_id){
    $div_brand_error = $("#div_brand_error");
    $div_brand_success = $("#div_brand_success");

    $div_brand_error.fadeOut("fast");
    $div_brand_success.fadeOut("fast");

    $.ajax({
        url: baseDir+'be/brands/delete/'+brand_id,
        type: 'POST',
        data: '',
        xhr: function() {
            var myXhr = $.ajaxSettings.xhr();
            return myXhr;
        },
        cache: false,
        contentType: false,
        processData: false,
        success: function (res) {
            try{
                var obj1 = res;
                var obj = $.parseJSON(obj1);

                if(obj['status'] == 'ERR'){
                    $div_brand_error.html(obj['message']);
                    $div_brand_success.fadeOut("fast");
                    $div_brand_error.fadeIn("fast");
                }else if (obj['status'] == 'SUCCESS'){
                    $div_brand_success.html(obj['message']);
                    $div_brand_error.fadeOut("fast");
                    $div_brand_success.fadeIn("fast");

					load_brands();
                    
                }
            }catch(err){
                alert(err);
            }           
        },
        error: function(){
            $div_brand_error.html("Something went wrong. Please check your network and try again.");
            $div_brand_success.fadeOut("fast");
            $div_brand_error.fadeIn("fast");
        }
    });
}



//COUNTRIES
function country_add_clear(){
	$div_add_country_error = $("#div_add_country_error");
	$div_add_country_success = $("#div_add_country_success");

	$( '#frm_addcountry' ).each(function(){
		this.reset();
	});	
	$div_add_country_success.fadeOut("fast");
	$div_add_country_error.fadeOut("fast");
}

function save_country(){
	$div_add_country_error = $("#div_add_country_error");
	$div_add_country_success = $("#div_add_country_success");
				
	$add_country_name = $("#add_country_name").val();
	$add_country_description = $("#add_country_description").val();
	
	$valmsg = "";
	$valmsg2 = "";
		
	if ($add_country_name == ""){$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please enter Country Name <br/>";}
		
	if ($valmsg != $valmsg2){
		$div_add_country_error.html($valmsg);
		$div_add_country_success.fadeOut("fast");
		$div_add_country_error.fadeIn("fast");
	}else{
		$div_add_country_error.fadeOut("fast");
		$div_add_country_success.fadeOut("fast");
				
		$("#add_country_loader").show();
					
		var form = document.getElementById('frm_addcountry');
		var formData = new FormData(form);

		$.ajax({
           	url: baseDir+'be/countries/save',
           	type: 'POST',
           	data: formData,
			dataType: 'json',
           	xhr: function() {
          		var myXhr = $.ajaxSettings.xhr();
        		return myXhr;
            	},
            	cache: false,
            	contentType: false,
            	processData: false,
            	success: function (res) {
					$("#add_country_loader").hide();
					if(res.status == 'ERR'){
						$div_add_country_error.html(res.message);
						$div_add_country_success.fadeOut("fast");
						$div_add_country_error.fadeIn("fast");
					}else if (res.status == 'SUCCESS'){
						$div_add_country_success.html(res.message);
						$div_add_country_error.fadeOut("fast");
						$div_add_country_success.fadeIn("fast");
						
						$( '#frm_addcountry' ).each(function(){
							this.reset();
						});	

						load_countries();

					}
            	},
				error: function(){
					$("#add_country_loader").hide();
					$div_add_country_error.html("Something went wrong. Please check your network and try again.");
					$div_add_country_success.fadeOut("fast");
					$div_add_country_error.fadeIn("fast");
				}
        	});
	
		}
		return false;
}
//LOAD COUNTRIES
function load_countries(){
	$('#div_countries_loader').oLoader({
		backgroundColor:'#fff',
		image: baseDir+'assets/be/js/plugins/oLoader/images/ownageLoader/loader9.gif',
		fadeInTime: 500,
		fadeOutTime: 1000,
		fadeLevel: 0.8
	});				
	$.ajax({
     	url: baseDir+'be/countries/loadjs',
       	type: 'POST',
       	data: '',
       	xhr: function() {
       		var myXhr = $.ajaxSettings.xhr();
       		return myXhr;
       	},
       	cache: false,
       	contentType: false,
       	processData: false,
     	success: function (result) {
			$("#countries_div").html(result);
			$('#div_countries_loader').oLoader('hide');			
   		},
		error: function(){
			$('#div_countries_loader').oLoader('hide');
		}
    });
}
function country_edit_load(country_id){
	$.ajax({
     	url: baseDir+'be/countries/get_country/'+country_id,
       	type: 'POST',
       	data: '',
       	xhr: function() {
       		var myXhr = $.ajaxSettings.xhr();
       		return myXhr;
       	},
       	cache: false,
       	contentType: false,
       	processData: false,
     	success: function (res) {
     		try{
     			var obj1 = res;
     			obj1 = obj1.replace('[','');
     			obj1 = obj1.replace(']','');
	     		var obj = $.parseJSON(obj1);
	     		$("#edit_country_id").val(obj['country_id']);
	     		$("#edit_country_name").val(obj['country_name']);
	     		$("#edit_country_description").val(obj['country_description']);

     		}catch(err){
     			alert(err);
     		}
   		},
		error: function(){
		}
    });
   	$div_edit_country_error.fadeOut("fast");
	$div_edit_country_success.fadeOut("fast");

}
function update_country(){
		$div_edit_country_error = $("#div_edit_country_error");
		$div_edit_country_success = $("#div_edit_country_success");
				
		$edit_country_name = $("#edit_country_name").val();
		$edit_country_description = $("#edit_country_description").val();
	
		$valmsg = "";
		$valmsg2 = "";
		
		if ($edit_country_name == ""){$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please enter Country Name <br/>";}
		
		if ($valmsg != $valmsg2){
			$div_edit_country_error.html($valmsg);
			$div_edit_country_success.fadeOut("fast");
			$div_edit_country_error.fadeIn("fast");
		}else{
			$div_edit_country_error.fadeOut("fast");
			$div_edit_country_success.fadeOut("fast");
				
			$("#edit_country_loader").show();
					
			var form = document.getElementById('frm_editcountry');
			var formData = new FormData(form);

			$.ajax({
            	url: baseDir+'be/countries/update',
            	type: 'POST',
            	data: formData,
				dataType: 'json',
            	xhr: function() {
               		var myXhr = $.ajaxSettings.xhr();
               		return myXhr;
            	},
            	cache: false,
            	contentType: false,
            	processData: false,
            	success: function (res) {
					$("#edit_country_loader").hide();
					if(res.status == 'ERR'){
						$div_edit_country_error.html(res.message);
						$div_edit_country_success.fadeOut("fast");
						$div_edit_country_error.fadeIn("fast");
					}else if (res.status == 'SUCCESS'){
						$div_edit_country_success.html(res.message);
						$div_edit_country_error.fadeOut("fast");
						$div_edit_country_success.fadeIn("fast");

						load_countries();

					}
            	},
				error: function(){
					$("#edit_country_loader").hide();
					$div_edit_country_error.html("Something went wrong. Please check your network and try again.");
					$div_edit_country_success.fadeOut("fast");
					$div_edit_country_error.fadeIn("fast");
				}
        	});
	
		}
		return false;
}
function delete_country(country_id){
	$div_country_error = $("#div_country_error");
	$div_country_success = $("#div_country_success");

	$div_country_error.fadeOut("fast");
	$div_country_success.fadeOut("fast");

	$.ajax({
     	url: baseDir+'be/countries/delete/'+country_id,
       	type: 'POST',
       	data: '',
       	xhr: function() {
       		var myXhr = $.ajaxSettings.xhr();
       		return myXhr;
       	},
       	cache: false,
       	contentType: false,
       	processData: false,
     	success: function (res) {
     		try{
     			var obj1 = res;
	     		var obj = $.parseJSON(obj1);

				if(obj['status'] == 'ERR'){
					$div_country_error.html(obj['message']);
					$div_country_success.fadeOut("fast");
					$div_country_error.fadeIn("fast");
				}else if (obj['status'] == 'SUCCESS'){
					$div_country_success.html(obj['message']);
					$div_country_error.fadeOut("fast");
					$div_country_success.fadeIn("fast");

					load_countries();
				}
     		}catch(err){
     			alert(err);
     		}    		
   		},
		error: function(){
			$div_country_error.html("Something went wrong. Please check your network and try again.");
			$div_country_success.fadeOut("fast");
			$div_country_error.fadeIn("fast");
		}
    });
}




//TOWN
function town_add_clear(){
	$div_add_town_error = $("#div_add_town_error");
	$div_add_town_success = $("#div_add_town_success");

	$( '#frm_addtown').each(function(){
		this.reset();
	});	

	$("#add_country_id").val('').change(); 

	$div_add_town_success.fadeOut("fast");
	$div_add_town_error.fadeOut("fast");
}

function save_town(){
	$div_add_town_error = $("#div_add_town_error");
	$div_add_town_success = $("#div_add_town_success");
				
	$add_country_id = $("#add_country_id").val();
	$add_town_name = $("#add_town_name").val();
	$add_town_description = $("#add_town_description").val();
	
	$valmsg = "";
	$valmsg2 = "";
		
	if ($add_country_id == ""){$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please select Country<br/>";}
	if ($add_town_name == ""){$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please enter Town Name <br/>";}
				
	if ($valmsg != $valmsg2){
		$div_add_town_error.html($valmsg);
		$div_add_town_success.fadeOut("fast");
		$div_add_town_error.fadeIn("fast");
	}else{
		$div_add_town_error.fadeOut("fast");
		$div_add_town_success.fadeOut("fast");
				
		$("#add_town_loader").show();
				
		var form = document.getElementById('frm_addtown');
		var formData = new FormData(form);

		$.ajax({
           	url: baseDir+'be/towns/save',
           	type: 'POST',
           	data: formData,
			dataType: 'json',
           	xhr: function() {
           		var myXhr = $.ajaxSettings.xhr();
           		return myXhr;
           	},
           	cache: false,
           	contentType: false,
           	processData: false,
           	success: function (res) {
				$("#add_town_loader").hide();
				if(res.status == 'ERR'){
					$div_add_town_error.html(res.message);
					$div_add_town_success.fadeOut("fast");
					$div_add_town_error.fadeIn("fast");
				}else if (res.status == 'SUCCESS'){
					$div_add_town_success.html(res.message);
					$div_add_town_error.fadeOut("fast");
					$div_add_town_success.fadeIn("fast");
				
					$( '#frm_addtown' ).each(function(){
						this.reset();
					});	
					$("#add_country_id").val('').change(); 

					load_towns();

				}
           	},
			error: function(){
				$("#add_town_loader").hide();
				$div_add_town_error.html("Something went wrong. Please check your network and try again.");
				$div_add_town_success.fadeOut("fast");
				$div_add_town_error.fadeIn("fast");
			}
       	});
	}
	return false;
}

//LOAD towns
function load_towns(){
	$('#div_towns_loader').oLoader({
		backgroundColor:'#fff',
		image: baseDir+'assets/be/js/plugins/oLoader/images/ownageLoader/loader9.gif',
		fadeInTime: 500,
		fadeOutTime: 1000,
		fadeLevel: 0.8
	});				
	$.ajax({
     	url: baseDir+'be/towns/loadjs',
       	type: 'POST',
       	data: '',
       	xhr: function() {
       		var myXhr = $.ajaxSettings.xhr();
       		return myXhr;
       	},
       	cache: false,
       	contentType: false,
       	processData: false,
     	success: function (result) {
			$("#towns_div").html(result);
			$('#div_towns_loader').oLoader('hide');			
   		},
		error: function(){
			$('#div_towns_loader').oLoader('hide');
		}
    });
}
function town_edit_load(town_id){
	$.ajax({
     	url: baseDir+'be/towns/get_town/'+town_id,
       	type: 'POST',
       	data: '',
       	xhr: function() {
       		var myXhr = $.ajaxSettings.xhr();
       		return myXhr;
       	},
       	cache: false,
       	contentType: false,
       	processData: false,
     	success: function (res) {
     		try{
     			var obj1 = res;
     			obj1 = obj1.replace('[','');
     			obj1 = obj1.replace(']','');
	     		var obj = $.parseJSON(obj1);

	     		$("#edit_country_id").val(obj['country_id']).change(); 
	     		$("#edit_town_id").val(obj['town_id']);
	     		$("#edit_town_name").val(obj['town_name']);
	     		$("#edit_town_description").val(obj['town_description']);

     		}catch(err){
     			alert(err);
     		}
   		},
		error: function(){
		}
    });
   	$div_edit_town_error.fadeOut("fast");
	$div_edit_town_success.fadeOut("fast");

}
function update_town(){
		$div_edit_town_error = $("#div_edit_town_error");
		$div_edit_town_success = $("#div_edit_town_success");
				
		$edit_country_id = $("#edit_country_id").val();
		$edit_town_name = $("#edit_town_name").val();
		$edit_town_description = $("#edit_town_description").val();
	
		$valmsg = "";
		$valmsg2 = "";
		
		if ($edit_country_id == ""){$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please select Country<br/>";}
		if ($edit_town_name == ""){$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please enter Town Name <br/>";}
		
		if ($valmsg != $valmsg2){
			$div_edit_town_error.html($valmsg);
			$div_edit_town_success.fadeOut("fast");
			$div_edit_town_error.fadeIn("fast");
		}else{
			$div_edit_town_error.fadeOut("fast");
			$div_edit_town_success.fadeOut("fast");
				
			$("#edit_town_loader").show();
					
			var form = document.getElementById('frm_edittown');
			var formData = new FormData(form);

			$.ajax({
            	url: baseDir+'be/towns/update',
            	type: 'POST',
            	data: formData,
				dataType: 'json',
            	xhr: function() {
               		var myXhr = $.ajaxSettings.xhr();
               		return myXhr;
            	},
            	cache: false,
            	contentType: false,
            	processData: false,
            	success: function (res) {
					$("#edit_town_loader").hide();
					if(res.status == 'ERR'){
						$div_edit_town_error.html(res.message);
						$div_edit_town_success.fadeOut("fast");
						$div_edit_town_error.fadeIn("fast");
					}else if (res.status == 'SUCCESS'){
						$div_edit_town_success.html(res.message);
						$div_edit_town_error.fadeOut("fast");
						$div_edit_town_success.fadeIn("fast");
						
						load_towns();
					}
            	},
				error: function(){
					$("#edit_town_loader").hide();
					$div_edit_town_error.html("Something went wrong. Please check your network and try again.");
					$div_edit_town_success.fadeOut("fast");
					$div_edit_town_error.fadeIn("fast");
				}
        	});
	
		}
		return false;
}
function delete_town(town_id){
	$div_town_error = $("#div_town_error");
	$div_town_success = $("#div_town_success");

	$div_town_error.fadeOut("fast");
	$div_town_success.fadeOut("fast");

	$.ajax({
     	url: baseDir+'be/towns/delete/'+town_id,
       	type: 'POST',
       	data: '',
       	xhr: function() {
       		var myXhr = $.ajaxSettings.xhr();
       		return myXhr;
       	},
       	cache: false,
       	contentType: false,
       	processData: false,
     	success: function (res) {
     		try{
     			var obj1 = res;
	     		var obj = $.parseJSON(obj1);

				if(obj['status'] == 'ERR'){
					$div_town_error.html(obj['message']);
					$div_town_success.fadeOut("fast");
					$div_town_error.fadeIn("fast");
				}else if (obj['status'] == 'SUCCESS'){
					$div_town_success.html(obj['message']);
					$div_town_error.fadeOut("fast");
					$div_town_success.fadeIn("fast");

					load_towns();

				}
     		}catch(err){
     			alert(err);
     		}    		
   		},
		error: function(){
			$div_town_error.html("Something went wrong. Please check your network and try again.");
			$div_town_success.fadeOut("fast");
			$div_town_error.fadeIn("fast");
		}
    });
}




//AREAS
$(document).ready(function(){

	//$('#div_listing_types_loader').oLoader('hide');

	/*$("#add_area_region_id").on('change', function() {
    	//alert( this.value );
    	$("#add_area_city_id")
    		.find('option')
    		.remove()
    		.end()
    		.append('<option value=""></option>')
    		.val('')
		;
    	if (this.value != ''){
			$.ajax({
		     	url: baseDir+'be/cities/get_cities_by_region/'+this.value,
		       	type: 'POST',
		       	data: '',
		       	xhr: function() {
		       		var myXhr = $.ajaxSettings.xhr();
		       		return myXhr;
		       	},
		       	cache: false,
		       	contentType: false,
		       	processData: false,
		     	success: function (res) {
		     		try{
		     			var obj1 = res;
						// preserve newlines, etc - use valid JSON
						obj1 = obj1.replace(/\\n/g, "\\n")  
						               .replace(/\\'/g, "\\'")
						               .replace(/\\"/g, '\\"')
						               .replace(/\\&/g, "\\&")
						               .replace(/\\r/g, "\\r")
						               .replace(/\\t/g, "\\t")
						               .replace(/\\b/g, "\\b")
						               .replace(/\\f/g, "\\f");
						// remove non-printable and other non-valid JSON chars
						obj1 = obj1.replace(/[\u0000-\u0019]+/g,""); 
			     		var obj = JSON.parse(obj1);
			     		for (i=0; i< obj.length; i++){ 
         					$("#add_area_city_id").append($("<option>").attr('value',obj[i]['city_id']).text(obj[i]['city_name']));
  						};	

		     		}catch(err){
		     			alert(err);
		     		}
		   		},
				error: function(){
				}
		    });
    	}
    })
 	$("#edit_area_region_id").on('change', function() {
    	//alert( this.value );
    	$("#edit_area_city_id")
    		.find('option')
    		.remove()
    		.end()
    		.append('<option value=""></option>')
    		.val('')
		;
    	if (this.value != ''){
			$.ajax({
		     	url: baseDir+'be/cities/get_cities_by_region/'+this.value,
		       	type: 'POST',
		       	data: '',
		       	xhr: function() {
		       		var myXhr = $.ajaxSettings.xhr();
		       		return myXhr;
		       	},
		       	cache: false,
		       	contentType: false,
		       	processData: false,
		     	success: function (res) {
		     		try{
		     			var obj1 = res;
						// preserve newlines, etc - use valid JSON
						obj1 = obj1.replace(/\\n/g, "\\n")  
						               .replace(/\\'/g, "\\'")
						               .replace(/\\"/g, '\\"')
						               .replace(/\\&/g, "\\&")
						               .replace(/\\r/g, "\\r")
						               .replace(/\\t/g, "\\t")
						               .replace(/\\b/g, "\\b")
						               .replace(/\\f/g, "\\f");
						// remove non-printable and other non-valid JSON chars
						obj1 = obj1.replace(/[\u0000-\u0019]+/g,""); 
			     		var obj = JSON.parse(obj1);
			     		for (i=0; i< obj.length; i++){ 
         					$("#edit_area_city_id").append($("<option>").attr('value',obj[i]['city_id']).text(obj[i]['city_name']));
  						};	

						$("#edit_area_city_id").val(cur_city_id).trigger('change');


		     		}catch(err){
		     			alert(err);
		     		}
		   		},
				error: function(){
				}
		    });
    	}
    })*/
}); 

function area_add_clear(){
	//alert('Test');
	$( '#frm_addarea' ).each(function(){
		this.reset();
	});	
	$div_add_area_success.fadeOut("fast");
	$div_add_area_error.fadeOut("fast");
}

function save_area(){
	$div_add_area_error = $("#div_add_area_error");
	$div_add_area_success = $("#div_add_area_success");
				
	//$add_region_id = $("#add_area_region_id").val();
	$add_city_id = $("#add_area_city_id").val();
	$add_area_name = $("#add_area_name").val();
	$add_area_description = $("#add_area_description").val();
	
	$valmsg = "";
	$valmsg2 = "";
		
	//if ($add_region_id == ""){$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please select Region<br/>";}
	if ($add_city_id == ""){$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please select City/Town<br/>";}
	if ($add_area_name == ""){$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please enter Area Name <br/>";}
				
	if ($valmsg != $valmsg2){
		$div_add_area_error.html($valmsg);
		$div_add_area_success.fadeOut("fast");
		$div_add_area_error.fadeIn("fast");
	}else{
		$div_add_area_error.fadeOut("fast");
		$div_add_area_success.fadeOut("fast");
				
		$("#add_area_loader").show();
				
		var form = document.getElementById('frm_addarea');
		var formData = new FormData(form);

		$.ajax({
           	url: baseDir+'be/areas/save',
           	type: 'POST',
           	data: formData,
			dataType: 'json',
           	xhr: function() {
           		var myXhr = $.ajaxSettings.xhr();
           		return myXhr;
           	},
           	cache: false,
           	contentType: false,
           	processData: false,
           	success: function (res) {
				$("#add_area_loader").hide();
				if(res.status == 'ERR'){
					$div_add_area_error.html(res.message);
					$div_add_area_success.fadeOut("fast");
					$div_add_area_error.fadeIn("fast");
				}else if (res.status == 'SUCCESS'){
					$div_add_area_success.html(res.message);
					$div_add_area_error.fadeOut("fast");
					$div_add_area_success.fadeIn("fast");
				
					$( '#frm_addarea' ).each(function(){
						this.reset();
						//$("#add_area_region_id").val('').trigger('change');
						$("#add_area_city_id").val('').trigger('change');
					});	

					load_areas();

				}
           	},
			error: function(){
				$("#add_area_loader").hide();
				$div_add_area_error.html("Something went wrong. Please check your network and try again.");
				$div_add_area_success.fadeOut("fast");
				$div_add_area_error.fadeIn("fast");
			}
       	});
	}
	return false;
}
//LOAD AREAS
function load_areas(){
	$('#div_areas_loader').oLoader({
		backgroundColor:'#fff',
		image: baseDir+'assets/be/js/plugins/oLoader/images/ownageLoader/loader9.gif',
		fadeInTime: 500,
		fadeOutTime: 1000,
		fadeLevel: 0.8
	});				
	$.ajax({
     	url: baseDir+'be/areas/loadjs',
       	type: 'POST',
       	data: '',
       	xhr: function() {
       		var myXhr = $.ajaxSettings.xhr();
       		return myXhr;
       	},
       	cache: false,
       	contentType: false,
       	processData: false,
     	success: function (result) {
			$("#areas_div").html(result);
			$('#div_areas_loader').oLoader('hide');			
   		},
		error: function(){
			$('#div_areas_loader').oLoader('hide');
		}
    });
}
function area_edit_load(area_id){
	$.ajax({
     	url: baseDir+'be/areas/get_area/'+area_id,
       	type: 'POST',
       	data: '',
       	xhr: function() {
       		var myXhr = $.ajaxSettings.xhr();
       		return myXhr;
       	},
       	cache: false,
       	contentType: false,
       	processData: false,
     	success: function (res) {
     		try{
     			var obj1 = res;
     			obj1 = obj1.replace('[','');
     			obj1 = obj1.replace(']','');
	     		var obj = $.parseJSON(obj1);

	     		//$("#edit_area_region_id").val(obj['region_id']).trigger('change'); 
	     		cur_city_id = obj['city_id'];
	     		$("#edit_area_city_id").val(obj['city_id']).trigger('change'); 
	     		$("#edit_area_id").val(obj['area_id']);
	     		$("#edit_area_name").val(obj['area_name']);
	     		$("#edit_area_description").val(obj['area_description']);
				
     		}catch(err){
     			alert(err);
     		}
   		},
		error: function(){
		}
    });
   	$div_edit_area_error.fadeOut("fast");
	$div_edit_area_success.fadeOut("fast");

}
function update_area(){
		$div_edit_area_error = $("#div_edit_area_error");
		$div_edit_area_success = $("#div_edit_area_success");
				
		//$edit_area_region_id = $("#edit_area_region_id").val();
		$edit_area_city_id = $("#edit_area_city_id").val();
		$edit_area_name = $("#edit_area_name").val();
		$edit_area_description = $("#edit_area_description").val();
	
		$valmsg = "";
		$valmsg2 = "";
		
		//if ($edit_area_region_id == ""){$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please select Region<br/>";}
		if ($edit_area_city_id == ""){$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please select City/Town<br/>";}
		if ($edit_area_name == ""){$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please enter Area Name <br/>";}
		
		if ($valmsg != $valmsg2){
			$div_edit_area_error.html($valmsg);
			$div_edit_area_success.fadeOut("fast");
			$div_edit_area_error.fadeIn("fast");
		}else{
			$div_edit_area_error.fadeOut("fast");
			$div_edit_area_success.fadeOut("fast");
				
			$("#edit_area_loader").show();
					
			var form = document.getElementById('frm_editarea');
			var formData = new FormData(form);

			$.ajax({
            	url: baseDir+'be/areas/update',
            	type: 'POST',
            	data: formData,
				dataType: 'json',
            	xhr: function() {
               		var myXhr = $.ajaxSettings.xhr();
               		return myXhr;
            	},
            	cache: false,
            	contentType: false,
            	processData: false,
            	success: function (res) {
					$("#edit_area_loader").hide();
					if(res.status == 'ERR'){
						$div_edit_area_error.html(res.message);
						$div_edit_area_success.fadeOut("fast");
						$div_edit_area_error.fadeIn("fast");
					}else if (res.status == 'SUCCESS'){
						$div_edit_area_success.html(res.message);
						$div_edit_area_error.fadeOut("fast");
						$div_edit_area_success.fadeIn("fast");
						
						load_areas();

					}
            	},
				error: function(){
					$("#edit_area_loader").hide();
					$div_edit_area_error.html("Something went wrong. Please check your network and try again.");
					$div_edit_area_success.fadeOut("fast");
					$div_edit_area_error.fadeIn("fast");
				}
        	});
	
		}
		return false;
}
function delete_area(area_id){
	$div_area_error = $("#div_area_error");
	$div_area_success = $("#div_area_success");

	$div_area_error.fadeOut("fast");
	$div_area_success.fadeOut("fast");

	$.ajax({
     	url: baseDir+'be/areas/delete/'+area_id,
       	type: 'POST',
       	data: '',
       	xhr: function() {
       		var myXhr = $.ajaxSettings.xhr();
       		return myXhr;
       	},
       	cache: false,
       	contentType: false,
       	processData: false,
     	success: function (res) {
     		try{
     			var obj1 = res;
	     		var obj = $.parseJSON(obj1);

				if(obj['status'] == 'ERR'){
					$div_area_error.html(obj['message']);
					$div_area_success.fadeOut("fast");
					$div_area_error.fadeIn("fast");
				}else if (obj['status'] == 'SUCCESS'){
					$div_area_success.html(obj['message']);
					$div_area_error.fadeOut("fast");
					$div_area_success.fadeIn("fast");

					load_areas();
				}
     		}catch(err){
     			alert(err);
     		}    		
   		},
		error: function(){
			$div_area_error.html("Something went wrong. Please check your network and try again.");
			$div_area_success.fadeOut("fast");
			$div_area_error.fadeIn("fast");
		}
    });
}




//PROPERTY TYPES
function property_feature_type_add_clear(){
	//alert('Test');
	$( '#frm_addpropertyfeaturetype' ).each(function(){
		this.reset();
	});	
	$div_add_property_feature_type_success.fadeOut("fast");
	$div_add_property_feature_type_error.fadeOut("fast");
}

function save_property_feature_type(){
		$div_add_property_feature_type_error = $("#div_add_property_feature_type_error");
		$div_add_property_feature_type_success = $("#div_add_property_feature_type_success");
				
		$add_property_feature_type_name = $("#add_property_feature_type_name").val();
		$add_property_feature_type_description = $("#add_property_feature_type_description").val();
	

		if ($add_property_feature_type_name == ""){$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please enter Property Feature Type Name <br/>";}
		
		if ($valmsg != $valmsg2){
			$div_add_property_feature_type_error.html($valmsg);
			$div_add_property_feature_type_success.fadeOut("fast");
			$div_add_property_feature_type_error.fadeIn("fast");
		}else{
			$div_add_property_feature_type_error.fadeOut("fast");
			$div_add_property_feature_type_success.fadeOut("fast");
				
			$("#add_property_feature_type_loader").show();
					
			var form = document.getElementById('frm_addpropertyfeaturetype');
			var formData = new FormData(form);

			$.ajax({
            	url: baseDir+'be/property_feature_types/save',
            	type: 'POST',
            	data: formData,
				dataType: 'json',
            	xhr: function() {
               		var myXhr = $.ajaxSettings.xhr();
               		return myXhr;
            	},
            	cache: false,
            	contentType: false,
            	processData: false,
            	success: function (res) {
					$("#add_property_feature_type_loader").hide();
					if(res.status == 'ERR'){
						$div_add_property_feature_type_error.html(res.message);
						$div_add_property_feature_type_success.fadeOut("fast");
						$div_add_property_feature_type_error.fadeIn("fast");
					}else if (res.status == 'SUCCESS'){
						$div_add_property_feature_type_success.html(res.message);
						$div_add_property_feature_type_error.fadeOut("fast");
						$div_add_property_feature_type_success.fadeIn("fast");
						
						$( '#frm_addpropertyfeaturetype' ).each(function(){
							this.reset();
						});	

						load_property_feature_types();

					}
            	},
				error: function(){
					$("#add_property_feature_type_loader").hide();
					$div_add_property_feature_type_error.html("Something went wrong. Please check your network and try again.");
					$div_add_property_feature_type_success.fadeOut("fast");
					$div_add_property_feature_type_error.fadeIn("fast");
				}
        	});
	
		}
		return false;
}
//LOAD PROPERTY FEATURE TYPES
function load_property_feature_types(){
	$('#div_property_feature_types_loader').oLoader({
		backgroundColor:'#fff',
		image: baseDir+'assets/be/js/plugins/oLoader/images/ownageLoader/loader9.gif',
		fadeInTime: 500,
		fadeOutTime: 1000,
		fadeLevel: 0.8
	});				
	$.ajax({
     	url: baseDir+'be/property_feature_types/loadjs',
       	type: 'POST',
       	data: '',
       	xhr: function() {
       		var myXhr = $.ajaxSettings.xhr();
       		return myXhr;
       	},
       	cache: false,
       	contentType: false,
       	processData: false,
     	success: function (result) {
			$("#property_feature_types_div").html(result);
			$('#div_property_feature_types_loader').oLoader('hide');			
   		},
		error: function(){
			$('#div_property_feature_types_loader').oLoader('hide');
		}
    });
}
function property_feature_type_edit_load(property_feature_type_id){
	$.ajax({
     	url: baseDir+'be/property_feature_types/get_property_feature_type/'+property_feature_type_id,
       	type: 'POST',
       	data: '',
       	xhr: function() {
       		var myXhr = $.ajaxSettings.xhr();
       		return myXhr;
       	},
       	cache: false,
       	contentType: false,
       	processData: false,
     	success: function (res) {
     		try{
     			var obj1 = res;
     			obj1 = obj1.replace('[','');
     			obj1 = obj1.replace(']','');
	     		var obj = $.parseJSON(obj1);
	     		$("#edit_property_feature_type_id").val(obj['property_feature_type_id']);
	     		$("#edit_property_feature_type_name").val(obj['property_feature_type_name']);
	     		$("#edit_property_feature_type_description").val(obj['property_feature_type_description']);

     		}catch(err){
     			alert(err);
     		}
   		},
		error: function(){
		}
    });
   	$div_edit_property_feature_type_error.fadeOut("fast");
	$div_edit_property_feature_type_success.fadeOut("fast");

}
function update_property_feature_type(){
		$div_edit_property_feature_type_error = $("#div_edit_property_feature_type_error");
		$div_edit_property_feature_type_success = $("#div_edit_property_feature_type_success");
				
		$edit_property_feature_type_name = $("#edit_property_feature_type_name").val();
		$edit_property_feature_type_description = $("#edit_property_feature_type_description").val();
	
		$valmsg = "";
		$valmsg2 = "";
		
		if ($edit_property_feature_type_name == ""){$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please enter Property Feature Type Name <br/>";}
		
		if ($valmsg != $valmsg2){
			$div_edit_property_feature_type_error.html($valmsg);
			$div_edit_property_feature_type_success.fadeOut("fast");
			$div_edit_property_feature_type_error.fadeIn("fast");
		}else{
			$div_edit_property_feature_type_error.fadeOut("fast");
			$div_edit_property_feature_type_success.fadeOut("fast");
				
			$("#edit_property_feature_type_loader").show();
					
			var form = document.getElementById('frm_editpropertyfeaturetype');
			var formData = new FormData(form);

			$.ajax({
            	url: baseDir+'be/property_feature_types/update',
            	type: 'POST',
            	data: formData,
				dataType: 'json',
            	xhr: function() {
               		var myXhr = $.ajaxSettings.xhr();
               		return myXhr;
            	},
            	cache: false,
            	contentType: false,
            	processData: false,
            	success: function (res) {
					$("#edit_property_feature_type_loader").hide();
					if(res.status == 'ERR'){
						$div_edit_property_feature_type_error.html(res.message);
						$div_edit_property_feature_type_success.fadeOut("fast");
						$div_edit_property_feature_type_error.fadeIn("fast");
					}else if (res.status == 'SUCCESS'){
						$div_edit_property_feature_type_success.html(res.message);
						$div_edit_property_feature_type_error.fadeOut("fast");
						$div_edit_property_feature_type_success.fadeIn("fast");
						
						load_property_feature_types();

					}
            	},
				error: function(){
					$("#edit_property_feature_type_loader").hide();
					$div_edit_property_feature_type_error.html("Something went wrong. Please check your network and try again.");
					$div_edit_property_feature_type_success.fadeOut("fast");
					$div_edit_property_feature_type_error.fadeIn("fast");
				}
        	});
	
		}
		return false;
}
function delete_property_feature_type(property_feature_type_id){
    //alert('Am clicked!');
    $div_property_feature_type_error = $("#div_property_feature_type_error");
    $div_property_feature_type_success = $("#div_property_feature_type_success");

    $div_property_feature_type_error.fadeOut("fast");
    $div_property_feature_type_success.fadeOut("fast");

    $.ajax({
        url: baseDir+'be/property_feature_types/delete/'+property_feature_type_id,
        type: 'POST',
        data: '',
        xhr: function() {
            var myXhr = $.ajaxSettings.xhr();
            return myXhr;
        },
        cache: false,
        contentType: false,
        processData: false,
        success: function (res) {
            try{
                var obj1 = res;
                var obj = $.parseJSON(obj1);

                if(obj['status'] == 'ERR'){
                    $div_property_feature_type_error.html(obj['message']);
                    $div_property_feature_type_success.fadeOut("fast");
                    $div_property_feature_type_error.fadeIn("fast");
                }else if (obj['status'] == 'SUCCESS'){
                    $div_property_feature_type_success.html(obj['message']);
                    $div_property_feature_type_error.fadeOut("fast");
                    $div_property_feature_type_success.fadeIn("fast");

                    load_property_feature_types();
                }
            }catch(err){
                alert(err);
            }           
        },
        error: function(){
            $div_property_feature_type_error.html("Something went wrong. Please check your network and try again.");
            $div_property_feature_type_success.fadeOut("fast");
            $div_property_feature_type_error.fadeIn("fast");
        }
    });
}








//PROPERTY FEATURES
function property_feature_add_clear(){
	//alert('Test');
	$( '#frm_addpropertyfeature' ).each(function(){
		this.reset();
	});	
	$div_add_property_feature_success.fadeOut("fast");
	$div_add_property_feature_error.fadeOut("fast");
}

function save_property_feature(){
	$div_add_property_feature_error = $("#div_add_property_feature_error");
	$div_add_property_feature_success = $("#div_add_property_feature_success");
				
	//$add_property_feature_type_id = $("#add_property_feature_type_id").val();
	$add_property_feature_name = $("#add_property_feature_name").val();
	$add_property_feature_description = $("#add_property_feature_description").val();
	
	$valmsg = "";
	$valmsg2 = "";
		
	//if ($add_property_feature_type_id == ""){$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please select Property Feature Type<br/>";}
	if ($add_property_feature_name == ""){$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please enter Property Feature Name <br/>";}
				
	if ($valmsg != $valmsg2){
		$div_add_property_feature_error.html($valmsg);
		$div_add_property_feature_success.fadeOut("fast");
		$div_add_property_feature_error.fadeIn("fast");
	}else{
		$div_add_property_feature_error.fadeOut("fast");
		$div_add_property_feature_success.fadeOut("fast");
				
		$("#add_property_feature_loader").show();
				
		var form = document.getElementById('frm_addpropertyfeature');
		var formData = new FormData(form);

		$.ajax({
           	url: baseDir+'be/property_features/save',
           	type: 'POST',
           	data: formData,
			dataType: 'json',
           	xhr: function() {
           		var myXhr = $.ajaxSettings.xhr();
           		return myXhr;
           	},
           	cache: false,
           	contentType: false,
           	processData: false,
           	success: function (res) {
				$("#add_property_feature_loader").hide();
				if(res.status == 'ERR'){
					$div_add_property_feature_error.html(res.message);
					$div_add_property_feature_success.fadeOut("fast");
					$div_add_property_feature_error.fadeIn("fast");
				}else if (res.status == 'SUCCESS'){
					$div_add_property_feature_success.html(res.message);
					$div_add_property_feature_error.fadeOut("fast");
					$div_add_property_feature_success.fadeIn("fast");
				
					$( '#frm_addpropertyfeature' ).each(function(){
						this.reset();
						//$("#add_property_feature_type_id").val('').trigger('change');
					});	

					load_property_features();

				}
           	},
			error: function(){
				$("#add_property_feature_loader").hide();
				$div_add_property_feature_error.html("Something went wrong. Please check your network and try again.");
				$div_add_property_feature_success.fadeOut("fast");
				$div_add_property_feature_error.fadeIn("fast");
			}
       	});
	}
	return false;
}

//LOAD PROPERTY FEATURES
function load_property_features(){
	$('#div_property_feature_types_loader').oLoader({
		backgroundColor:'#fff',
		image: baseDir+'assets/be/js/plugins/oLoader/images/ownageLoader/loader9.gif',
		fadeInTime: 500,
		fadeOutTime: 1000,
		fadeLevel: 0.8
	});				
	$.ajax({
     	url: baseDir+'be/property_features/loadjs',
       	type: 'POST',
       	data: '',
       	xhr: function() {
       		var myXhr = $.ajaxSettings.xhr();
       		return myXhr;
       	},
       	cache: false,
       	contentType: false,
       	processData: false,
     	success: function (result) {
			$("#property_features_div").html(result);
			$('#div_property_features_loader').oLoader('hide');			
   		},
		error: function(){
			$('#div_property_features_loader').oLoader('hide');
		}
    });
}
function property_feature_edit_load(property_feature_id){
	$.ajax({
     	url: baseDir+'be/property_features/get_property_feature/'+property_feature_id,
       	type: 'POST',
       	data: '',
       	xhr: function() {
       		var myXhr = $.ajaxSettings.xhr();
       		return myXhr;
       	},
       	cache: false,
       	contentType: false,
       	processData: false,
     	success: function (res) {
     		try{
     			var obj1 = res;
     			obj1 = obj1.replace('[','');
     			obj1 = obj1.replace(']','');
	     		var obj = $.parseJSON(obj1);

	     		//$("#edit_property_feature_type_id").val(obj['property_feature_type_id']).change(); 
	     		$("#edit_property_feature_id").val(obj['property_feature_id']);
	     		$("#edit_property_feature_name").val(obj['property_feature_name']);
	     		$("#edit_property_feature_description").val(obj['property_feature_description']);

     		}catch(err){
     			alert(err);
     		}
   		},
		error: function(){
		}
    });
   	$div_edit_property_feature_error.fadeOut("fast");
	$div_edit_property_feature_success.fadeOut("fast");

}
function update_property_feature(){
		$div_edit_property_feature_error = $("#div_edit_property_feature_error");
		$div_edit_property_feature_success = $("#div_edit_property_feature_success");
				
		//$edit_property_feature_type_id = $("#edit_property_feature_type_id").val();
		$edit_property_feature_name = $("#edit_property_feature_name").val();
		$edit_property_feature_description = $("#edit_property_feature_description").val();
	
		$valmsg = "";
		$valmsg2 = "";
		
		//if ($edit_property_feature_type_id == ""){$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please select Property Feature Type<br/>";}
		if ($edit_property_feature_name == ""){$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please enter Property Feature Name <br/>";}
		
		if ($valmsg != $valmsg2){
			$div_edit_property_feature_error.html($valmsg);
			$div_edit_property_feature_success.fadeOut("fast");
			$div_edit_property_feature_error.fadeIn("fast");
		}else{
			$div_edit_property_feature_error.fadeOut("fast");
			$div_edit_property_feature_success.fadeOut("fast");
				
			$("#edit_property_feature_loader").show();
					
			var form = document.getElementById('frm_editpropertyfeature');
			var formData = new FormData(form);

			$.ajax({
            	url: baseDir+'be/property_features/update',
            	type: 'POST',
            	data: formData,
				dataType: 'json',
            	xhr: function() {
               		var myXhr = $.ajaxSettings.xhr();
               		return myXhr;
            	},
            	cache: false,
            	contentType: false,
            	processData: false,
            	success: function (res) {
					$("#edit_property_feature_loader").hide();
					if(res.status == 'ERR'){
						$div_edit_property_feature_error.html(res.message);
						$div_edit_property_feature_success.fadeOut("fast");
						$div_edit_property_feature_error.fadeIn("fast");
					}else if (res.status == 'SUCCESS'){
						$div_edit_property_feature_success.html(res.message);
						$div_edit_property_feature_error.fadeOut("fast");
						$div_edit_property_feature_success.fadeIn("fast");
						
						load_property_features();

					}
            	},
				error: function(){
					$("#edit_property_feature_loader").hide();
					$div_edit_property_feature_error.html("Something went wrong. Please check your network and try again.");
					$div_edit_property_feature_success.fadeOut("fast");
					$div_edit_property_feature_error.fadeIn("fast");
				}
        	});
	
		}
		return false;
}
function delete_property_feature(property_feature_id){
	$div_property_feature_error = $("#div_property_feature_error");
	$div_property_feature_success = $("#div_property_feature_success");

	$div_property_feature_error.fadeOut("fast");
	$div_property_feature_success.fadeOut("fast");

	$.ajax({
     	url: baseDir+'be/property_features/delete/'+property_feature_id,
       	type: 'POST',
       	data: '',
       	xhr: function() {
       		var myXhr = $.ajaxSettings.xhr();
       		return myXhr;
       	},
       	cache: false,
       	contentType: false,
       	processData: false,
     	success: function (res) {
     		try{
     			var obj1 = res;
	     		var obj = $.parseJSON(obj1);

				if(obj['status'] == 'ERR'){
					$div_property_feature_error.html(obj['message']);
					$div_property_feature_success.fadeOut("fast");
					$div_property_feature_error.fadeIn("fast");
				}else if (obj['status'] == 'SUCCESS'){
					$div_property_feature_success.html(obj['message']);
					$div_property_feature_error.fadeOut("fast");
					$div_property_feature_success.fadeIn("fast");

					load_property_features();
				}
     		}catch(err){
     			alert(err);
     		}    		
   		},
		error: function(){
			$div_property_feature_error.html("Something went wrong. Please check your network and try again.");
			$div_property_feature_success.fadeOut("fast");
			$div_property_feature_error.fadeIn("fast");
		}
    });
}




//CURRENCIES
function currency_add_clear(){
	//alert('Test');
	$( '#frm_addcurrency' ).each(function(){
		this.reset();
	});	
	$div_add_currency_success.fadeOut("fast");
	$div_add_currency_error.fadeOut("fast");
}

function save_currency(){
		$div_add_currency_error = $("#div_add_currency_error");
		$div_add_currency_success = $("#div_add_currency_success");
				
		$add_country_name = $("#add_country_name").val();
		$add_country_code = $("#add_country_code").val();		
		$add_currency_name = $("#add_currency_name").val();
		$add_currency_symbol = $("#add_currency_symbol").val();

  		$valmsg = "";
		$valmsg2 = "";
	
		if ($add_country_name == ""){$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please enter Country Name <br/>";}
		if ($add_country_code == ""){$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please enter Country Code <br/>";}
		if ($add_currency_name == ""){$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please enter Currency Name <br/>";}
		if ($add_currency_symbol == ""){$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please enter Currency Symbol <br/>";}
		
		if ($valmsg != $valmsg2){
			$div_add_currency_error.html($valmsg);
			$div_add_currency_success.fadeOut("fast");
			$div_add_currency_error.fadeIn("fast");
		}else{
			$div_add_currency_error.fadeOut("fast");
			$div_add_currency_success.fadeOut("fast");
				
			$("#add_currency_loader").show();
					
			var form = document.getElementById('frm_addcurrency');
			var formData = new FormData(form);

			$.ajax({
            	url: baseDir+'be/currencies/save',
            	type: 'POST',
            	data: formData,
				dataType: 'json',
            	xhr: function() {
               		var myXhr = $.ajaxSettings.xhr();
               		return myXhr;
            	},
            	cache: false,
            	contentType: false,
            	processData: false,
            	success: function (res) {
					$("#add_currency_loader").hide();
					if(res.status == 'ERR'){
						$div_add_currency_error.html(res.message);
						$div_add_currency_success.fadeOut("fast");
						$div_add_currency_error.fadeIn("fast");
					}else if (res.status == 'SUCCESS'){
						$div_add_currency_success.html(res.message);
						$div_add_currency_error.fadeOut("fast");
						$div_add_currency_success.fadeIn("fast");
						
						$( '#frm_addcurrency' ).each(function(){
							this.reset();
						});	

						load_currencies();

					}
            	},
				error: function(){
					$("#add_currency_loader").hide();
					$div_add_currency_error.html("Something went wrong. Please check your network and try again.");
					$div_add_currency_success.fadeOut("fast");
					$div_add_currency_error.fadeIn("fast");
				}
        	});
	
		}
		return false;
}
//CURRENCIES
function load_currencies(){
	$('#div_currencies_loader').oLoader({
		backgroundColor:'#fff',
		image: baseDir+'assets/be/js/plugins/oLoader/images/ownageLoader/loader9.gif',
		fadeInTime: 500,
		fadeOutTime: 1000,
		fadeLevel: 0.8
	});				
	$.ajax({
     	url: baseDir+'be/currencies/loadjs',
       	type: 'POST',
       	data: '',
       	xhr: function() {
       		var myXhr = $.ajaxSettings.xhr();
       		return myXhr;
       	},
       	cache: false,
       	contentType: false,
       	processData: false,
     	success: function (result) {
			$("#currencies_div").html(result);
			$('#div_currencies_loader').oLoader('hide');			
   		},
		error: function(){
			$('#div_currencies_loader').oLoader('hide');
		}
    });
}
function currency_edit_load(currency_id){
	$.ajax({
     	url: baseDir+'be/currencies/get_currency/'+currency_id,
       	type: 'POST',
       	data: '',
       	xhr: function() {
       		var myXhr = $.ajaxSettings.xhr();
       		return myXhr;
       	},
       	cache: false,
       	contentType: false,
       	processData: false,
     	success: function (res) {
     		try{
     			var obj1 = res;
     			obj1 = obj1.replace('[','');
     			obj1 = obj1.replace(']','');
	     		var obj = $.parseJSON(obj1);
			     $("#edit_currency_id").val(obj['currency_id']);
			     $("#edit_country_name").val(obj['country_name']);
			     $("#edit_country_code").val(obj['country_code']);
			     $("#edit_currency_name").val(obj['currency_name']);
			     $("#edit_currency_symbol").val(obj['currency_symbol']);

     		}catch(err){
     			alert(err);
     		}
   		},
		error: function(){
		}
    });
   	$div_edit_currency_error.fadeOut("fast");
	$div_edit_currency_success.fadeOut("fast");

}
function update_currency(){
		$div_edit_currency_error = $("#div_edit_currency_error");
		$div_edit_currency_success = $("#div_edit_currency_success");
				
		$edit_country_name = $("#edit_country_name").val();
		$edit_country_code = $("#edit_country_code").val();		
		$edit_currency_name = $("#edit_currency_name").val();
		$edit_currency_symbol = $("#edit_currency_symbol").val();
	
		$valmsg = "";
		$valmsg2 = "";
		
		if ($edit_country_name == ""){$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please enter Country Name <br/>";}
		if ($edit_country_code == ""){$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please enter Country Code <br/>";}
		if ($edit_currency_name == ""){$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please enter Currency Name <br/>";}
		if ($edit_currency_symbol == ""){$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please enter Currency Symbol <br/>";}
		
		if ($valmsg != $valmsg2){
			$div_edit_currency_error.html($valmsg);
			$div_edit_currency_success.fadeOut("fast");
			$div_edit_currency_error.fadeIn("fast");
		}else{
			$div_edit_currency_error.fadeOut("fast");
			$div_edit_currency_success.fadeOut("fast");
				
			$("#edit_currency_loader").show();
					
			var form = document.getElementById('frm_editcurrency');
			var formData = new FormData(form);

			$.ajax({
            	url: baseDir+'be/currencies/update',
            	type: 'POST',
            	data: formData,
				dataType: 'json',
            	xhr: function() {
               		var myXhr = $.ajaxSettings.xhr();
               		return myXhr;
            	},
            	cache: false,
            	contentType: false,
            	processData: false,
            	success: function (res) {
					$("#edit_currency_loader").hide();
					if(res.status == 'ERR'){
						$div_edit_currency_error.html(res.message);
						$div_edit_currency_success.fadeOut("fast");
						$div_edit_currency_error.fadeIn("fast");
					}else if (res.status == 'SUCCESS'){
						$div_edit_currency_success.html(res.message);
						$div_edit_currency_error.fadeOut("fast");
						$div_edit_currency_success.fadeIn("fast");
						
						load_currencies();

					}
            	},
				error: function(){
					$("#edit_currency_loader").hide();
					$div_edit_currency_error.html("Something went wrong. Please check your network and try again.");
					$div_edit_currency_success.fadeOut("fast");
					$div_edit_currency_error.fadeIn("fast");
				}
        	});
	
		}
		return false;
}
function delete_currency(currency_id){
    //alert('Am clicked!');
    $div_currency_error = $("#div_currency_error");
    $div_currency_success = $("#div_currency_success");

    $div_currency_error.fadeOut("fast");
    $div_currency_success.fadeOut("fast");

    $.ajax({
        url: baseDir+'be/currencies/delete/'+currency_id,
        type: 'POST',
        data: '',
        xhr: function() {
            var myXhr = $.ajaxSettings.xhr();
            return myXhr;
        },
        cache: false,
        contentType: false,
        processData: false,
        success: function (res) {
            try{
                var obj1 = res;
                var obj = $.parseJSON(obj1);

                if(obj['status'] == 'ERR'){
                    $div_currency_error.html(obj['message']);
                    $div_currency_success.fadeOut("fast");
                    $div_currency_error.fadeIn("fast");
                }else if (obj['status'] == 'SUCCESS'){
                    $div_currency_success.html(obj['message']);
                    $div_currency_error.fadeOut("fast");
                    $div_currency_success.fadeIn("fast");

                    load_currencies();
                }
            }catch(err){
                alert(err);
            }           
        },
        error: function(){
            $div_currency_error.html("Something went wrong. Please check your network and try again.");
            $div_currency_success.fadeOut("fast");
            $div_currency_error.fadeIn("fast");
        }
    });
}




//ACCESS LEVELS
function access_level_add_clear(){
	//alert('Test');
	$( '#frm_addaccesslevel' ).each(function(){
		this.reset();
	});	
	$div_add_access_level_success.fadeOut("fast");
	$div_add_access_level_error.fadeOut("fast");
}

function save_access_level(){
		$div_add_access_level_error = $("#div_add_access_level_error");
		$div_add_access_level_success = $("#div_add_access_level_success");
				
		$add_access_level_name = $("#add_access_level_name").val();
		$add_access_level_description = $("#add_access_level_description").val();
	
		$valmsg = "";
		$valmsg2 = "";
		
		if ($add_access_level_name == ""){$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please enter Access Level Name <br/>";}
		
		if ($valmsg != $valmsg2){
			$div_add_access_level_error.html($valmsg);
			$div_add_access_level_success.fadeOut("fast");
			$div_add_access_level_error.fadeIn("fast");
		}else{
			$div_add_access_level_error.fadeOut("fast");
			$div_add_access_level_success.fadeOut("fast");
				
			$("#add_access_level_loader").show();
					
			var form = document.getElementById('frm_addaccesslevel');
			var formData = new FormData(form);

			$.ajax({
            	url: baseDir+'be/access_levels/save',
            	type: 'POST',
            	data: formData,
				dataType: 'json',
            	xhr: function() {
               		var myXhr = $.ajaxSettings.xhr();
               		return myXhr;
            	},
            	cache: false,
            	contentType: false,
            	processData: false,
            	success: function (res) {
					$("#add_access_level_loader").hide();
					if(res.status == 'ERR'){
						$div_add_access_level_error.html(res.message);
						$div_add_access_level_success.fadeOut("fast");
						$div_add_access_level_error.fadeIn("fast");
					}else if (res.status == 'SUCCESS'){
						$div_add_access_level_success.html(res.message);
						$div_add_access_level_error.fadeOut("fast");
						$div_add_access_level_success.fadeIn("fast");
						
						$( '#frm_addaccesslevel' ).each(function(){
							this.reset();
						});	

						load_access_levels();

					}
            	},
				error: function(){
					$("#add_access_level_loader").hide();
					$div_add_access_level_error.html("Something went wrong. Please check your network and try again.");
					$div_add_access_level_success.fadeOut("fast");
					$div_add_access_level_error.fadeIn("fast");
				}
        	});
	
		}
		return false;
}
//LOAD ACCESS LEVELS
function load_access_levels(){
	$('#div_access_levels_loader').oLoader({
		backgroundColor:'#fff',
		image: baseDir+'assets/be/js/plugins/oLoader/images/ownageLoader/loader9.gif',
		fadeInTime: 500,
		fadeOutTime: 1000,
		fadeLevel: 0.8
	});				
	$.ajax({
     	url: baseDir+'be/access_levels/loadjs',
       	type: 'POST',
       	data: '',
       	xhr: function() {
       		var myXhr = $.ajaxSettings.xhr();
       		return myXhr;
       	},
       	cache: false,
       	contentType: false,
       	processData: false,
     	success: function (result) {
			$("#access_levels_div").html(result);
			$('#div_access_levels_loader').oLoader('hide');			
   		},
		error: function(){
			$('#div_access_levels_loader').oLoader('hide');
		}
    });
}
function access_level_edit_load(access_level_id){
	$.ajax({
     	url: baseDir+'be/access_levels/get_access_level/'+access_level_id,
       	type: 'POST',
       	data: '',
       	xhr: function() {
       		var myXhr = $.ajaxSettings.xhr();
       		return myXhr;
       	},
       	cache: false,
       	contentType: false,
       	processData: false,
     	success: function (res) {
     		try{
     			var obj1 = res;
     			obj1 = obj1.replace('[','');
     			obj1 = obj1.replace(']','');
	     		var obj = $.parseJSON(obj1);
	     		$("#edit_access_level_id").val(obj['access_level_id']);
	     		$("#edit_access_level_name").val(obj['access_level_name']);
	     		$("#edit_access_level_description").val(obj['access_level_description']);

     		}catch(err){
     			alert(err);
     		}
   		},
		error: function(){
		}
    });
   	$div_edit_access_level_error.fadeOut("fast");
	$div_edit_access_level_success.fadeOut("fast");

}
function update_access_level(){
		$div_edit_access_level_error = $("#div_edit_access_level_error");
		$div_edit_access_level_success = $("#div_edit_access_level_success");
				
		$edit_access_level_name = $("#edit_access_level_name").val();
		$edit_access_level_description = $("#edit_access_level_description").val();
	
		$valmsg = "";
		$valmsg2 = "";
		
		if ($edit_access_level_name == ""){$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please enter Access Level Name <br/>";}
		
		if ($valmsg != $valmsg2){
			$div_edit_access_level_error.html($valmsg);
			$div_edit_access_level_success.fadeOut("fast");
			$div_edit_access_level_error.fadeIn("fast");
		}else{
			$div_edit_access_level_error.fadeOut("fast");
			$div_edit_access_level_success.fadeOut("fast");
				
			$("#edit_access_level_loader").show();
					
			var form = document.getElementById('frm_editaccesslevel');
			var formData = new FormData(form);

			$.ajax({
            	url: baseDir+'be/access_levels/update',
            	type: 'POST',
            	data: formData,
				dataType: 'json',
            	xhr: function() {
               		var myXhr = $.ajaxSettings.xhr();
               		return myXhr;
            	},
            	cache: false,
            	contentType: false,
            	processData: false,
            	success: function (res) {
					$("#edit_access_level_loader").hide();
					if(res.status == 'ERR'){
						$div_edit_access_level_error.html(res.message);
						$div_edit_access_level_success.fadeOut("fast");
						$div_edit_access_level_error.fadeIn("fast");
					}else if (res.status == 'SUCCESS'){
						$div_edit_access_level_success.html(res.message);
						$div_edit_access_level_error.fadeOut("fast");
						$div_edit_access_level_success.fadeIn("fast");
						
						load_access_levels();

					}
            	},
				error: function(){
					$("#edit_access_level_loader").hide();
					$div_edit_access_level_error.html("Something went wrong. Please check your network and try again.");
					$div_edit_access_level_success.fadeOut("fast");
					$div_edit_access_level_error.fadeIn("fast");
				}
        	});
	
		}
		return false;
}
function delete_access_level(access_level_id){
    //alert('Am clicked!');
    $div_access_level_error = $("#div_access_level_error");
    $div_access_level_success = $("#div_access_level_success");

    $div_access_level_error.fadeOut("fast");
    $div_access_level_success.fadeOut("fast");

    $.ajax({
        url: baseDir+'be/access_levels/delete/'+access_level_id,
        type: 'POST',
        data: '',
        xhr: function() {
            var myXhr = $.ajaxSettings.xhr();
            return myXhr;
        },
        cache: false,
        contentType: false,
        processData: false,
        success: function (res) {
            try{
                var obj1 = res;
                var obj = $.parseJSON(obj1);

                if(obj['status'] == 'ERR'){
                    $div_access_level_error.html(obj['message']);
                    $div_access_level_success.fadeOut("fast");
                    $div_access_level_error.fadeIn("fast");
                }else if (obj['status'] == 'SUCCESS'){
                    $div_access_level_success.html(obj['message']);
                    $div_access_level_error.fadeOut("fast");
                    $div_access_level_success.fadeIn("fast");

                    load_access_levels();
                }
            }catch(err){
                alert(err);
            }           
        },
        error: function(){
            $div_access_level_error.html("Something went wrong. Please check your network and try again.");
            $div_access_level_success.fadeOut("fast");
            $div_access_level_error.fadeIn("fast");
        }
    });
}








//DEPARTMENTS
function department_add_clear(){
	//alert('Test');
	$( '#frm_adddepartment' ).each(function(){
		this.reset();
	});	
	$div_add_department_success.fadeOut("fast");
	$div_add_department_error.fadeOut("fast");
}

function save_department(){
	$div_add_department_error = $("#div_add_department_error");
	$div_add_department_success = $("#div_add_department_success");
				
	$add_department_name = $("#add_department_name").val();
	$add_department_description = $("#add_department_description").val();
	
	$valmsg = "";
	$valmsg2 = "";
		
	if ($add_department_name == ""){$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please enter Access Level Name <br/>";}
		
	if ($valmsg != $valmsg2){
		$div_add_department_error.html($valmsg);
		$div_add_department_success.fadeOut("fast");
		$div_add_department_error.fadeIn("fast");
	}else{
		$div_add_department_error.fadeOut("fast");
		$div_add_department_success.fadeOut("fast");
				
		$("#add_department_loader").show();
					
		var form = document.getElementById('frm_adddepartment');
		var formData = new FormData(form);

		$.ajax({
           	url: baseDir+'be/departments/save',
           	type: 'POST',
           	data: formData,
			dataType: 'json',
           	xhr: function() {
           		var myXhr = $.ajaxSettings.xhr();
           		return myXhr;
           	},
           	cache: false,
           	contentType: false,
           	processData: false,
           	success: function (res) {
				$("#add_department_loader").hide();
				if(res.status == 'ERR'){
					$div_add_department_error.html(res.message);
					$div_add_department_success.fadeOut("fast");
					$div_add_department_error.fadeIn("fast");
				}else if (res.status == 'SUCCESS'){
					$div_add_department_success.html(res.message);
					$div_add_department_error.fadeOut("fast");
					$div_add_department_success.fadeIn("fast");
					
					$( '#frm_adddepartment' ).each(function(){
						this.reset();
					});	

					load_departments();

				}
           	},
			error: function(){
				$("#add_department_loader").hide();
				$div_add_department_error.html("Something went wrong. Please check your network and try again.");
				$div_add_department_success.fadeOut("fast");
				$div_add_department_error.fadeIn("fast");
			}
       	});

	}
	return false;
}
//LOAD DEPARTMENTS
function load_departments(){
	$('#div_departments_loader').oLoader({
		backgroundColor:'#fff',
		image: baseDir+'assets/be/js/plugins/oLoader/images/ownageLoader/loader9.gif',
		fadeInTime: 500,
		fadeOutTime: 1000,
		fadeLevel: 0.8
	});				
	$.ajax({
     	url: baseDir+'be/departments/loadjs',
       	type: 'POST',
       	data: '',
       	xhr: function() {
       		var myXhr = $.ajaxSettings.xhr();
       		return myXhr;
       	},
       	cache: false,
       	contentType: false,
       	processData: false,
     	success: function (result) {
			$("#departments_div").html(result);
			$('#div_departments_loader').oLoader('hide');			
   		},
		error: function(){
			$('#div_departments_loader').oLoader('hide');
		}
    });
}
function department_edit_load(department_id){
	$.ajax({
     	url: baseDir+'be/departments/get_department/'+department_id,
       	type: 'POST',
       	data: '',
       	xhr: function() {
       		var myXhr = $.ajaxSettings.xhr();
       		return myXhr;
       	},
       	cache: false,
       	contentType: false,
       	processData: false,
     	success: function (res) {
     		try{
     			var obj1 = res;
     			obj1 = obj1.replace('[','');
     			obj1 = obj1.replace(']','');
	     		var obj = $.parseJSON(obj1);
	     		$("#edit_department_id").val(obj['department_id']);
	     		$("#edit_department_name").val(obj['department_name']);
	     		$("#edit_department_description").val(obj['department_description']);

     		}catch(err){
     			alert(err);
     		}
   		},
		error: function(){
		}
    });
   	$div_edit_department_error.fadeOut("fast");
	$div_edit_department_success.fadeOut("fast");

}
function update_department(){
		$div_edit_department_error = $("#div_edit_department_error");
		$div_edit_department_success = $("#div_edit_department_success");
				
		$edit_department_name = $("#edit_department_name").val();
		$edit_department_description = $("#edit_department_description").val();
	
		$valmsg = "";
		$valmsg2 = "";
		
		if ($edit_department_name == ""){$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please enter Access Level Name <br/>";}
		
		if ($valmsg != $valmsg2){
			$div_edit_department_error.html($valmsg);
			$div_edit_department_success.fadeOut("fast");
			$div_edit_department_error.fadeIn("fast");
		}else{
			$div_edit_department_error.fadeOut("fast");
			$div_edit_department_success.fadeOut("fast");
				
			$("#edit_department_loader").show();
					
			var form = document.getElementById('frm_editdepartment');
			var formData = new FormData(form);

			$.ajax({
            	url: baseDir+'be/departments/update',
            	type: 'POST',
            	data: formData,
				dataType: 'json',
            	xhr: function() {
               		var myXhr = $.ajaxSettings.xhr();
               		return myXhr;
            	},
            	cache: false,
            	contentType: false,
            	processData: false,
            	success: function (res) {
					$("#edit_department_loader").hide();
					if(res.status == 'ERR'){
						$div_edit_department_error.html(res.message);
						$div_edit_department_success.fadeOut("fast");
						$div_edit_department_error.fadeIn("fast");
					}else if (res.status == 'SUCCESS'){
						$div_edit_department_success.html(res.message);
						$div_edit_department_error.fadeOut("fast");
						$div_edit_department_success.fadeIn("fast");
						
						load_departments();

					}
            	},
				error: function(){
					$("#edit_department_loader").hide();
					$div_edit_department_error.html("Something went wrong. Please check your network and try again.");
					$div_edit_department_success.fadeOut("fast");
					$div_edit_department_error.fadeIn("fast");
				}
        	});
	
		}
		return false;
}
function delete_department(department_id){
    //alert('Am clicked!');
    $div_department_error = $("#div_department_error");
    $div_department_success = $("#div_department_success");

    $div_department_error.fadeOut("fast");
    $div_department_success.fadeOut("fast");

    $.ajax({
        url: baseDir+'be/departments/delete/'+department_id,
        type: 'POST',
        data: '',
        xhr: function() {
            var myXhr = $.ajaxSettings.xhr();
            return myXhr;
        },
        cache: false,
        contentType: false,
        processData: false,
        success: function (res) {
            try{
                var obj1 = res;
                var obj = $.parseJSON(obj1);

                if(obj['status'] == 'ERR'){
                    $div_department_error.html(obj['message']);
                    $div_department_success.fadeOut("fast");
                    $div_department_error.fadeIn("fast");
                }else if (obj['status'] == 'SUCCESS'){
                    $div_department_success.html(obj['message']);
                    $div_department_error.fadeOut("fast");
                    $div_department_success.fadeIn("fast");

                    load_departments();
                }
            }catch(err){
                alert(err);
            }           
        },
        error: function(){
            $div_department_error.html("Something went wrong. Please check your network and try again.");
            $div_department_success.fadeOut("fast");
            $div_department_error.fadeIn("fast");
        }
    });
}




//COMPANY INFORMATION
function save_company_information(){
		//alert('Am here');
		$div_company_information_error = $("#div_company_information_error");
		$div_company_information_success = $("#div_company_information_success");
				
		$company_name = $("#company_name").val();
		$phone_number = $("#phone_number").val();
	
		$valmsg = "";
		$valmsg2 = "";
		
		if ($company_name == ""){$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please enter Company Name <br/>";}
		if ($phone_number == ""){$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please enter Phone Number <br/>";}
		
		if ($valmsg != $valmsg2){
			$div_company_information_error.html($valmsg);
			$div_company_information_success.fadeOut("fast");
			$div_company_information_error.fadeIn("fast");
		}else{
			$div_company_information_error.fadeOut("fast");
			$div_company_information_success.fadeOut("fast");
				
			$("#company_information_loader").show();
					
			var form = document.getElementById('frm_companyinformation');
			var formData = new FormData(form);

			$.ajax({
            	url: baseDir+'be/company_information/save',
            	type: 'POST',
            	data: formData,
				dataType: 'json',
            	xhr: function() {
               		var myXhr = $.ajaxSettings.xhr();
               		return myXhr;
            	},
            	cache: false,
            	contentType: false,
            	processData: false,
            	success: function (res) {
					$("#company_information_loader").hide();
					if(res.status == 'ERR'){
						$div_company_information_error.html(res.message);
						$div_company_information_success.fadeOut("fast");
						$div_company_information_error.fadeIn("fast");
					}else if (res.status == 'SUCCESS'){
						$div_company_information_success.html(res.message);
						$div_company_information_error.fadeOut("fast");
						$div_company_information_success.fadeIn("fast");
					}
            	},
				error: function(){
					$("#company_information_loader").hide();
					$div_company_information_error.html("Something went wrong. Please check your network and try again.");
					$div_company_information_success.fadeOut("fast");
					$div_company_information_error.fadeIn("fast");
				}
        	});
	
		}
		return false;
	
}
function change_company_logo(){
	$div_change_company_logo_error = $("#div_change_company_logo_error");
	$div_change_company_logo_success = $("#div_change_company_logo_success");
				
	$company_logo = $("#company_logo").val();
	
	
	$valmsg = "";
	$valmsg2 = "";
		
		if ($company_logo == ""){
			$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please click Browse to select a company logo <br/>";
		}else{
			$allowed_extensions = new Array("png","jpg","jpeg","gif");
    		$file_extension = $company_logo.split('.').pop();
			
			$found = false;
			for(var i = 0; i <= $allowed_extensions.length; i++){
        		if($allowed_extensions[i]==$file_extension){
					$found = true;
					break;
				}
			}
			
			if ($found == false){
				$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> The file you chose has an incorrect format. Only files with the following extensions are allowed: .png, .jpg, .jpeg, .gif <br/>";
			}
		}
		
		if ($valmsg != $valmsg2){
			$div_change_company_logo_error.html($valmsg);
			$div_change_company_logo_success.fadeOut("fast");
			$div_change_company_logo_error.fadeIn("fast");
		}else{
			$div_change_company_logo_error.fadeOut("fast");
			$div_change_company_logo_success.fadeOut("fast");
				
			$("#change_company_logo_loader").show();
					
			var form = document.getElementById('frm_changecompanylogo');
			var formData = new FormData(form);

			$.ajax({
            	url: baseDir+'be/company_information/change_company_logo',
            	type: 'POST',
            	data: formData,
				dataType: 'json',
            	xhr: function() {
               		var myXhr = $.ajaxSettings.xhr();
               		return myXhr;
            	},
            	cache: false,
            	contentType: false,
            	processData: false,
            	success: function (res) {
					$("#change_company_logo_loader").hide();
					if(res.status == 'ERR'){
						$div_change_company_logo_error.html(res.message);
						$div_change_company_logo_success.fadeOut("fast");
						$div_change_company_logo_error.fadeIn("fast");
					}else if (res.status == 'SUCCESS'){
						window.location.reload(false);					
					}
            	},
				error: function(){
					$("#change_company_logo_loader").hide();
					$div_change_company_logo_error.html("Something went wrong. Please check your network and try again.");
					$div_change_company_logo_success.fadeOut("fast");
					$div_change_company_logo_error.fadeIn("fast");
				}
        	});
	
		}
		return false;
}







//SYSTEM USERS
function system_user_add_clear(){
	//alert('Test');
	$( '#frm_addsystemuser' ).each(function(){
		this.reset();
	});	
	$div_add_system_user_success.fadeOut("fast");
	$div_add_system_user_error.fadeOut("fast");
}

function save_system_user(){
	$div_add_system_user_error = $("#div_add_system_user_error");
	$div_add_system_user_success = $("#div_add_system_user_success");
				
	$add_first_name = $("#add_first_name").val();
	$add_last_name = $("#add_last_name").val();
	$add_user_password = $("#add_user_password").val();
	$add_confirm_password = $("#add_confirm_password").val();
	$add_email_address = $("#add_email_address").val();
	$add_access_level_id = $("#add_access_level_id").val();
	
	
	$valmsg = "";
	$valmsg2 = "";
		
	if ($add_first_name == ""){$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please enter First Name <br/>";}
	if ($add_last_name == ""){$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please enter Last Name <br/>";}
	if ($add_email_address == ""){
		$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please enter Email Address<br/>";
	}else if(!validateEmail($add_email_address)){
		$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please enter the correct Email format <br/>";
	}
	if ($add_user_password == ""){$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please enter Password <br/>";}
	if ($add_confirm_password == ""){
		$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please enter Confirm Password <br/>";
	}else if ($add_user_password != $add_confirm_password){
		$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please retype the correct Password <br/>";
	}
	if ($add_access_level_id == ""){$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please select Access Level <br/>";}

		
	if ($valmsg != $valmsg2){
		$div_add_system_user_error.html($valmsg);
		$div_add_system_user_success.fadeOut("fast");
		$div_add_system_user_error.fadeIn("fast");
	}else{
		$div_add_system_user_error.fadeOut("fast");
		$div_add_system_user_success.fadeOut("fast");
				
		$("#add_system_user_loader").show();
					
		var form = document.getElementById('frm_addsystemuser');
		var formData = new FormData(form);

		$.ajax({
           	url: baseDir+'be/system_users/save',
           	type: 'POST',
           	data: formData,
			dataType: 'json',
           	xhr: function() {
           		var myXhr = $.ajaxSettings.xhr();
           		return myXhr;
           	},
           	cache: false,
           	contentType: false,
           	processData: false,
           	success: function (res) {
				$("#add_system_user_loader").hide();
				if(res.status == 'ERR'){
					$div_add_system_user_error.html(res.message);
					$div_add_system_user_success.fadeOut("fast");
					$div_add_system_user_error.fadeIn("fast");
				}else if (res.status == 'SUCCESS'){
					$div_add_system_user_success.html(res.message);
					$div_add_system_user_error.fadeOut("fast");
					$div_add_system_user_success.fadeIn("fast");
					
					$( '#frm_addsystemuser' ).each(function(){
						this.reset();
						$("#add_gender").val('').trigger('change');
						$("#add_department_id").val('').trigger('change');
						$("#add_access_level_id").val('').trigger('change');						
					});	

					load_system_users();

				}
           	},
			error: function(){
				$("#add_system_user_loader").hide();
				$div_add_system_user_error.html("Something went wrong. Please check your network and try again.");
				$div_add_system_user_success.fadeOut("fast");
				$div_add_system_user_error.fadeIn("fast");
			}
       	});
	
	}
		return false;
}
//LOAD SYSTEM USERS
function load_system_users(){
	$('#div_system_users_loader').oLoader({
		backgroundColor:'#fff',
		image: baseDir+'assets/be/js/plugins/oLoader/images/ownageLoader/loader9.gif',
		fadeInTime: 500,
		fadeOutTime: 1000,
		fadeLevel: 0.8
	});				
	$.ajax({
     	url: baseDir+'be/system_users/loadjs',
       	type: 'POST',
       	data: '',
       	xhr: function() {
       		var myXhr = $.ajaxSettings.xhr();
       		return myXhr;
       	},
       	cache: false,
       	contentType: false,
       	processData: false,
     	success: function (result) {
			$("#system_users_div").html(result);
			$('#div_system_users_loader').oLoader('hide');			
   		},
		error: function(){
			$('#div_system_users_loader').oLoader('hide');
		}
    });
}
function system_user_edit_load(system_user_id){
	$.ajax({
     	url: baseDir+'be/system_users/get_system_user/'+system_user_id,
       	type: 'POST',
       	data: '',
       	xhr: function() {
       		var myXhr = $.ajaxSettings.xhr();
       		return myXhr;
       	},
       	cache: false,
       	contentType: false,
       	processData: false,
     	success: function (res) {
     		try{
     			var obj1 = res;
     			obj1 = obj1.replace('[','');
     			obj1 = obj1.replace(']','');
	     		var obj = $.parseJSON(obj1);

				$("#edit_user_id").val(obj['user_id']);	     			
	     		$("#edit_first_name").val(obj['first_name']);
	     		$("#edit_last_name").val(obj['last_name']);
	     		$("#edit_phone_number").val(obj['phone_number']);
	     		$("#edit_email_address").val(obj['email_address']);
	     		$("#edit_gender").val(obj['gender']).change(); 
	     		$("#edit_department_id").val(obj['department_id']).change(); 
	     		$("#edit_access_level_id").val(obj['access_level_id']).change(); 

	     		if (obj['profile_picture'] == ''){
	     			$("#system_user_profile_picture").attr('src', baseDir + 'assets/be/images/demo/users/avi-1.png');
	     		}else{
	     			$picture_path = baseDir + 'uploads/profile_pictures/' + obj['profile_picture'];
	     			check_profile_picture_exists($picture_path);
	     		}	     		
     		}catch(err){
     			alert(err);
     		}
   		},
		error: function(){
		}
    });
   	$div_edit_system_user_error.fadeOut("fast");
	$div_edit_system_user_success.fadeOut("fast");

}
function check_profile_picture_exists($picture_path){
	$.ajax({
		url: $picture_path,
		type: 'HEAD',
		error: function(){
			$("#system_user_profile_picture").attr('src', baseDir + 'assets/be/images/demo/users/avi-1.png');
		},
		success: function(){
			$("#system_user_profile_picture").attr('src', $picture_path);
		}
	});
}
function update_system_user(){
	$div_edit_system_user_error = $("#div_edit_system_user_error");
	$div_edit_system_user_success = $("#div_edit_system_user_success");
				
	$edit_first_name = $("#edit_first_name").val();
	$edit_last_name = $("#edit_last_name").val();
	$edit_email_address = $("#edit_email_address").val();
	$edit_access_level_id = $("#aedit 	_access_level_id").val();
	
	
	$valmsg = "";
	$valmsg2 = "";
		
	if ($edit_first_name == ""){$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please enter First Name <br/>";}
	if ($edit_last_name == ""){$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please enter Last Name <br/>";}
	if ($edit_email_address == ""){
		$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please enter Email Address<br/>";
	}else if(!validateEmail($edit_email_address)){
		$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please enter the correct Email format <br/>";
	}
	if ($edit_access_level_id == ""){$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please select Access Level <br/>";}
		
		if ($valmsg != $valmsg2){
			$div_edit_system_user_error.html($valmsg);
			$div_edit_system_user_success.fadeOut("fast");
			$div_edit_system_user_error.fadeIn("fast");
		}else{
			$div_edit_system_user_error.fadeOut("fast");
			$div_edit_system_user_success.fadeOut("fast");
				
			$("#edit_system_user_loader").show();
					
			var form = document.getElementById('frm_editsystemuser');
			var formData = new FormData(form);

			$.ajax({
            	url: baseDir+'be/system_users/update',
            	type: 'POST',
            	data: formData,
				dataType: 'json',
            	xhr: function() {
               		var myXhr = $.ajaxSettings.xhr();
               		return myXhr;
            	},
            	cache: false,
            	contentType: false,
            	processData: false,
            	success: function (res) {
					$("#edit_system_user_loader").hide();
					if(res.status == 'ERR'){
						$div_edit_system_user_error.html(res.message);
						$div_edit_system_user_success.fadeOut("fast");
						$div_edit_system_user_error.fadeIn("fast");
					}else if (res.status == 'SUCCESS'){
						$div_edit_system_user_success.html(res.message);
						$div_edit_system_user_error.fadeOut("fast");
						$div_edit_system_user_success.fadeIn("fast");
						
						load_system_users();

					}
            	},
				error: function(){
					$("#edit_system_user_loader").hide();
					$div_edit_system_user_error.html("Something went wrong. Please check your network and try again.");
					$div_edit_system_user_success.fadeOut("fast");
					$div_edit_system_user_error.fadeIn("fast");
				}
        	});
	
		}
		return false;
}

function change_system_user_password_load($user_id){
	$( '#password_user_id' ).val($user_id);
	$( '#new_password' ).val('');
	$( '#confirm_password' ).val('');	
	$div_change_system_user_password_success.fadeOut("fast");
	$div_change_system_user_password_error.fadeOut("fast");	
}

function change_system_user_password(){
	$div_change_system_user_password_error = $("#div_change_system_user_password_error");
	$div_change_system_user_password_success = $("#div_change_system_user_password_success");
				
	//$old_password = $("#old_password").val();
	$new_password = $("#new_password").val();
	$confirm_password = $("#confirm_password").val();
	
	
	$valmsg = "";
	$valmsg2 = "";
		
	//if ($old_password == ""){$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please enter Old Password <br/>";}
	if ($new_password == ""){$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please enter New Password <br/>";}
	if ($confirm_password == ""){
		$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please enter Confirm Password<br/>";
	}else if($new_password != $confirm_password){
		$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please retype the correct Password <br/>";
	}
		
		if ($valmsg != $valmsg2){
			$div_change_system_user_password_error.html($valmsg);
			$div_change_system_user_password_success.fadeOut("fast");
			$div_change_system_user_password_error.fadeIn("fast");
		}else{
			$div_change_system_user_password_error.fadeOut("fast");
			$div_change_system_user_password_success.fadeOut("fast");
				
			$("#change_system_user_password_loader").show();
					
			var form = document.getElementById('frm_changesystemuserpassword');
			var formData = new FormData(form);

			$.ajax({
            	url: baseDir+'be/system_users/change_system_user_password',
            	type: 'POST',
            	data: formData,
				dataType: 'json',
            	xhr: function() {
               		var myXhr = $.ajaxSettings.xhr();
               		return myXhr;
            	},
            	cache: false,
            	contentType: false,
            	processData: false,
            	success: function (res) {
					$("#change_system_user_password_loader").hide();
					if(res.status == 'ERR'){
						$div_change_system_user_password_error.html(res.message);
						$div_change_system_user_password_success.fadeOut("fast");
						$div_change_system_user_password_error.fadeIn("fast");
					}else if (res.status == 'SUCCESS'){
						$div_change_system_user_password_success.html(res.message);
						$div_change_system_user_password_error.fadeOut("fast");
						$div_change_system_user_password_success.fadeIn("fast");						
					}
            	},
				error: function(){
					$("#change_system_user_password_loader").hide();
					$div_change_system_user_password_error.html("Something went wrong. Please check your network and try again.");
					$div_change_system_user_password_success.fadeOut("fast");
					$div_change_system_user_password_error.fadeIn("fast");

				}
        	});
	
		}
		return false;
}

function delete_system_user(system_user_id){
    //alert('Am clicked!');
    $div_system_user_error = $("#div_system_user_error");
    $div_system_user_success = $("#div_system_user_success");

    $div_system_user_error.fadeOut("fast");
    $div_system_user_success.fadeOut("fast");

    $.ajax({
        url: baseDir+'be/system_users/delete/'+system_user_id,
        type: 'POST',
        data: '',
        xhr: function() {
            var myXhr = $.ajaxSettings.xhr();
            return myXhr;
        },
        cache: false,
        contentType: false,
        processData: false,
        success: function (res) {
            try{
                var obj1 = res;
                var obj = $.parseJSON(obj1);

                if(obj['status'] == 'ERR'){
                    $div_system_user_error.html(obj['message']);
                    $div_system_user_success.fadeOut("fast");
                    $div_system_user_error.fadeIn("fast");
                }else if (obj['status'] == 'SUCCESS'){
                    $div_system_user_success.html(obj['message']);
                    $div_system_user_error.fadeOut("fast");
                    $div_system_user_success.fadeIn("fast");

					load_system_users();
                    
                }
            }catch(err){
                alert(err);
            }           
        },
        error: function(){
            $div_system_user_error.html("Something went wrong. Please check your network and try again.");
            $div_system_user_success.fadeOut("fast");
            $div_system_user_error.fadeIn("fast");
        }
    });
}



//ADD PROPERTY
$(document).ready(function(){


	//filter_properties();
	//filter_agent_properties();

	$("#clo_category_id, #clo_brand_id, #clo_product_status1, #clo_product_status2, #clo_product_status3, #clo_featured1, #clo_featured2, #clo_featured3 , #clo_new_arrival1, #clo_new_arrival2, #clo_new_arrival3, #clo_special_offer1, #clo_special_offer2, #clo_special_offer3, #clo_deal_of_the_week1, #clo_deal_of_the_week2, #clo_deal_of_the_week3").on('change', function() {
		filter_clothing_products();
	});
	$("#cos_category_id, #cos_brand_id, #cos_product_status1, #cos_product_status2, #cos_product_status3, #cos_featured1, #cos_featured2, #cos_featured3 , #cos_new_arrival1, #cos_new_arrival2, #cos_new_arrival3, #cos_special_offer1, #cos_special_offer2, #cos_special_offer3, #cos_deal_of_the_week1, #cos_deal_of_the_week2, #cos_deal_of_the_week3").on('change', function() {
		filter_cosmetics_products();
	});
	$("#sou_category_id, #sou_brand_id, #sou_product_status1, #sou_product_status2, #sou_product_status3, #sou_featured1, #sou_featured2, #sou_featured3 , #sou_new_arrival1, #sou_new_arrival2, #sou_new_arrival3, #sou_special_offer1, #sou_special_offer2, #sou_special_offer3, #sou_deal_of_the_week1, #sou_deal_of_the_week2, #sou_deal_of_the_week3").on('change', function() {
		filter_sound_products();
	});

	$("#clo_order_date_from, #clo_order_status1, #clo_order_status2, #clo_order_status3, #clo_order_status4, #clo_order_status5, #clo_order_status6").on('change', function() {
		filter_clothing_orders();
	});
	$("#cos_order_date_from, #cos_order_status1, #cos_order_status2, #cos_order_status3, #cos_order_status4, #cos_order_status5, #cos_order_status6").on('change', function() {
		filter_cosmetics_orders();
	});
	$("#sou_order_date_from, #sou_order_status1, #sou_order_status2, #sou_order_status3, #sou_order_status4, #sou_order_status5, #sou_order_status6").on('change', function() {
		filter_sound_orders();
	});

	$(".edit_other_image").click(function() {
	    $('#div_product_edit_other_image_error').fadeOut("fast");
	    $('#div_product_edit_other_image_success').fadeOut("fast");

	    var el = $(this);
	    var product_image_id = $(this).data("id");

	    $('#product_edit_other_image_id').val(product_image_id);

	});






	$("#pl_property_type_id").on('change', function() {
    	$("#pl_property_subcategory_id")
    		.find('option')
    		.remove()
    		.end()
    		.append('<option value=""></option>')
    		.val('').change()
		;
    	if (this.value != ''){
			$.ajax({
		     	url: baseDir+'be/property_subcategories/get_property_subcategories_by_property_type/'+this.value,
		       	type: 'POST',
		       	data: '',
		       	xhr: function() {
		       		var myXhr = $.ajaxSettings.xhr();
		       		return myXhr;
		       	},
		       	cache: false,
		       	contentType: false,
		       	processData: false,
		     	success: function (res) {
		     		try{
		     			var obj1 = res;
						// preserve newlines, etc - use valid JSON
						obj1 = obj1.replace(/\\n/g, "\\n")  
						               .replace(/\\'/g, "\\'")
						               .replace(/\\"/g, '\\"')
						               .replace(/\\&/g, "\\&")
						               .replace(/\\r/g, "\\r")
						               .replace(/\\t/g, "\\t")
						               .replace(/\\b/g, "\\b")
						               .replace(/\\f/g, "\\f");
						// remove non-printable and other non-valid JSON chars
						obj1 = obj1.replace(/[\u0000-\u0019]+/g,""); 
			     		var obj = JSON.parse(obj1);
			     		for (i=0; i< obj.length; i++){ 
         					$("#pl_property_subcategory_id").append($("<option>").attr('value',obj[i]['property_subcategory_id']).text(obj[i]['property_subcategory_name']));
  						};
						
		     		}catch(err){
		     			alert(err);
		     		}
		   		},
				error: function(){
				}
		    });
    	}
    	filter_properties();
    });
    $("#pl_region_id").on('change', function() {
    	$("#pl_city_id")
    		.find('option')
    		.remove()
    		.end()
    		.append('<option value=""></option>')
    		.val('').change()
		;
    	if (this.value != ''){
			$.ajax({
		     	url: baseDir+'be/cities/get_cities_by_region/'+this.value,
		       	type: 'POST',
		       	data: '',
		       	xhr: function() {
		       		var myXhr = $.ajaxSettings.xhr();
		       		return myXhr;
		       	},
		       	cache: false,
		       	contentType: false,
		       	processData: false,
		     	success: function (res) {
		     		try{
		     			var obj1 = res;
						// preserve newlines, etc - use valid JSON
						obj1 = obj1.replace(/\\n/g, "\\n")  
						               .replace(/\\'/g, "\\'")
						               .replace(/\\"/g, '\\"')
						               .replace(/\\&/g, "\\&")
						               .replace(/\\r/g, "\\r")
						               .replace(/\\t/g, "\\t")
						               .replace(/\\b/g, "\\b")
						               .replace(/\\f/g, "\\f");
						// remove non-printable and other non-valid JSON chars
						obj1 = obj1.replace(/[\u0000-\u0019]+/g,""); 
			     		var obj = JSON.parse(obj1);
			     		for (i=0; i< obj.length; i++){ 
         					$("#pl_city_id").append($("<option>").attr('value',obj[i]['city_id']).text(obj[i]['city_name']));
  						};	

		     		}catch(err){
		     			alert(err);
		     		}
		   		},
				error: function(){
				}
		    });
    	}
    	filter_properties();
    });
	$("#pl_city_id").on('change', function() {
    	$("#pl_area_id")
    		.find('option')
    		.remove()
    		.end()
    		.append('<option value=""></option>')
    		.val('').change()
		;
    	if (this.value != ''){
			$.ajax({
		     	url: baseDir+'be/areas/get_areas_by_city/'+this.value,
		       	type: 'POST',
		       	data: '',
		       	xhr: function() {
		       		var myXhr = $.ajaxSettings.xhr();
		       		return myXhr;
		       	},
		       	cache: false,
		       	contentType: false,
		       	processData: false,
		     	success: function (res) {
		     		try{
		     			var obj1 = res;
						// preserve newlines, etc - use valid JSON
						obj1 = obj1.replace(/\\n/g, "\\n")  
						               .replace(/\\'/g, "\\'")
						               .replace(/\\"/g, '\\"')
						               .replace(/\\&/g, "\\&")
						               .replace(/\\r/g, "\\r")
						               .replace(/\\t/g, "\\t")
						               .replace(/\\b/g, "\\b")
						               .replace(/\\f/g, "\\f");
						// remove non-printable and other non-valid JSON chars
						obj1 = obj1.replace(/[\u0000-\u0019]+/g,""); 
			     		var obj = JSON.parse(obj1);
			     		for (i=0; i< obj.length; i++){ 
         					$("#pl_area_id").append($("<option>").attr('value',obj[i]['area_id']).text(obj[i]['area_name']));
  						};	

		     		}catch(err){
		     			alert(err);
		     		}
		   		},
				error: function(){
				}
		    });
    	}
    	filter_properties();
    });


	$("#ag_pl_property_type_id").on('change', function() {
    	$("#ag_pl_property_subcategory_id")
    		.find('option')
    		.remove()
    		.end()
    		.append('<option value=""></option>')
    		.val('').change()
		;
    	if (this.value != ''){
			$.ajax({
		     	url: baseDir+'be/property_subcategories/get_property_subcategories_by_property_type/'+this.value,
		       	type: 'POST',
		       	data: '',
		       	xhr: function() {
		       		var myXhr = $.ajaxSettings.xhr();
		       		return myXhr;
		       	},
		       	cache: false,
		       	contentType: false,
		       	processData: false,
		     	success: function (res) {
		     		try{
		     			var obj1 = res;
						// preserve newlines, etc - use valid JSON
						obj1 = obj1.replace(/\\n/g, "\\n")  
						               .replace(/\\'/g, "\\'")
						               .replace(/\\"/g, '\\"')
						               .replace(/\\&/g, "\\&")
						               .replace(/\\r/g, "\\r")
						               .replace(/\\t/g, "\\t")
						               .replace(/\\b/g, "\\b")
						               .replace(/\\f/g, "\\f");
						// remove non-printable and other non-valid JSON chars
						obj1 = obj1.replace(/[\u0000-\u0019]+/g,""); 
			     		var obj = JSON.parse(obj1);
			     		for (i=0; i< obj.length; i++){ 
         					$("#ag_pl_property_subcategory_id").append($("<option>").attr('value',obj[i]['property_subcategory_id']).text(obj[i]['property_subcategory_name']));
  						};
						
		     		}catch(err){
		     			alert(err);
		     		}
		   		},
				error: function(){
				}
		    });
    	}
    	filter_agent_properties();
    });
    $("#ag_pl_region_id").on('change', function() {
    	$("#ag_pl_city_id")
    		.find('option')
    		.remove()
    		.end()
    		.append('<option value=""></option>')
    		.val('').change()
		;
    	if (this.value != ''){
			$.ajax({
		     	url: baseDir+'be/cities/get_cities_by_region/'+this.value,
		       	type: 'POST',
		       	data: '',
		       	xhr: function() {
		       		var myXhr = $.ajaxSettings.xhr();
		       		return myXhr;
		       	},
		       	cache: false,
		       	contentType: false,
		       	processData: false,
		     	success: function (res) {
		     		try{
		     			var obj1 = res;
						// preserve newlines, etc - use valid JSON
						obj1 = obj1.replace(/\\n/g, "\\n")  
						               .replace(/\\'/g, "\\'")
						               .replace(/\\"/g, '\\"')
						               .replace(/\\&/g, "\\&")
						               .replace(/\\r/g, "\\r")
						               .replace(/\\t/g, "\\t")
						               .replace(/\\b/g, "\\b")
						               .replace(/\\f/g, "\\f");
						// remove non-printable and other non-valid JSON chars
						obj1 = obj1.replace(/[\u0000-\u0019]+/g,""); 
			     		var obj = JSON.parse(obj1);
			     		for (i=0; i< obj.length; i++){ 
         					$("#ag_pl_city_id").append($("<option>").attr('value',obj[i]['city_id']).text(obj[i]['city_name']));
  						};	

		     		}catch(err){
		     			alert(err);
		     		}
		   		},
				error: function(){
				}
		    });
    	}
    	filter_agent_properties();
    });
	$("#ag_pl_city_id").on('change', function() {
    	$("#ag_pl_area_id")
    		.find('option')
    		.remove()
    		.end()
    		.append('<option value=""></option>')
    		.val('').change()
		;
    	if (this.value != ''){
			$.ajax({
		     	url: baseDir+'be/areas/get_areas_by_city/'+this.value,
		       	type: 'POST',
		       	data: '',
		       	xhr: function() {
		       		var myXhr = $.ajaxSettings.xhr();
		       		return myXhr;
		       	},
		       	cache: false,
		       	contentType: false,
		       	processData: false,
		     	success: function (res) {
		     		try{
		     			var obj1 = res;
						// preserve newlines, etc - use valid JSON
						obj1 = obj1.replace(/\\n/g, "\\n")  
						               .replace(/\\'/g, "\\'")
						               .replace(/\\"/g, '\\"')
						               .replace(/\\&/g, "\\&")
						               .replace(/\\r/g, "\\r")
						               .replace(/\\t/g, "\\t")
						               .replace(/\\b/g, "\\b")
						               .replace(/\\f/g, "\\f");
						// remove non-printable and other non-valid JSON chars
						obj1 = obj1.replace(/[\u0000-\u0019]+/g,""); 
			     		var obj = JSON.parse(obj1);
			     		for (i=0; i< obj.length; i++){ 
         					$("#ag_pl_area_id").append($("<option>").attr('value',obj[i]['area_id']).text(obj[i]['area_name']));
  						};	

		     		}catch(err){
		     			alert(err);
		     		}
		   		},
				error: function(){
				}
		    });
    	}
    	filter_agent_properties();
    });

	//#pl_listing_type_id, #pl_property_type_id, #pl_property_subcategory_id, #pl_region_id, #pl_city_id, #pl_area_id,

	$("#property_type_id").on('change', function() {
    	$("#property_subcategory_id")
    		.find('option')
    		.remove()
    		.end()
    		.append('<option value=""></option>')
    		.val('').change()
		;
    	if (this.value != ''){
			$.ajax({
		     	url: baseDir+'be/property_subcategories/get_property_subcategories_by_property_type/'+this.value,
		       	type: 'POST',
		       	data: '',
		       	xhr: function() {
		       		var myXhr = $.ajaxSettings.xhr();
		       		return myXhr;
		       	},
		       	cache: false,
		       	contentType: false,
		       	processData: false,
		     	success: function (res) {
		     		try{
		     			var obj1 = res;
						// preserve newlines, etc - use valid JSON
						obj1 = obj1.replace(/\\n/g, "\\n")  
						               .replace(/\\'/g, "\\'")
						               .replace(/\\"/g, '\\"')
						               .replace(/\\&/g, "\\&")
						               .replace(/\\r/g, "\\r")
						               .replace(/\\t/g, "\\t")
						               .replace(/\\b/g, "\\b")
						               .replace(/\\f/g, "\\f");
						// remove non-printable and other non-valid JSON chars
						obj1 = obj1.replace(/[\u0000-\u0019]+/g,""); 
			     		var obj = JSON.parse(obj1);
			     		for (i=0; i< obj.length; i++){ 
         					$("#property_subcategory_id").append($("<option>").attr('value',obj[i]['property_subcategory_id']).text(obj[i]['property_subcategory_name']));
  						};

						$("#property_subcategory_id").val($property_subcat_id).trigger('change');

		     		}catch(err){
		     			alert(err);
		     		}
		   		},
				error: function(){
				}
		    });
    	}
    }).trigger('change');

    $("#region_id").on('change', function() {
    	//alert( this.value );
    	$("#city_id")
    		.find('option')
    		.remove()
    		.end()
    		.append('<option value=""></option>')
    		.val('').change()
		;
    	if (this.value != ''){
			$.ajax({
		     	url: baseDir+'be/cities/get_cities_by_region/'+this.value,
		       	type: 'POST',
		       	data: '',
		       	xhr: function() {
		       		var myXhr = $.ajaxSettings.xhr();
		       		return myXhr;
		       	},
		       	cache: false,
		       	contentType: false,
		       	processData: false,
		     	success: function (res) {
		     		try{
		     			var obj1 = res;
						// preserve newlines, etc - use valid JSON
						obj1 = obj1.replace(/\\n/g, "\\n")  
						               .replace(/\\'/g, "\\'")
						               .replace(/\\"/g, '\\"')
						               .replace(/\\&/g, "\\&")
						               .replace(/\\r/g, "\\r")
						               .replace(/\\t/g, "\\t")
						               .replace(/\\b/g, "\\b")
						               .replace(/\\f/g, "\\f");
						// remove non-printable and other non-valid JSON chars
						obj1 = obj1.replace(/[\u0000-\u0019]+/g,""); 
			     		var obj = JSON.parse(obj1);
			     		for (i=0; i< obj.length; i++){ 
         					$("#city_id").append($("<option>").attr('value',obj[i]['city_id']).text(obj[i]['city_name']));
  						};	

						$("#city_id").val($cit_id).trigger('change');

		     		}catch(err){
		     			alert(err);
		     		}
		   		},
				error: function(){
				}
		    });
    	}
    }).trigger('change');
	$("#city_id").on('change', function() {
    	//alert( this.value );
    	$("#area_id")
    		.find('option')
    		.remove()
    		.end()
    		.append('<option value=""></option>')
    		.val('').change()
		;
    	if (this.value != ''){
			$.ajax({
		     	url: baseDir+'be/areas/get_areas_by_city/'+this.value,
		       	type: 'POST',
		       	data: '',
		       	xhr: function() {
		       		var myXhr = $.ajaxSettings.xhr();
		       		return myXhr;
		       	},
		       	cache: false,
		       	contentType: false,
		       	processData: false,
		     	success: function (res) {
		     		try{
		     			var obj1 = res;
						// preserve newlines, etc - use valid JSON
						obj1 = obj1.replace(/\\n/g, "\\n")  
						               .replace(/\\'/g, "\\'")
						               .replace(/\\"/g, '\\"')
						               .replace(/\\&/g, "\\&")
						               .replace(/\\r/g, "\\r")
						               .replace(/\\t/g, "\\t")
						               .replace(/\\b/g, "\\b")
						               .replace(/\\f/g, "\\f");
						// remove non-printable and other non-valid JSON chars
						obj1 = obj1.replace(/[\u0000-\u0019]+/g,""); 
			     		var obj = JSON.parse(obj1);
			     		for (i=0; i< obj.length; i++){ 
         					$("#area_id").append($("<option>").attr('value',obj[i]['area_id']).text(obj[i]['area_name']));
  						};	

						$("#area_id").val($are_id).trigger('change');

		     		}catch(err){
		     			alert(err);
		     		}
		   		},
				error: function(){
				}
		    });
    	}
    }).trigger('change');
}); 

function save_new_product_start(){
	$div_new_product_start_error = $("#div_new_product_start_error");
	$div_new_product_start_success = $("#div_new_product_start_success");
				
	$product_name = $("#product_name").val();
	$product_type = $("#product_type").val();
	$price = $("#price").val();
	$currency_id = $("#currency_id").val();	
	
	$valmsg = "";
	$valmsg2 = "";
		
	if ($product_name == ""){$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please enter Product Name <br/>";}
	if ($price == ""){
		$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please enter Price <br/>";
	}else if (validateNumeric($price)){
		$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Only numeric values are allowed for Price <br/>";
	}
	if ($currency_id == ""){$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please select Currency <br/>";}

		
	if ($valmsg != $valmsg2){
		$div_new_product_start_error.html($valmsg);
		$div_new_product_start_success.fadeOut("fast");
		$div_new_product_start_error.fadeIn("fast");
		$('html, body').animate({ scrollTop: $('#div_new_product_start_error').offset().top-90 }, 'slow');
	}else{
		$div_new_product_start_error.fadeOut("fast");
		$div_new_product_start_success.fadeOut("fast");
				
		$("#new_product_start_loader").show();
					
		var form = document.getElementById('frm_newproductstart');
		var formData = new FormData(form);

		$.ajax({
           	url: baseDir+'be/products/save_start',
           	type: 'POST',
           	data: formData,
			dataType: 'json',
           	xhr: function() {
           		var myXhr = $.ajaxSettings.xhr();
           		return myXhr;
           	},
           	cache: false,
           	contentType: false,
           	processData: false,
           	success: function (res) {
				$("#new_product_start_loader").hide();
				if(res.status == 'ERR'){
					$div_new_product_start_error.html(res.message);
					$div_new_product_start_success.fadeOut("fast");
					$div_new_product_start_error.fadeIn("fast");
					$('html, body').animate({ scrollTop: $('#div_new_product_start_error').offset().top-90 }, 'slow');
				}else if (res.status == 'SUCCESS'){
					if ($product_type == 'Clothing'){
						window.location = "clothing_add_features";
					}else if ($product_type == 'Cosmetics'){
						window.location = "cosmetics_add_features";
					}else if ($product_type == 'Sound'){
						window.location = "sound_add_features";
					}										
				}
           	},
			error: function(){
				$("#new_product_start_loader").hide();
				$div_new_product_start_error.html("Something went wrong. Please check your network and try again.");
				$div_new_product_start_success.fadeOut("fast");
				$div_new_product_start_error.fadeIn("fast");
				$('html, body').animate({ scrollTop: $('#div_new_product_start_error').offset().top-90 }, 'slow');
			}
       	});
	
	}
	return false;
}
function update_product_start(){
	$div_new_product_start_error = $("#div_new_product_start_error");
	$div_new_product_start_success = $("#div_new_product_start_success");
				
	$product_id = $("#product_id").val();

	$product_name = $("#product_name").val();
	$product_type = $("#product_type").val();
	$price = $("#price").val();
	$currency_id = $("#currency_id").val();	
	
	$valmsg = "";
	$valmsg2 = "";
		
	if ($product_name == ""){$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please enter Product Name <br/>";}
	if ($price == ""){
		$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please enter Price <br/>";
	}else if (validateNumeric($price)){
		$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Only numeric values are allowed for Price <br/>";
	}
	if ($currency_id == ""){$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please select Currency <br/>";}

	if ($valmsg != $valmsg2){
		$div_new_product_start_error.html($valmsg);
		$div_new_product_start_success.fadeOut("fast");
		$div_new_product_start_error.fadeIn("fast");
		$('html, body').animate({ scrollTop: $('#div_new_product_start_error').offset().top-90 }, 'slow');
	}else{
		$div_new_product_start_error.fadeOut("fast");
		$div_new_product_start_success.fadeOut("fast");
				
		$("#new_product_start_loader").show();
					
		var form = document.getElementById('frm_newproductstart');
		var formData = new FormData(form);

		$.ajax({
           	url: baseDir+'be/products/update_start',
           	type: 'POST',
           	data: formData,
			dataType: 'json',
           	xhr: function() {
           		var myXhr = $.ajaxSettings.xhr();
           		return myXhr;
           	},
           	cache: false,
           	contentType: false,
           	processData: false,
           	success: function (res) {
				$("#new_product_start_loader").hide();
				if(res.status == 'ERR'){
					$div_new_product_start_error.html(res.message);
					$div_new_product_start_success.fadeOut("fast");
					$div_new_product_start_error.fadeIn("fast");
					$('html, body').animate({ scrollTop: $('#div_new_product_start_error').offset().top-90 }, 'slow');
				}else if (res.status == 'SUCCESS'){
					if ($product_type == 'Clothing'){
						window.location = baseDir+'be/products/clothing_edit_features/'+$product_id;					
					}else if ($product_type == 'Cosmetics'){
						window.location = baseDir+'be/products/cosmetics_edit_features/'+$product_id;					
					}else if ($product_type == 'Sound'){
						window.location = baseDir+'be/products/sound_edit_features/'+$product_id;					
					}
				}
           	},
			error: function(){
				$("#new_product_start_loader").hide();
				$div_new_product_start_error.html("Something went wrong. Please check your network and try again.");
				$div_new_product_start_success.fadeOut("fast");
				$div_new_product_start_error.fadeIn("fast");
				$('html, body').animate({ scrollTop: $('#div_new_product_start_error').offset().top-90 }, 'slow');
			}
       	});
	
	}
	return false;
}


function save_new_product_features(){
	$valmsg = "";
	$valmsg2 = "";

	$div_new_product_features_error = $("#div_new_product_features_error");
	$div_new_product_features_success = $("#div_new_product_features_success");

	$product_type = $("#product_type").val();

	if (!$('input[name=product_status]:checked').val()){$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please select Product Status <br/>";}
	if (!$('input[name=featured]:checked').val()){$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please select Featured <br/>";}
	if (!$('input[name=new_arrival]:checked').val()){$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please select New Arrival <br/>";}
	if (!$('input[name=special_offer]:checked').val()){$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please select Special Offer <br/>";}
	if (!$('input[name=deal_of_the_week]:checked').val()){$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please select Deal of the Week <br/>";}

	if ($valmsg != $valmsg2){
		$div_new_product_features_error.html($valmsg);
		$div_new_product_features_success.fadeOut("fast");
		$div_new_product_features_error.fadeIn("fast");
		$('html, body').animate({ scrollTop: $('#div_new_product_features_error').offset().top-90 }, 'slow');
	}else{
		$div_new_product_features_error.fadeOut("fast");
		$div_new_product_features_success.fadeOut("fast");
				
		$("#new_product_features_loader").show();
					
		var form = document.getElementById('frm_newproductfeatures');
		var formData = new FormData(form);

		$.ajax({
           	url: baseDir+'be/products/save_features',
           	type: 'POST',
           	data: formData,
			dataType: 'json',
           	xhr: function() {
           		var myXhr = $.ajaxSettings.xhr();
           		return myXhr;
           	},
           	cache: false,
           	contentType: false,
           	processData: false,
           	success: function (res) {
				$("#new_product_start_loader").hide();
				if(res.status == 'ERR'){
					$div_new_product_features_error.html(res.message);
					$div_new_product_features_success.fadeOut("fast");
					$div_new_product_features_error.fadeIn("fast");
					$('html, body').animate({ scrollTop: $('#div_new_product_features_error').offset().top-90 }, 'slow');
				}else if (res.status == 'SUCCESS'){
					if ($product_type == 'Clothing'){
						window.location = "clothing_add_images";
					}else if ($product_type == 'Cosmetics'){
						window.location = "cosmetics_add_images";
					}else if ($product_type == 'Sound'){
						window.location = "sound_add_images";
					}
					//window.location = "add_contacts";					
				}
           	},
			error: function(){
				$("#new_product_features_loader").hide();
				$div_new_product_features_error.html("Something went wrong. Please check your network and try again.");
				$div_new_product_features_success.fadeOut("fast");
				$div_new_product_features_error.fadeIn("fast");
				$('html, body').animate({ scrollTop: $('#div_new_product_features_error').offset().top-90 }, 'slow');
			}
       	});	
	}
	return false;
}

function update_product_features(){
	$valmsg = "";
	$valmsg2 = "";

	$div_new_product_features_error = $("#div_new_product_features_error");
	$div_new_product_features_success = $("#div_new_product_features_success");

	$product_id = $("#product_id").val();	
	$product_type = $("#product_type").val();

	if (!$('input[name=product_status]:checked').val()){$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please select Product Status <br/>";}
	if (!$('input[name=featured]:checked').val()){$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please select Featured <br/>";}
	if (!$('input[name=new_arrival]:checked').val()){$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please select New Arrival <br/>";}
	if (!$('input[name=special_offer]:checked').val()){$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please select Special Offer <br/>";}
	if (!$('input[name=deal_of_the_week]:checked').val()){$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please select Deal of the Week <br/>";}

	if ($valmsg != $valmsg2){
		$div_new_product_features_error.html($valmsg);
		$div_new_product_features_success.fadeOut("fast");
		$div_new_product_features_error.fadeIn("fast");
		$('html, body').animate({ scrollTop: $('#div_new_product_features_error').offset().top-90 }, 'slow');
	}else{
		$div_new_product_features_error.fadeOut("fast");
		$div_new_product_features_success.fadeOut("fast");
				
		$("#new_product_features_loader").show();
					
		var form = document.getElementById('frm_newproductfeatures');
		var formData = new FormData(form);

		$.ajax({
           	url: baseDir+'be/products/update_features',
           	type: 'POST',
           	data: formData,
			dataType: 'json',
           	xhr: function() {
           		var myXhr = $.ajaxSettings.xhr();
           		return myXhr;
           	},
           	cache: false,
           	contentType: false,
           	processData: false,
           	success: function (res) {
				$("#new_product_features_loader").hide();
				if(res.status == 'ERR'){
					$div_new_product_features_error.html(res.message);
					$div_new_product_features_success.fadeOut("fast");
					$div_new_product_features_error.fadeIn("fast");
					$('html, body').animate({ scrollTop: $('#div_new_product_features_error').offset().top-90 }, 'slow');
				}else if (res.status == 'SUCCESS'){
					if ($product_type == 'Clothing'){
						window.location = baseDir+'be/products/clothing_edit_images/'+$product_id;					
					}else if ($product_type == 'Cosmetics'){
						window.location = baseDir+'be/products/cosmetics_edit_images/'+$product_id;					
					}else if ($product_type == 'Sound'){
						window.location = baseDir+'be/products/sound_edit_images/'+$product_id;					
					}
				}
           	},
			error: function(){
				$("#new_product_features_loader").hide();
				$div_new_product_features_error.html("Something went wrong. Please check your network and try again.");
				$div_new_product_features_success.fadeOut("fast");
				$div_new_product_features_error.fadeIn("fast");
				$('html, body').animate({ scrollTop: $('#div_new_product_features_error').offset().top-90 }, 'slow');
			}
       	});
	
	}
	return false;

}

function check_valid_image_file($image_file_name){
	$file_valid = false;
	
	$allowed_extensions = new Array("png","jpg","jpeg","gif");
	$file_extension = $image_file_name.split('.').pop();

	for(var i = 0; i <= $allowed_extensions.length; i++){
		if($allowed_extensions[i] == $file_extension){
			$file_valid = true;
			break;
		}
	}		
	return $file_valid;

}
function save_new_product_images(){
	$("#div_main_image_error").fadeOut("fast");
	$("#div_other_image_1_error").fadeOut("fast");
	$("#div_other_image_2_error").fadeOut("fast");
	$("#div_other_image_3_error").fadeOut("fast");
	$("#div_other_image_4_error").fadeOut("fast");
	$("#div_other_image_5_error").fadeOut("fast");

	$div_new_product_images_error = $("#div_new_product_images_error");
	$div_new_product_images_success = $("#div_new_product_images_success");

	$main_image = $("#main_image").val();
	$other_image_1 = $("#other_image_1").val();	
	$other_image_2 = $("#other_image_2").val();	
	$other_image_3 = $("#other_image_3").val();	
	$other_image_4 = $("#other_image_4").val();	
	$other_image_5 = $("#other_image_5").val();	

	$product_type = $("#product_type").val();	

	$valmsg = "";
	$valmsg2 = "";

	if ($main_image == ""){
		$("#div_main_image_error").html("<i class='fa fa-exclamation-circle'></i> Please select Main Image");
		$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please select Main Image <br/>";
		$("#div_main_image_error").fadeIn("fast");
	}else{
		if (check_valid_image_file($main_image) == false){
			$("#div_main_image_error").html("<i class='fa fa-exclamation-circle'></i> <i class='fa fa-exclamation-circle'></i> The file you chose has an incorrect format. Only files with the following extensions are allowed: .png, .jpg, .jpeg, .gif");			
			$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> The Main Image file you chose has an incorrect format. Only files with the following extensions are allowed: .png, .jpg, .jpeg, .gif <br/>";
			$("#div_main_image_error").fadeIn("fast");
		}
	}

	if ($other_image_1 != ""){
		if (check_valid_image_file($other_image_1) == false){
			$("#div_other_image_1_error").html("<i class='fa fa-exclamation-circle'></i> <i class='fa fa-exclamation-circle'></i> The file you chose has an incorrect format. Only files with the following extensions are allowed: .png, .jpg, .jpeg, .gif");
			$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> The Image file you chose has an incorrect format. Only files with the following extensions are allowed: .png, .jpg, .jpeg, .gif <br/>";
			$("#div_other_image_1_error").fadeIn("fast");			
		}
	}
	if ($other_image_2 != ""){
		if (check_valid_image_file($other_image_2) == false){
			$("#div_other_image_2_error").html("<i class='fa fa-exclamation-circle'></i> <i class='fa fa-exclamation-circle'></i> The file you chose has an incorrect format. Only files with the following extensions are allowed: .png, .jpg, .jpeg, .gif");
			$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> The Image file you chose has an incorrect format. Only files with the following extensions are allowed: .png, .jpg, .jpeg, .gif <br/>";
			$("#div_other_image_2_error").fadeIn("fast");			
		}
	}
	if ($other_image_3 != ""){
		if (check_valid_image_file($other_image_3) == false){
			$("#div_other_image_3_error").html("<i class='fa fa-exclamation-circle'></i> <i class='fa fa-exclamation-circle'></i> The file you chose has an incorrect format. Only files with the following extensions are allowed: .png, .jpg, .jpeg, .gif");
			$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> The Image file you chose has an incorrect format. Only files with the following extensions are allowed: .png, .jpg, .jpeg, .gif <br/>";
			$("#div_other_image_3_error").fadeIn("fast");			
		}
	}
	if ($other_image_4 != ""){
		if (check_valid_image_file($other_image_4) == false){
			$("#div_other_image_4_error").html("<i class='fa fa-exclamation-circle'></i> <i class='fa fa-exclamation-circle'></i> The file you chose has an incorrect format. Only files with the following extensions are allowed: .png, .jpg, .jpeg, .gif");
			$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> The Image file you chose has an incorrect format. Only files with the following extensions are allowed: .png, .jpg, .jpeg, .gif <br/>";
			$("#div_other_image_4_error").fadeIn("fast");			
		}
	}
	if ($other_image_5 != ""){
		if (check_valid_image_file($other_image_5) == false){
			$("#div_other_image_5_error").html("<i class='fa fa-exclamation-circle'></i> <i class='fa fa-exclamation-circle'></i> The file you chose has an incorrect format. Only files with the following extensions are allowed: .png, .jpg, .jpeg, .gif");
			$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> The Image file you chose has an incorrect format. Only files with the following extensions are allowed: .png, .jpg, .jpeg, .gif <br/>";
			$("#div_other_image_5_error").fadeIn("fast");			
		}
	}


		
	if ($valmsg != $valmsg2){
		$('html, body').animate({ scrollTop: $('#div_new_product_images_error').offset().top-90 }, 'slow');
	}else{
		$("#div_main_image_error").fadeOut("fast");
		$("#div_other_image_1_error").fadeOut("fast");
		$("#div_other_image_2_error").fadeOut("fast");
		$("#div_other_image_3_error").fadeOut("fast");
		$("#div_other_image_4_error").fadeOut("fast");
		$("#div_other_image_5_error").fadeOut("fast");

		$div_new_product_images_error.fadeOut("fast");		
		$div_new_product_images_success.fadeOut("fast");
				
		$("#new_product_images_loader").show();
					
		var form = document.getElementById('frm_newproductimages');
		var formData = new FormData(form);

		$.ajax({
           	url: baseDir+'be/products/save_images_and_publish/'+$product_type,
           	type: 'POST',
           	data: formData,
			dataType: 'json',
           	xhr: function() {
           		var myXhr = $.ajaxSettings.xhr();
           		return myXhr;
           	},
           	cache: false,
           	contentType: false,
           	processData: false,
           	success: function (res) {
				$("#new_product_images_loader").hide();
				if(res.status == 'ERR'){
					$div_new_product_images_error.html(res.message);
					$div_new_product_images_success.fadeOut("fast");
					$div_new_product_images_error.fadeIn("fast");
					$('html, body').animate({ scrollTop: $('#div_new_product_images_error').offset().top-90 }, 'slow');
				}else if (res.status == 'SUCCESS'){
					if ($product_type == 'Clothing'){
						window.location = "clothing_add_start";
					}else if ($product_type == 'Cosmetics'){
						window.location = "cosmetics_add_start";
					}else if ($product_type == 'Sound'){
						window.location = "sound_add_start";
					}
				}
           	},
			error: function(){
				$("#new_product_images_loader").hide();
				$div_new_product_images_error.html("Something went wrong. Please check your network and try again.");
				$div_new_product_images_success.fadeOut("fast");
				$div_new_product_images_error.fadeIn("fast");
				$('html, body').animate({ scrollTop: $('#div_new_product_images_error').offset().top-90 }, 'slow');
			}
       	});
	
	}
	return false;
}

function upload_product_main_image(){
	$div_product_main_image_error = $("#div_product_main_image_error");
	$div_product_main_image_success = $("#div_product_main_image_success");
				
	$main_image = $("#product_main_image").val();
	$product_id = $("#product_main_image_id").val();	
		
	$valmsg = "";
	$valmsg2 = "";
		
		if ($main_image == ""){
			$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please click Browse to select an image <br/>";
		}else{
			$allowed_extensions = new Array("png","jpg","jpeg","gif");
    		$file_extension = $main_image.split('.').pop();
			
			$found = false;
			for(var i = 0; i <= $allowed_extensions.length; i++){
        		if($allowed_extensions[i]==$file_extension){
					$found = true;
					break;
				}
			}
			
			if ($found == false){
				$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> The file you chose has an incorrect format. Only files with the following extensions are allowed: .png, .jpg, .jpeg, .gif <br/>";
			}
		}
		
		if ($valmsg != $valmsg2){
			$div_product_main_image_error.html($valmsg);
			$div_product_main_image_success.fadeOut("fast");
			$div_product_main_image_error.fadeIn("fast");
		}else{
			$div_product_main_image_error.fadeOut("fast");
			$div_product_main_image_success.fadeOut("fast");
				
			$("#product_main_image_loader").show();
					
			var form = document.getElementById('frm_productmainimage');
			var formData = new FormData(form);

			$.ajax({
            	url: baseDir+'be/products/upload_main_image',
            	type: 'POST',
            	data: formData,
				dataType: 'json',
            	xhr: function() {
               		var myXhr = $.ajaxSettings.xhr();
               		return myXhr;
            	},
            	cache: false,
            	contentType: false,
            	processData: false,
            	success: function (res) {
					$("#product_main_image_loader").hide();
					if(res.status == 'ERR'){
						$div_product_main_image_error.html(res.message);
						$div_product_main_image_success.fadeOut("fast");
						$div_product_main_image_error.fadeIn("fast");
					}else if (res.status == 'SUCCESS'){
						location.reload();					
					}
            	},
				error: function(){
					$("#product_main_image_loader").hide();
					$div_product_main_image_error.html("Something went wrong. Please check your network and try again.");
					$div_product_main_image_success.fadeOut("fast");
					$div_product_main_image_error.fadeIn("fast");
				}
        	});	
		}
		return false;	
}
function upload_edit_product_other_image(){
	$div_product_edit_other_image_error = $("#div_product_edit_other_image_error");
	$div_product_edit_other_image_success = $("#div_product_edit_other_image_success");
				
	$other_image = $("#product_edit_other_image").val();
	$other_image_id = $("#product_edit_other_image_id").val();
	//$product_id = $("#product_other_image_"+$imageid+"_id").val();	
		
	$valmsg = "";
	$valmsg2 = "";
		
		if ($other_image == ""){
			$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please click Browse to select an image <br/>";
		}else{
			$allowed_extensions = new Array("png","jpg","jpeg","gif");
    		$file_extension = $other_image.split('.').pop();
			
			$found = false;
			for(var i = 0; i <= $allowed_extensions.length; i++){
        		if($allowed_extensions[i]==$file_extension){
					$found = true;
					break;
				}
			}
			
			if ($found == false){
				$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> The file you chose has an incorrect format. Only files with the following extensions are allowed: .png, .jpg, .jpeg, .gif <br/>";
			}
		}
		
		if ($valmsg != $valmsg2){
			$div_product_edit_other_image_error.html($valmsg);
			$div_product_edit_other_image_success.fadeOut("fast");
			$div_product_edit_other_image_error.fadeIn("fast");
		}else{
			$div_product_edit_other_image_error.fadeOut("fast");
			$div_product_edit_other_image_success.fadeOut("fast");
				
			$("#product_edit_other_image_loader").show();
					
			var form = document.getElementById("frm_producteditotherimage");
			var formData = new FormData(form);

			$.ajax({
            	url: baseDir+'be/products/upload_edit_other_image',
            	type: 'POST',
            	data: formData,
				dataType: 'json',
            	xhr: function() {
               		var myXhr = $.ajaxSettings.xhr();
               		return myXhr;
            	},
            	cache: false,
            	contentType: false,
            	processData: false,
            	success: function (res) {
					$("#product_edit_other_image_loader").hide();
					if(res.status == 'ERR'){
						$div_product_edit_other_image_error.html(res.message);
						$div_product_edit_other_image_success.fadeOut("fast");
						$div_product_edit_other_image_error.fadeIn("fast");
					}else if (res.status == 'SUCCESS'){
						location.reload();					
					}
            	},
				error: function(){
					$("#product_edit_other_image_loader").hide();
					$div_product_edit_other_image_error.html("Something went wrong. Please check your network and try again.");
					$div_product_edit_other_image_success.fadeOut("fast");
					$div_product_edit_other_image_error.fadeIn("fast");
				}
        	});	
		}
		return false;	
}

function upload_product_other_image(){
	$div_product_other_image_error = $("#div_product_other_image_error");
	$div_product_other_image_success = $("#div_product_other_image_success");
				
	$other_image = $("#product_other_image").val();
		
	$valmsg = "";
	$valmsg2 = "";
		
		if ($other_image == ""){
			$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please click Browse to select an image <br/>";
		}else{
			$allowed_extensions = new Array("png","jpg","jpeg","gif");
    		$file_extension = $other_image.split('.').pop();
			
			$found = false;
			for(var i = 0; i <= $allowed_extensions.length; i++){
        		if($allowed_extensions[i]==$file_extension){
					$found = true;
					break;
				}
			}
			
			if ($found == false){
				$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> The file you chose has an incorrect format. Only files with the following extensions are allowed: .png, .jpg, .jpeg, .gif <br/>";
			}
		}
		
		if ($valmsg != $valmsg2){
			$div_product_other_image_error.html($valmsg);
			$div_product_other_image_success.fadeOut("fast");
			$div_product_other_image_error.fadeIn("fast");
		}else{
			$div_product_other_image_error.fadeOut("fast");
			$div_product_other_image_success.fadeOut("fast");
				
			$("#product_other_image_loader").show();
					
			var form = document.getElementById("frm_productotherimage");
			var formData = new FormData(form);

			$.ajax({
            	url: baseDir+'be/products/upload_other_image',
            	type: 'POST',
            	data: formData,
				dataType: 'json',
            	xhr: function() {
               		var myXhr = $.ajaxSettings.xhr();
               		return myXhr;
            	},
            	cache: false,
            	contentType: false,
            	processData: false,
            	success: function (res) {
					$("#product_other_image_loader").hide();
					if(res.status == 'ERR'){
						$div_product_other_image_error.html(res.message);
						$div_product_other_image_success.fadeOut("fast");
						$div_product_other_image_error.fadeIn("fast");
					}else if (res.status == 'SUCCESS'){
						location.reload();					
					}
            	},
				error: function(){
					$("#product_other_image_loader").hide();
					$div_product_other_image_error.html("Something went wrong. Please check your network and try again.");
					$div_product_other_image_success.fadeOut("fast");
					$div_product_other_image_error.fadeIn("fast");
				}
        	});	
		}
		return false;	
}

function update_property_attachments(){
	$div_new_property_attachments_error = $("#div_new_property_attachments_error");
	$div_new_property_attachments_success = $("#div_new_property_attachments_success");
				
	$property_id = $("#property_id").val();	

	$valmsg = "";
	$valmsg2 = "";
		
	if (!$('input[name=publish_status]:checked').val()){$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please select Publish Status <br/>";}
	if (!$('input[name=featured]:checked').val()){$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please select Featured <br/>";}
	
	if ($valmsg != $valmsg2){
		$div_new_property_attachments_error.html($valmsg);
		$div_new_property_attachments_success.fadeOut("fast");
		$div_new_property_attachments_error.fadeIn("fast");
		$('html, body').animate({ scrollTop: $('#div_new_property_attachments_error').offset().top-90 }, 'slow');
	}else{
		$div_new_property_attachments_error.fadeOut("fast");
		$div_new_property_attachments_success.fadeOut("fast");
				
		$("#new_property_attachments_loader").show();
					
		var form = document.getElementById('frm_newpropertyattachments');
		var formData = new FormData(form);

		$.ajax({
           	url: baseDir+'be/properties/update_attachments',
           	type: 'POST',
           	data: formData,
			dataType: 'json',
           	xhr: function() {
           		var myXhr = $.ajaxSettings.xhr();
           		return myXhr;
           	},
           	cache: false,
           	contentType: false,
           	processData: false,
           	success: function (res) {
				$("#new_property_attachments_loader").hide();
				if(res.status == 'ERR'){
					$div_new_property_attachments_error.html(res.message);
					$div_new_property_attachments_success.fadeOut("fast");
					$div_new_property_attachments_error.fadeIn("fast");
					$('html, body').animate({ scrollTop: $('#div_new_property_attachments_error').offset().top-90 }, 'slow');
				}else if (res.status == 'SUCCESS'){
					window.location = baseDir+'be/properties/edit_start/'+$property_id;					
				}
           	},
			error: function(){
				$("#new_property_attachments_loader").hide();
				$div_new_property_attachments_error.html("Something went wrong. Please check your network and try again.");
				$div_new_property_attachments_success.fadeOut("fast");
				$div_new_property_attachments_error.fadeIn("fast");
				$('html, body').animate({ scrollTop: $('#div_new_property_attachments_error').offset().top-90 }, 'slow');
			}
       	});
	
	}
	return false;
}
function delete_product_image($imageid){
	$.ajax({
      	url: baseDir+'be/products/delete_product_image/'+$imageid,
       	type: 'POST',
       	data: '',
		dataType: 'json',
        success: function (res) {
			if(res.status == 'ERR'){
			}else if (res.status == 'SUCCESS'){
				location.reload();					
			}
        },
		error: function(){
		}
	});
}

function update_agent_property_attachments(){
	$div_new_property_attachments_error = $("#div_new_property_attachments_error");
	$div_new_property_attachments_success = $("#div_new_property_attachments_success");
				
	$property_id = $("#property_id").val();	

	$valmsg = "";
	$valmsg2 = "";
		
	if (!$('input[name=publish_status]:checked').val()){$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please select Publish Status <br/>";}
	if (!$('input[name=featured]:checked').val()){$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please select Featured <br/>";}
	
	if ($valmsg != $valmsg2){
		$div_new_property_attachments_error.html($valmsg);
		$div_new_property_attachments_success.fadeOut("fast");
		$div_new_property_attachments_error.fadeIn("fast");
		$('html, body').animate({ scrollTop: $('#div_new_property_attachments_error').offset().top-90 }, 'slow');
	}else{
		$div_new_property_attachments_error.fadeOut("fast");
		$div_new_property_attachments_success.fadeOut("fast");
				
		$("#new_property_attachments_loader").show();
					
		var form = document.getElementById('frm_newpropertyattachments');
		var formData = new FormData(form);

		$.ajax({
           	url: baseDir+'be/properties/update_attachments',
           	type: 'POST',
           	data: formData,
			dataType: 'json',
           	xhr: function() {
           		var myXhr = $.ajaxSettings.xhr();
           		return myXhr;
           	},
           	cache: false,
           	contentType: false,
           	processData: false,
           	success: function (res) {
				$("#new_property_attachments_loader").hide();
				if(res.status == 'ERR'){
					$div_new_property_attachments_error.html(res.message);
					$div_new_property_attachments_success.fadeOut("fast");
					$div_new_property_attachments_error.fadeIn("fast");
					$('html, body').animate({ scrollTop: $('#div_new_property_attachments_error').offset().top-90 }, 'slow');
				}else if (res.status == 'SUCCESS'){
					window.location = baseDir+'be/properties/edit_agent_start/'+$property_id;					
				}
           	},
			error: function(){
				$("#new_property_attachments_loader").hide();
				$div_new_property_attachments_error.html("Something went wrong. Please check your network and try again.");
				$div_new_property_attachments_success.fadeOut("fast");
				$div_new_property_attachments_error.fadeIn("fast");
				$('html, body').animate({ scrollTop: $('#div_new_property_attachments_error').offset().top-90 }, 'slow');
			}
       	});
	
	}
	return false;
}

function filter_clothing_products(){
	$("#clothing_products_div").oLoader({
		backgroundColor:'#fff',
		image: baseDir+'assets/be/js/plugins/oLoader/images/ownageLoader/loader9.gif',
		fadeInTime: 500,
		fadeOutTime: 1000,
		fadeLevel: 0.8
	});				

	var form = document.getElementById('frm_clothingproductsfilter');
	var formData = new FormData(form);

	$.ajax({
     	url: baseDir+'be/products/loadjs_clothing_filtered',
       	type: 'POST',
       	data: formData,
       	xhr: function() {
       		var myXhr = $.ajaxSettings.xhr();
       		return myXhr;
       	},
       	cache: false,
       	contentType: false,
       	processData: false,
     	success: function (result) {
			$("#clothing_products_div").html(result);
			$("#clothing_products_div").oLoader('hide');			
   		},
		error: function(){
			$("#clothing_products_div").oLoader('hide');
		}
    });
	$('#clothing_products_div').oLoader('hide');
}
function filter_cosmetics_products(){
	$("#cosmetics_products_div").oLoader({
		backgroundColor:'#fff',
		image: baseDir+'assets/be/js/plugins/oLoader/images/ownageLoader/loader9.gif',
		fadeInTime: 500,
		fadeOutTime: 1000,
		fadeLevel: 0.8
	});				

	var form = document.getElementById('frm_cosmeticsproductsfilter');
	var formData = new FormData(form);

	$.ajax({
     	url: baseDir+'be/products/loadjs_cosmetics_filtered',
       	type: 'POST',
       	data: formData,
       	xhr: function() {
       		var myXhr = $.ajaxSettings.xhr();
       		return myXhr;
       	},
       	cache: false,
       	contentType: false,
       	processData: false,
     	success: function (result) {
			$("#cosmetics_products_div").html(result);
			$("#cosmetics_products_div").oLoader('hide');			
   		},
		error: function(){
			$("#cosmetics_products_div").oLoader('hide');
		}
    });
	$('#cosmetics_products_div').oLoader('hide');
}
function filter_sound_products(){
	$("#sound_products_div").oLoader({
		backgroundColor:'#fff',
		image: baseDir+'assets/be/js/plugins/oLoader/images/ownageLoader/loader9.gif',
		fadeInTime: 500,
		fadeOutTime: 1000,
		fadeLevel: 0.8
	});				

	var form = document.getElementById('frm_soundproductsfilter');
	var formData = new FormData(form);

	$.ajax({
     	url: baseDir+'be/products/loadjs_sound_filtered',
       	type: 'POST',
       	data: formData,
       	xhr: function() {
       		var myXhr = $.ajaxSettings.xhr();
       		return myXhr;
       	},
       	cache: false,
       	contentType: false,
       	processData: false,
     	success: function (result) {
			$("#sound_products_div").html(result);
			$("#sound_products_div").oLoader('hide');			
   		},
		error: function(){
			$("#sound_products_div").oLoader('hide');
		}
    });
	$('#sound_products_div').oLoader('hide');
}


//ORDERS
function filter_clothing_orders(){
	$("#clothing_orders_div").oLoader({
		backgroundColor:'#fff',
		image: baseDir+'assets/be/js/plugins/oLoader/images/ownageLoader/loader9.gif',
		fadeInTime: 500,
		fadeOutTime: 1000,
		fadeLevel: 0.8
	});				

	var form = document.getElementById('frm_clothingordersfilter');
	var formData = new FormData(form);

	$.ajax({
     	url: baseDir+'be/orders/loadjs_clothing_filtered',
       	type: 'POST',
       	data: formData,
       	xhr: function() {
       		var myXhr = $.ajaxSettings.xhr();
       		return myXhr;
       	},
       	cache: false,
       	contentType: false,
       	processData: false,
     	success: function (result) {
			$("#clothing_orders_div").html(result);
			$("#clothing_orders_div").oLoader('hide');			
   		},
		error: function(){
			$("#clothing_orders_div").oLoader('hide');
		}
    });
	$('#clothing_orders_div').oLoader('hide');
}
function filter_cosmetics_orders(){
	$("#cosmetics_orders_div").oLoader({
		backgroundColor:'#fff',
		image: baseDir+'assets/be/js/plugins/oLoader/images/ownageLoader/loader9.gif',
		fadeInTime: 500,
		fadeOutTime: 1000,
		fadeLevel: 0.8
	});				

	var form = document.getElementById('frm_cosmeticsordersfilter');
	var formData = new FormData(form);

	$.ajax({
     	url: baseDir+'be/orders/loadjs_cosmetics_filtered',
       	type: 'POST',
       	data: formData,
       	xhr: function() {
       		var myXhr = $.ajaxSettings.xhr();
       		return myXhr;
       	},
       	cache: false,
       	contentType: false,
       	processData: false,
     	success: function (result) {
			$("#cosmetics_orders_div").html(result);
			$("#cosmetics_orders_div").oLoader('hide');			
   		},
		error: function(){
			$("#cosmetics_orders_div").oLoader('hide');
		}
    });
	$('#cosmetics_orders_div').oLoader('hide');
}
function filter_sound_orders(){
	$("#sound_orders_div").oLoader({
		backgroundColor:'#fff',
		image: baseDir+'assets/be/js/plugins/oLoader/images/ownageLoader/loader9.gif',
		fadeInTime: 500,
		fadeOutTime: 1000,
		fadeLevel: 0.8
	});				

	var form = document.getElementById('frm_soundordersfilter');
	var formData = new FormData(form);

	$.ajax({
     	url: baseDir+'be/orders/loadjs_sound_filtered',
       	type: 'POST',
       	data: formData,
       	xhr: function() {
       		var myXhr = $.ajaxSettings.xhr();
       		return myXhr;
       	},
       	cache: false,
       	contentType: false,
       	processData: false,
     	success: function (result) {
			$("#sound_orders_div").html(result);
			$("#sound_orders_div").oLoader('hide');			
   		},
		error: function(){
			$("#sound_orders_div").oLoader('hide');
		}
    });
	$('#sound_orders_div').oLoader('hide');
}

function delete_product(product_id,product_type){
	$div_product_error = $("#div_product_error");
	$div_product_success = $("#div_product_success");

	$div_product_error.fadeOut("fast");
	$div_product_success.fadeOut("fast");

	$.ajax({
     	url: baseDir+'be/products/delete/'+product_id,
       	type: 'POST',
       	data: '',
       	xhr: function() {
       		var myXhr = $.ajaxSettings.xhr();
       		return myXhr;
       	},
       	cache: false,
       	contentType: false,
       	processData: false,
     	success: function (res) {
     		try{
     			var obj1 = res;
	     		var obj = $.parseJSON(obj1);

				if(obj['status'] == 'ERR'){
					$div_product_error.html(obj['message']);
					$div_product_success.fadeOut("fast");
					$div_product_error.fadeIn("fast");
				}else if (obj['status'] == 'SUCCESS'){
					$div_product_success.html(obj['message']);
					$div_product_error.fadeOut("fast");
					$div_product_success.fadeIn("fast");

					if (product_type == 'Clothing'){
						filter_clothing_products();
					}else if (product_type == 'Cosmetics'){
						filter_cosmetics_products();
					}else if (product_type == 'Sound'){
						filter_sound_products();					
					}
				}
     		}catch(err){
     			alert(err);
     		}    		
   		},
		error: function(){
			$div_product_error.html("Something went wrong. Please check your network and try again.");
			$div_product_success.fadeOut("fast");
			$div_product_error.fadeIn("fast");
		}
    });
}
function restore_product(product_id,product_type){
	$div_product_error = $("#div_product_error");
	$div_product_success = $("#div_product_success");

	$div_product_error.fadeOut("fast");
	$div_product_success.fadeOut("fast");

	$.ajax({
     	url: baseDir+'be/products/restore/'+product_id,
       	type: 'POST',
       	data: '',
       	xhr: function() {
       		var myXhr = $.ajaxSettings.xhr();
       		return myXhr;
       	},
       	cache: false,
       	contentType: false,
       	processData: false,
     	success: function (res) {
     		try{
     			var obj1 = res;
	     		var obj = $.parseJSON(obj1);

				if(obj['status'] == 'ERR'){
					$div_product_error.html(obj['message']);
					$div_product_success.fadeOut("fast");
					$div_product_error.fadeIn("fast");
				}else if (obj['status'] == 'SUCCESS'){
					$div_product_success.html(obj['message']);
					$div_product_error.fadeOut("fast");
					$div_product_success.fadeIn("fast");

					if (product_type == 'Clothing'){
						filter_clothing_products();
					}else if (product_type == 'Cosmetics'){
						filter_cosmetics_products();
					}else if (product_type == 'Sound'){
						filter_sound_products();					
					}
				}
     		}catch(err){
     			alert(err);
     		}    		
   		},
		error: function(){
			$div_product_error.html("Something went wrong. Please check your network and try again.");
			$div_product_success.fadeOut("fast");
			$div_product_error.fadeIn("fast");
		}
    });
}
//ONLINE/OFFLINE
function set_online(product_id,product_type){
	$div_product_error = $("#div_product_error");
	$div_product_success = $("#div_product_success");

	$div_product_error.fadeOut("fast");
	$div_product_success.fadeOut("fast");

	$.ajax({
     	url: baseDir+'be/products/set_online/'+product_id,
       	type: 'POST',
       	data: '',
       	xhr: function() {
       		var myXhr = $.ajaxSettings.xhr();
       		return myXhr;
       	},
       	cache: false,
       	contentType: false,
       	processData: false,
     	success: function (res) {
     		try{
     			var obj1 = res;
	     		var obj = $.parseJSON(obj1);

				if(obj['status'] == 'ERR'){
					$div_product_error.html(obj['message']);
					$div_product_success.fadeOut("fast");
					$div_product_error.fadeIn("fast");
				}else if (obj['status'] == 'SUCCESS'){
					$div_product_success.html(obj['message']);
					$div_product_error.fadeOut("fast");
					$div_product_success.fadeIn("fast");

					if (product_type == 'Clothing'){
						filter_clothing_products();
					}else if (product_type == 'Cosmetics'){
						filter_cosmetics_products();
					}else if (product_type == 'Sound'){
						filter_sound_products();					
					}
				}
     		}catch(err){
     			alert(err);
     		}    		
   		},
		error: function(){
			$div_product_error.html("Something went wrong. Please check your network and try again.");
			$div_product_success.fadeOut("fast");
			$div_product_error.fadeIn("fast");
		}
    });
}
function set_offline(product_id,product_type){
	$div_product_error = $("#div_product_error");
	$div_product_success = $("#div_product_success");

	$div_product_error.fadeOut("fast");
	$div_product_success.fadeOut("fast");

	$.ajax({
     	url: baseDir+'be/products/set_offline/'+product_id,
       	type: 'POST',
       	data: '',
       	xhr: function() {
       		var myXhr = $.ajaxSettings.xhr();
       		return myXhr;
       	},
       	cache: false,
       	contentType: false,
       	processData: false,
     	success: function (res) {
     		try{
     			var obj1 = res;
	     		var obj = $.parseJSON(obj1);

				if(obj['status'] == 'ERR'){
					$div_product_error.html(obj['message']);
					$div_product_success.fadeOut("fast");
					$div_product_error.fadeIn("fast");
				}else if (obj['status'] == 'SUCCESS'){
					$div_product_success.html(obj['message']);
					$div_product_error.fadeOut("fast");
					$div_product_success.fadeIn("fast");

					if (product_type == 'Clothing'){
						filter_clothing_products();
					}else if (product_type == 'Cosmetics'){
						filter_cosmetics_products();
					}else if (product_type == 'Sound'){
						filter_sound_products();					
					}
				}
     		}catch(err){
     			alert(err);
     		}    		
   		},
		error: function(){
			$div_product_error.html("Something went wrong. Please check your network and try again.");
			$div_product_success.fadeOut("fast");
			$div_product_error.fadeIn("fast");
		}
    });
}
//FEATURED
function set_featured(product_id,product_type){
	$div_product_error = $("#div_product_error");
	$div_product_success = $("#div_product_success");

	$div_product_error.fadeOut("fast");
	$div_product_success.fadeOut("fast");

	$.ajax({
     	url: baseDir+'be/products/set_featured/'+product_id,
       	type: 'POST',
       	data: '',
       	xhr: function() {
       		var myXhr = $.ajaxSettings.xhr();
       		return myXhr;
       	},
       	cache: false,
       	contentType: false,
       	processData: false,
     	success: function (res) {
     		try{
     			var obj1 = res;
	     		var obj = $.parseJSON(obj1);

				if(obj['status'] == 'ERR'){
					$div_product_error.html(obj['message']);
					$div_product_success.fadeOut("fast");
					$div_product_error.fadeIn("fast");
				}else if (obj['status'] == 'SUCCESS'){
					$div_product_success.html(obj['message']);
					$div_product_error.fadeOut("fast");
					$div_product_success.fadeIn("fast");

					if (product_type == 'Clothing'){
						filter_clothing_products();
					}else if (product_type == 'Cosmetics'){
						filter_cosmetics_products();
					}else if (product_type == 'Sound'){
						filter_sound_products();					
					}
				}
     		}catch(err){
     			alert(err);
     		}    		
   		},
		error: function(){
			$div_product_error.html("Something went wrong. Please check your network and try again.");
			$div_product_success.fadeOut("fast");
			$div_product_error.fadeIn("fast");
		}
    });
}
function unset_featured(product_id,product_type){
	$div_product_error = $("#div_product_error");
	$div_product_success = $("#div_product_success");

	$div_product_error.fadeOut("fast");
	$div_product_success.fadeOut("fast");

	$.ajax({
     	url: baseDir+'be/products/unset_featured/'+product_id,
       	type: 'POST',
       	data: '',
       	xhr: function() {
       		var myXhr = $.ajaxSettings.xhr();
       		return myXhr;
       	},
       	cache: false,
       	contentType: false,
       	processData: false,
     	success: function (res) {
     		try{
     			var obj1 = res;
	     		var obj = $.parseJSON(obj1);

				if(obj['status'] == 'ERR'){
					$div_product_error.html(obj['message']);
					$div_product_success.fadeOut("fast");
					$div_product_error.fadeIn("fast");
				}else if (obj['status'] == 'SUCCESS'){
					$div_product_success.html(obj['message']);
					$div_product_error.fadeOut("fast");
					$div_product_success.fadeIn("fast");

					if (product_type == 'Clothing'){
						filter_clothing_products();
					}else if (product_type == 'Cosmetics'){
						filter_cosmetics_products();
					}else if (product_type == 'Sound'){
						filter_sound_products();					
					}
				}
     		}catch(err){
     			alert(err);
     		}    		
   		},
		error: function(){
			$div_product_error.html("Something went wrong. Please check your network and try again.");
			$div_product_success.fadeOut("fast");
			$div_product_error.fadeIn("fast");
		}
    });
}

//NEW ARRIVAL
function set_new_arrival(product_id,product_type){
	$div_product_error = $("#div_product_error");
	$div_product_success = $("#div_product_success");

	$div_product_error.fadeOut("fast");
	$div_product_success.fadeOut("fast");

	$.ajax({
     	url: baseDir+'be/products/set_new_arrival/'+product_id,
       	type: 'POST',
       	data: '',
       	xhr: function() {
       		var myXhr = $.ajaxSettings.xhr();
       		return myXhr;
       	},
       	cache: false,
       	contentType: false,
       	processData: false,
     	success: function (res) {
     		try{
     			var obj1 = res;
	     		var obj = $.parseJSON(obj1);

				if(obj['status'] == 'ERR'){
					$div_product_error.html(obj['message']);
					$div_product_success.fadeOut("fast");
					$div_product_error.fadeIn("fast");
				}else if (obj['status'] == 'SUCCESS'){
					$div_product_success.html(obj['message']);
					$div_product_error.fadeOut("fast");
					$div_product_success.fadeIn("fast");

					if (product_type == 'Clothing'){
						filter_clothing_products();
					}else if (product_type == 'Cosmetics'){
						filter_cosmetics_products();
					}else if (product_type == 'Sound'){
						filter_sound_products();					
					}
				}
     		}catch(err){
     			alert(err);
     		}    		
   		},
		error: function(){
			$div_product_error.html("Something went wrong. Please check your network and try again.");
			$div_product_success.fadeOut("fast");
			$div_product_error.fadeIn("fast");
		}
    });
}
function unset_new_arrival(product_id,product_type){
	$div_product_error = $("#div_product_error");
	$div_product_success = $("#div_product_success");

	$div_product_error.fadeOut("fast");
	$div_product_success.fadeOut("fast");

	$.ajax({
     	url: baseDir+'be/products/unset_new_arrival/'+product_id,
       	type: 'POST',
       	data: '',
       	xhr: function() {
       		var myXhr = $.ajaxSettings.xhr();
       		return myXhr;
       	},
       	cache: false,
       	contentType: false,
       	processData: false,
     	success: function (res) {
     		try{
     			var obj1 = res;
	     		var obj = $.parseJSON(obj1);

				if(obj['status'] == 'ERR'){
					$div_product_error.html(obj['message']);
					$div_product_success.fadeOut("fast");
					$div_product_error.fadeIn("fast");
				}else if (obj['status'] == 'SUCCESS'){
					$div_product_success.html(obj['message']);
					$div_product_error.fadeOut("fast");
					$div_product_success.fadeIn("fast");

					if (product_type == 'Clothing'){
						filter_clothing_products();
					}else if (product_type == 'Cosmetics'){
						filter_cosmetics_products();
					}else if (product_type == 'Sound'){
						filter_sound_products();					
					}
				}
     		}catch(err){
     			alert(err);
     		}    		
   		},
		error: function(){
			$div_product_error.html("Something went wrong. Please check your network and try again.");
			$div_product_success.fadeOut("fast");
			$div_product_error.fadeIn("fast");
		}
    });
}

//SPECIAL OFFER
function set_special_offer(product_id,product_type){
	$div_product_error = $("#div_product_error");
	$div_product_success = $("#div_product_success");

	$div_product_error.fadeOut("fast");
	$div_product_success.fadeOut("fast");

	$.ajax({
     	url: baseDir+'be/products/set_special_offer/'+product_id,
       	type: 'POST',
       	data: '',
       	xhr: function() {
       		var myXhr = $.ajaxSettings.xhr();
       		return myXhr;
       	},
       	cache: false,
       	contentType: false,
       	processData: false,
     	success: function (res) {
     		try{
     			var obj1 = res;
	     		var obj = $.parseJSON(obj1);

				if(obj['status'] == 'ERR'){
					$div_product_error.html(obj['message']);
					$div_product_success.fadeOut("fast");
					$div_product_error.fadeIn("fast");
				}else if (obj['status'] == 'SUCCESS'){
					$div_product_success.html(obj['message']);
					$div_product_error.fadeOut("fast");
					$div_product_success.fadeIn("fast");

					if (product_type == 'Clothing'){
						filter_clothing_products();
					}else if (product_type == 'Cosmetics'){
						filter_cosmetics_products();
					}else if (product_type == 'Sound'){
						filter_sound_products();					
					}
				}
     		}catch(err){
     			alert(err);
     		}    		
   		},
		error: function(){
			$div_product_error.html("Something went wrong. Please check your network and try again.");
			$div_product_success.fadeOut("fast");
			$div_product_error.fadeIn("fast");
		}
    });
}
function unset_special_offer(product_id,product_type){
	$div_product_error = $("#div_product_error");
	$div_product_success = $("#div_product_success");

	$div_product_error.fadeOut("fast");
	$div_product_success.fadeOut("fast");

	$.ajax({
     	url: baseDir+'be/products/unset_special_offer/'+product_id,
       	type: 'POST',
       	data: '',
       	xhr: function() {
       		var myXhr = $.ajaxSettings.xhr();
       		return myXhr;
       	},
       	cache: false,
       	contentType: false,
       	processData: false,
     	success: function (res) {
     		try{
     			var obj1 = res;
	     		var obj = $.parseJSON(obj1);

				if(obj['status'] == 'ERR'){
					$div_product_error.html(obj['message']);
					$div_product_success.fadeOut("fast");
					$div_product_error.fadeIn("fast");
				}else if (obj['status'] == 'SUCCESS'){
					$div_product_success.html(obj['message']);
					$div_product_error.fadeOut("fast");
					$div_product_success.fadeIn("fast");

					if (product_type == 'Clothing'){
						filter_clothing_products();
					}else if (product_type == 'Cosmetics'){
						filter_cosmetics_products();
					}else if (product_type == 'Sound'){
						filter_sound_products();					
					}
				}
     		}catch(err){
     			alert(err);
     		}    		
   		},
		error: function(){
			$div_product_error.html("Something went wrong. Please check your network and try again.");
			$div_product_success.fadeOut("fast");
			$div_product_error.fadeIn("fast");
		}
    });
}

//DEAL OF THE WEEK
function set_deal_of_the_week(product_id,product_type){
	$div_product_error = $("#div_product_error");
	$div_product_success = $("#div_product_success");

	$div_product_error.fadeOut("fast");
	$div_product_success.fadeOut("fast");

	$.ajax({
     	url: baseDir+'be/products/set_deal_of_the_week/'+product_id,
       	type: 'POST',
       	data: '',
       	xhr: function() {
       		var myXhr = $.ajaxSettings.xhr();
       		return myXhr;
       	},
       	cache: false,
       	contentType: false,
       	processData: false,
     	success: function (res) {
     		try{
     			var obj1 = res;
	     		var obj = $.parseJSON(obj1);

				if(obj['status'] == 'ERR'){
					$div_product_error.html(obj['message']);
					$div_product_success.fadeOut("fast");
					$div_product_error.fadeIn("fast");
				}else if (obj['status'] == 'SUCCESS'){
					$div_product_success.html(obj['message']);
					$div_product_error.fadeOut("fast");
					$div_product_success.fadeIn("fast");

					if (product_type == 'Clothing'){
						filter_clothing_products();
					}else if (product_type == 'Cosmetics'){
						filter_cosmetics_products();
					}else if (product_type == 'Sound'){
						filter_sound_products();					
					}
				}
     		}catch(err){
     			alert(err);
     		}    		
   		},
		error: function(){
			$div_product_error.html("Something went wrong. Please check your network and try again.");
			$div_product_success.fadeOut("fast");
			$div_product_error.fadeIn("fast");
		}
    });
}
function unset_deal_of_the_week(product_id,product_type){
	$div_product_error = $("#div_product_error");
	$div_product_success = $("#div_product_success");

	$div_product_error.fadeOut("fast");
	$div_product_success.fadeOut("fast");

	$.ajax({
     	url: baseDir+'be/products/unset_deal_of_the_week/'+product_id,
       	type: 'POST',
       	data: '',
       	xhr: function() {
       		var myXhr = $.ajaxSettings.xhr();
       		return myXhr;
       	},
       	cache: false,
       	contentType: false,
       	processData: false,
     	success: function (res) {
     		try{
     			var obj1 = res;
	     		var obj = $.parseJSON(obj1);

				if(obj['status'] == 'ERR'){
					$div_product_error.html(obj['message']);
					$div_product_success.fadeOut("fast");
					$div_product_error.fadeIn("fast");
				}else if (obj['status'] == 'SUCCESS'){
					$div_product_success.html(obj['message']);
					$div_product_error.fadeOut("fast");
					$div_product_success.fadeIn("fast");

					if (product_type == 'Clothing'){
						filter_clothing_products();
					}else if (product_type == 'Cosmetics'){
						filter_cosmetics_products();
					}else if (product_type == 'Sound'){
						filter_sound_products();					
					}
				}
     		}catch(err){
     			alert(err);
     		}    		
   		},
		error: function(){
			$div_product_error.html("Something went wrong. Please check your network and try again.");
			$div_product_success.fadeOut("fast");
			$div_product_error.fadeIn("fast");
		}
    });
}



//USER PROFILE
function update_user_profile(){
	$div_edit_system_user_error = $("#div_edit_system_user_error");
	$div_edit_system_user_success = $("#div_edit_system_user_success");
				
	$edit_first_name = $("#edit_first_name").val();
	$edit_last_name = $("#edit_last_name").val();
	$edit_email_address = $("#edit_email_address").val();
	$edit_access_level_id = $("#edit_access_level_id").val();
	
	
	$valmsg = "";
	$valmsg2 = "";
		
	if ($edit_first_name == ""){$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please enter First Name <br/>";}
	if ($edit_last_name == ""){$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please enter Last Name <br/>";}
	if ($edit_email_address == ""){
		$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please enter Email Address<br/>";
	}else if(!validateEmail($edit_email_address)){
		$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please enter the correct Email format <br/>";
	}
	if ($edit_access_level_id == ""){$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please select Access Level <br/>";}
		
		if ($valmsg != $valmsg2){
			$div_edit_system_user_error.html($valmsg);
			$div_edit_system_user_success.fadeOut("fast");
			$div_edit_system_user_error.fadeIn("fast");
		}else{
			$div_edit_system_user_error.fadeOut("fast");
			$div_edit_system_user_success.fadeOut("fast");
				
			$("#edit_system_user_loader").show();
					
			var form = document.getElementById('frm_editsystemuser');
			var formData = new FormData(form);

			$.ajax({
            	url: baseDir+'be/system_users/update_profile',
            	type: 'POST',
            	data: formData,
				dataType: 'json',
            	xhr: function() {
               		var myXhr = $.ajaxSettings.xhr();
               		return myXhr;
            	},
            	cache: false,
            	contentType: false,
            	processData: false,
            	success: function (res) {
					$("#edit_system_user_loader").hide();
					if(res.status == 'ERR'){
						$div_edit_system_user_error.html(res.message);
						$div_edit_system_user_success.fadeOut("fast");
						$div_edit_system_user_error.fadeIn("fast");
					}else if (res.status == 'SUCCESS'){
						$div_edit_system_user_success.html(res.message);
						$div_edit_system_user_error.fadeOut("fast");
						$div_edit_system_user_success.fadeIn("fast");						
					}
            	},
				error: function(){
					$("#edit_system_user_loader").hide();
					$div_edit_system_user_error.html("Something went wrong. Please check your network and try again.");
					$div_edit_system_user_success.fadeOut("fast");
					$div_edit_system_user_error.fadeIn("fast");
				}
        	});
	
		}
		return false;
}

function change_user_password_load(){
	$( '#old_password' ).val('');
	$( '#new_password' ).val('');
	$( '#confirm_password' ).val('');	
	$div_change_user_password_success.fadeOut("fast");
	$div_change_user_password_error.fadeOut("fast");	
}

function change_user_password(){
	$div_change_user_password_error = $("#div_change_user_password_error");
	$div_change_user_password_success = $("#div_change_user_password_success");
				
	$old_password = $("#old_password").val();
	$new_password = $("#new_password").val();
	$confirm_password = $("#confirm_password").val();
	
	
	$valmsg = "";
	$valmsg2 = "";
		
	if ($old_password == ""){$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please enter Old Password <br/>";}
	if ($new_password == ""){$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please enter New Password <br/>";}
	if ($confirm_password == ""){
		$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please enter Confirm Password<br/>";
	}else if($new_password != $confirm_password){
		$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please retype the correct Password <br/>";
	}
		
		if ($valmsg != $valmsg2){
			$div_change_user_password_error.html($valmsg);
			$div_change_user_password_success.fadeOut("fast");
			$div_change_user_password_error.fadeIn("fast");
		}else{
			$div_change_user_password_error.fadeOut("fast");
			$div_change_user_password_success.fadeOut("fast");
				
			$("#change_user_password_loader").show();
					
			var form = document.getElementById('frm_changeuserpassword');
			var formData = new FormData(form);

			$.ajax({
            	url: baseDir+'be/system_users/change_password',
            	type: 'POST',
            	data: formData,
				dataType: 'json',
            	xhr: function() {
               		var myXhr = $.ajaxSettings.xhr();
               		return myXhr;
            	},
            	cache: false,
            	contentType: false,
            	processData: false,
            	success: function (res) {
					$("#change_user_password_loader").hide();
					if(res.status == 'ERR'){
						$div_change_user_password_error.html(res.message);
						$div_change_user_password_success.fadeOut("fast");
						$div_change_user_password_error.fadeIn("fast");
					}else if (res.status == 'SUCCESS'){
						$div_change_user_password_success.html(res.message);
						$div_change_user_password_error.fadeOut("fast");
						$div_change_user_password_success.fadeIn("fast");						
					}
            	},
				error: function(){
					$("#change_user_password_loader").hide();
					$div_change_user_password_error.html("Something went wrong. Please check your network and try again.");
					$div_change_user_password_success.fadeOut("fast");
					$div_change_user_password_error.fadeIn("fast");
				}
        	});
	
		}
		return false;
}

function change_profile_picture(){
	$div_change_profile_picture_error = $("#div_change_profile_picture_error");
	$div_change_profile_picture_success = $("#div_change_profile_picture_success");
				
	$profile_picture = $("#profile_picture").val();
	$user_id = $("#profile_picture_user_id").val();	
	
	
	$valmsg = "";
	$valmsg2 = "";
		
		if ($profile_picture == ""){
			$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please click Browse to select a profile picture <br/>";
		}else{
			$allowed_extensions = new Array("png","jpg","jpeg","gif");
    		$file_extension = $profile_picture.split('.').pop();
			
			$found = false;
			for(var i = 0; i <= $allowed_extensions.length; i++){
        		if($allowed_extensions[i]==$file_extension){
					$found = true;
					break;
				}
			}
			
			if ($found == false){
				$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> The file you chose has an incorrect format. Only files with the following extensions are allowed: .png, .jpg, .jpeg, .gif <br/>";
			}

		}
		
		if ($valmsg != $valmsg2){
			$div_change_profile_picture_error.html($valmsg);
			$div_change_profile_picture_success.fadeOut("fast");
			$div_change_profile_picture_error.fadeIn("fast");
		}else{
			$div_change_profile_picture_error.fadeOut("fast");
			$div_change_profile_picture_success.fadeOut("fast");
				
			$("#change_profile_picture_loader").show();
					
			var form = document.getElementById('frm_changeprofilepicture');
			var formData = new FormData(form);

			$.ajax({
            	url: baseDir+'be/system_users/change_profile_picture',
            	type: 'POST',
            	data: formData,
				dataType: 'json',
            	xhr: function() {
               		var myXhr = $.ajaxSettings.xhr();
               		return myXhr;
            	},
            	cache: false,
            	contentType: false,
            	processData: false,
            	success: function (res) {
					$("#edit_system_user_loader").hide();
					if(res.status == 'ERR'){
						$div_change_profile_picture_error.html(res.message);
						$div_change_profile_picture_success.fadeOut("fast");
						$div_change_profile_picture_error.fadeIn("fast");
					}else if (res.status == 'SUCCESS'){
						window.location = $user_id;					
					}
            	},
				error: function(){
					$("#change_profile_picture_loader").hide();
					$div_change_profile_picture_error.html("Something went wrong. Please check your network and try again.");
					$div_change_profile_picture_success.fadeOut("fast");
					$div_change_profile_picture_error.fadeIn("fast");
				}
        	});
	
		}
		return false;
}




//Business TypeS
function business_type_add_clear(){
	//alert('Test');
	$( '#frm_addbusinesstype' ).each(function(){
		this.reset();
	});	
	$div_add_business_type_success.fadeOut("fast");
	$div_add_business_type_error.fadeOut("fast");
}

function save_business_type(){
		$div_add_business_type_error = $("#div_add_business_type_error");
		$div_add_business_type_success = $("#div_add_business_type_success");
				
		$add_business_type_name = $("#add_business_type_name").val();
		$add_business_type_description = $("#add_business_type_description").val();
	
		$valmsg = "";
		$valmsg2 = "";
		
		if ($add_business_type_name == "" || $add_business_type_name == null){$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please enter Business Type Name <br/>";}
			
		if ($valmsg != $valmsg2){
			$div_add_business_type_error.html($valmsg);
			$div_add_business_type_success.fadeOut("fast");
			$div_add_business_type_error.fadeIn("fast");
		}else{
			$div_add_business_type_error.fadeOut("fast");
			$div_add_business_type_success.fadeOut("fast");
				
			$("#add_business_type_loader").show();
					
			var form = document.getElementById('frm_addbusinesstype');
			var formData = new FormData(form);

			$.ajax({
            	url: baseDir+'be/business_types/save',
            	type: 'POST',
            	data: formData,
				dataType: 'json',
            	xhr: function() {
               		var myXhr = $.ajaxSettings.xhr();
               		return myXhr;
            	},
            	cache: false,
            	contentType: false,
            	processData: false,
            	success: function (res) {
					$("#add_business_type_loader").hide();
					if(res.status == 'ERR'){
						$div_add_business_type_error.html(res.message);
						$div_add_business_type_success.fadeOut("fast");
						$div_add_business_type_error.fadeIn("fast");
					}else if (res.status == 'SUCCESS'){
						$div_add_business_type_success.html(res.message);
						$div_add_business_type_error.fadeOut("fast");
						$div_add_business_type_success.fadeIn("fast");
						
						$( '#frm_addbusinesstype' ).each(function(){
							this.reset();
						});	

						load_business_types();

					}
            	},
				error: function(){
					$("#add_business_type_loader").hide();
					$div_add_business_type_error.html("Something went wrong. Please check your network and try again.");
					$div_add_business_type_success.fadeOut("fast");
					$div_add_business_type_error.fadeIn("fast");
				}
        	});
	
		}
		return false;
}
//LOAD Business TypeS
function load_business_types(){
	$('#div_business_types_loader').oLoader({
		backgroundColor:'#fff',
		image: baseDir+'assets/be/js/plugins/oLoader/images/ownageLoader/loader9.gif',
		fadeInTime: 500,
		fadeOutTime: 1000,
		fadeLevel: 0.8
	});				
	$.ajax({
     	url: baseDir+'be/business_types/loadjs',
       	type: 'POST',
       	data: '',
       	xhr: function() {
       		var myXhr = $.ajaxSettings.xhr();
       		return myXhr;
       	},
       	cache: false,
       	contentType: false,
       	processData: false,
     	success: function (result) {
			$("#business_types_div").html(result);
			$('#div_business_types_loader').oLoader('hide');			
   		},
		error: function(){
			$('#div_business_types_loader').oLoader('hide');
		}
    });
}
function business_type_edit_load(business_type_id){
	$div_edit_business_type_error = $("#div_edit_business_type_error");
	$div_edit_business_type_success = $("#div_edit_business_type_success");

	$.ajax({
     	url: baseDir+'be/business_types/get_business_type/'+business_type_id,
       	type: 'POST',
       	data: '',
       	xhr: function() {
       		var myXhr = $.ajaxSettings.xhr();
       		return myXhr;
       	},
       	cache: false,
       	contentType: false,
       	processData: false,
     	success: function (res) {
     		try{
     			var obj1 = res;
     			obj1 = obj1.replace('[','');
     			obj1 = obj1.replace(']','');
	     		var obj = $.parseJSON(obj1);
	     		$("#edit_business_type_id").val(obj['business_type_id']);
	     		$("#edit_business_type_name").val(obj['business_type_name']);
	     		$("#edit_business_type_description").val(obj['business_type_description']);
	     		if (obj['is_active'] == 1){
	     			$("#edit_is_active1").prop("checked", true).change();
	     			//$("#edit_is_active2").prop("checked", false);

	     			//$("#edit_is_active1").attr('checked', 'checked');
	     		}else{
	     			//$("#edit_is_active1").prop("checked", false);	     			
	     			$("#edit_is_active2").prop("checked", true).change();
	     			//$("#edit_is_active2").attr('checked', 'checked');	     			
	     		}
	     		//$('input[name=is_active]:checked').val(obj['is_active']).change();
	     		//document.querySelector('input[name="is_active"]:checked').value = obj['is_active'];

     		}catch(err){
     			alert(err);
     		}
   		},
		error: function(){
		}
    });
   	$div_edit_business_type_error.fadeOut("fast");
	$div_edit_business_type_success.fadeOut("fast");

}
function update_business_type(){
		$div_edit_business_type_error = $("#div_edit_business_type_error");
		$div_edit_business_type_success = $("#div_edit_business_type_success");
				
		$edit_business_type_name = $("#edit_business_type_name").val();
		$edit_business_type_description = $("#edit_business_type_description").val();
	
		$valmsg = "";
		$valmsg2 = "";
		
		if ($edit_business_type_name == ""){$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please enter Business Type Name <br/>";}
		
		if ($valmsg != $valmsg2){
			$div_edit_business_type_error.html($valmsg);
			$div_edit_business_type_success.fadeOut("fast");
			$div_edit_business_type_error.fadeIn("fast");
		}else{
			$div_edit_business_type_error.fadeOut("fast");
			$div_edit_business_type_success.fadeOut("fast");
				
			$("#edit_business_type_loader").show();
					
			var form = document.getElementById('frm_editbusinesstype');
			var formData = new FormData(form);

			$.ajax({
            	url: baseDir+'be/business_types/update',
            	type: 'POST',
            	data: formData,
				dataType: 'json',
            	xhr: function() {
               		var myXhr = $.ajaxSettings.xhr();
               		return myXhr;
            	},
            	cache: false,
            	contentType: false,
            	processData: false,
            	success: function (res) {
					$("#edit_business_type_loader").hide();
					if(res.status == 'ERR'){
						$div_edit_business_type_error.html(res.message);
						$div_edit_business_type_success.fadeOut("fast");
						$div_edit_business_type_error.fadeIn("fast");
					}else if (res.status == 'SUCCESS'){
						$div_edit_business_type_success.html(res.message);
						$div_edit_business_type_error.fadeOut("fast");
						$div_edit_business_type_success.fadeIn("fast");
						
						load_business_types();

					}
            	},
				error: function(){
					$("#edit_business_type_loader").hide();
					$div_edit_business_type_error.html("Something went wrong. Please check your network and try again.");
					$div_edit_business_type_success.fadeOut("fast");
					$div_edit_business_type_error.fadeIn("fast");
				}
        	});
	
		}
		return false;
}
function delete_business_type(business_type_id){
	$div_business_type_error = $("#div_business_type_error");
	$div_business_type_success = $("#div_business_type_success");

	$div_business_type_error.fadeOut("fast");
	$div_business_type_success.fadeOut("fast");

	$.ajax({
     	url: baseDir+'be/business_types/delete/'+business_type_id,
       	type: 'POST',
       	data: '',
       	xhr: function() {
       		var myXhr = $.ajaxSettings.xhr();
       		return myXhr;
       	},
       	cache: false,
       	contentType: false,
       	processData: false,
     	success: function (res) {
     		try{
     			var obj1 = res;
	     		var obj = $.parseJSON(obj1);

				if(obj['status'] == 'ERR'){
					$div_business_type_error.html(obj['message']);
					$div_business_type_success.fadeOut("fast");
					$div_business_type_error.fadeIn("fast");
				}else if (obj['status'] == 'SUCCESS'){
					$div_business_type_success.html(obj['message']);
					$div_business_type_error.fadeOut("fast");
					$div_business_type_success.fadeIn("fast");

					load_business_types();
				}
     		}catch(err){
     			alert(err);
     		}    		
   		},
		error: function(){
			$div_business_type_error.html("Something went wrong. Please check your network and try again.");
			$div_business_type_success.fadeOut("fast");
			$div_business_type_error.fadeIn("fast");
		}
    });
}


//BUSINESS LISTINGS
function business_listing_add_clear(){
	//alert('Test');
	$div_add_business_listing_error = $("#div_add_business_listing_error");
	$div_add_business_listing_success = $("#div_add_business_listing_success");

	$( '#frm_addbusinesslisting' ).each(function(){
		this.reset();
	});	
	$div_add_business_listing_success.fadeOut("fast");
	$div_add_business_listing_error.fadeOut("fast");
}

function save_business_listing(){
	//alert('Am here!');
	$div_add_business_listing_error = $("#div_add_business_listing_error");
	$div_add_business_listing_success = $("#div_add_business_listing_success");
				
	$add_business_name = $("#add_business_name").val();
	$add_business_type_id = $("#add_business_type_id").val();
	$add_phone_number = $("#add_phone_number").val();	
	$add_email_address = $("#add_email_address").val();	
	
	$valmsg = "";
	$valmsg2 = "";
		
	if ($add_business_name == ""){$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please enter Business Name <br/>";}
	if ($add_business_type_id == ""){$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please select Business Type <br/>";}
	if ($add_phone_number == ""){$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please enter Phone Number <br/>";}
	if ($add_email_address != ""){
		if(!validateEmail($add_email_address)){
			$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please enter the correct Email format <br/>";
		}
	}
		
	if ($valmsg != $valmsg2){
		$div_add_business_listing_error.html($valmsg);
		$div_add_business_listing_success.fadeOut("fast");
		$div_add_business_listing_error.fadeIn("fast");
	}else{
		$div_add_business_listing_error.fadeOut("fast");
		$div_add_business_listing_success.fadeOut("fast");
				
		$("#add_business_listing_loader").show();
					
		var form = document.getElementById('frm_addbusinesslisting');
		var formData = new FormData(form);

		$.ajax({
           	url: baseDir+'be/business_listings/save',
           	type: 'POST',
           	data: formData,
			dataType: 'json',
           	xhr: function() {
           		var myXhr = $.ajaxSettings.xhr();
           		return myXhr;
           	},
           	cache: false,
           	contentType: false,
           	processData: false,
           	success: function (res) {
				$("#add_business_listing_loader").hide();
				if(res.status == 'ERR'){
					$div_add_business_listing_error.html(res.message);
					$div_add_business_listing_success.fadeOut("fast");
					$div_add_business_listing_error.fadeIn("fast");
				}else if (res.status == 'SUCCESS'){
					$div_add_business_listing_success.html(res.message);
					$div_add_business_listing_error.fadeOut("fast");
					$div_add_business_listing_success.fadeIn("fast");
					
					$( '#frm_addbusinesslisting' ).each(function(){
						this.reset();
						$("#add_gender").val('').trigger('change');
						$("#add_department_id").val('').trigger('change');
						$("#add_access_level_id").val('').trigger('change');						
					});	

					load_business_listings();

				}
           	},
			error: function(){
				$("#add_business_listing_loader").hide();
				$div_add_business_listing_error.html("Something went wrong. Please check your network and try again.");
				$div_add_business_listing_success.fadeOut("fast");
				$div_add_business_listing_error.fadeIn("fast");
			}
       	});
	
	}
		return false;
}
//LOAD BUSINESS LISTINGS
function load_business_listings(){
	$('#div_business_listings_loader').oLoader({
		backgroundColor:'#fff',
		image: baseDir+'assets/be/js/plugins/oLoader/images/ownageLoader/loader9.gif',
		fadeInTime: 500,
		fadeOutTime: 1000,
		fadeLevel: 0.8
	});				
	$.ajax({
     	url: baseDir+'be/business_listings/loadjs',
       	type: 'POST',
       	data: '',
       	xhr: function() {
       		var myXhr = $.ajaxSettings.xhr();
       		return myXhr;
       	},
       	cache: false,
       	contentType: false,
       	processData: false,
     	success: function (result) {
			$("#business_listings_div").html(result);
			$('#div_business_listings_loader').oLoader('hide');			
   		},
		error: function(){
			$('#div_business_listings_loader').oLoader('hide');
		}
    });
}
function business_listing_edit_load(business_listing_id){
	$div_edit_business_listing_error = $("#div_edit_business_listing_error");
	$div_edit_business_listing_success = $("#div_edit_business_listing_success");
	
	$.ajax({
     	url: baseDir+'be/business_listings/get_business_listing/'+business_listing_id,
       	type: 'POST',
       	data: '',
       	xhr: function() {
       		var myXhr = $.ajaxSettings.xhr();
       		return myXhr;
       	},
       	cache: false,
       	contentType: false,
       	processData: false,
     	success: function (res) {
     		try{
     			var obj1 = res;
     			obj1 = obj1.replace('[','');
     			obj1 = obj1.replace(']','');
	     		var obj = $.parseJSON(obj1);

				$("#edit_business_id").val(obj['business_id']);	     			
	     		$("#edit_business_name").val(obj['business_name']);
	     		$("#edit_business_description").val(obj['business_description']);
	     		$("#edit_business_type_id").val(obj['business_type_id']).change(); 
	     		$("#edit_city_id").val(obj['city_id']).change();
	     		$("#edit_phone_number").val(obj['phone_number']);
	     		$("#edit_mobile_number").val(obj['mobile_number']);
	     		$("#edit_email_address").val(obj['email_address']);
	     		$("#edit_website").val(obj['website']); 
	     		if (obj['publish_status'] == 1){
	     			$("#edit_publish_status1").prop("checked", true).change();
	     		}else{
	     			$("#edit_publish_status2").prop("checked", true).change();
	     		}

	     		if (obj['business_logo'] == ''){
	     			$("#business_listing_logo").attr('src', baseDir + 'assets/be/images/demo/users/avi-1.png');
	     		}else{
	     			$picture_path = baseDir + 'uploads/business_logos/' + obj['business_logo'];
	     			check_business_logo_exists($picture_path);
	     		}	     		
     		}catch(err){
     			alert(err);
     		}
   		},
		error: function(){
		}
    });
   	$div_edit_business_listing_error.fadeOut("fast");
	$div_edit_business_listing_success.fadeOut("fast");

}
function check_business_logo_exists($picture_path){
	$.ajax({
		url: $picture_path,
		type: 'HEAD',
		error: function(){
			$("#business_listing_logo").attr('src', baseDir + 'assets/be/images/demo/users/avi-1.png');
		},
		success: function(){
			$("#business_listing_logo").attr('src', $picture_path);
		}
	});
}
function update_business_listing(){
	$div_edit_business_listing_error = $("#div_edit_business_listing_error");
	$div_edit_business_listing_success = $("#div_edit_business_listing_success");
				
	$edit_business_name = $("#edit_business_name").val();
	$edit_business_type_id = $("#edit_business_type_id").val();
	$edit_phone_number = $("#edit_phone_number").val();	
	$edit_email_address = $("#edit_email_address").val();	
	
	$valmsg = "";
	$valmsg2 = "";
		
	if ($edit_business_name == ""){$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please enter Business Name <br/>";}
	if ($edit_business_type_id == ""){$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please select Business Type <br/>";}
	if ($edit_phone_number == ""){$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please enter Phone Number <br/>";}
	if ($edit_email_address != ""){
		if(!validateEmail($edit_email_address)){
			$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please enter the correct Email format <br/>";
		}
	}
		
		if ($valmsg != $valmsg2){
			$div_edit_business_listing_error.html($valmsg);
			$div_edit_business_listing_success.fadeOut("fast");
			$div_edit_business_listing_error.fadeIn("fast");
		}else{
			$div_edit_business_listing_error.fadeOut("fast");
			$div_edit_business_listing_success.fadeOut("fast");
				
			$("#edit_business_listing_loader").show();
					
			var form = document.getElementById('frm_editbusinesslisting');
			var formData = new FormData(form);

			$.ajax({
            	url: baseDir+'be/business_listings/update',
            	type: 'POST',
            	data: formData,
				dataType: 'json',
            	xhr: function() {
               		var myXhr = $.ajaxSettings.xhr();
               		return myXhr;
            	},
            	cache: false,
            	contentType: false,
            	processData: false,
            	success: function (res) {
					$("#edit_business_listing_loader").hide();
					if(res.status == 'ERR'){
						$div_edit_business_listing_error.html(res.message);
						$div_edit_business_listing_success.fadeOut("fast");
						$div_edit_business_listing_error.fadeIn("fast");
					}else if (res.status == 'SUCCESS'){
						$div_edit_business_listing_success.html(res.message);
						$div_edit_business_listing_error.fadeOut("fast");
						$div_edit_business_listing_success.fadeIn("fast");
						
						load_business_listings();

					}
            	},
				error: function(){
					$("#edit_business_listing_loader").hide();
					$div_edit_business_listing_error.html("Something went wrong. Please check your network and try again.");
					$div_edit_business_listing_success.fadeOut("fast");
					$div_edit_business_listing_error.fadeIn("fast");
				}
        	});
	
		}
		return false;
}

function delete_business_listing(business_listing_id){
    //alert('Am clicked!');
    $div_business_listing_error = $("#div_business_listing_error");
    $div_business_listing_success = $("#div_business_listing_success");

    $div_business_listing_error.fadeOut("fast");
    $div_business_listing_success.fadeOut("fast");

    $.ajax({
        url: baseDir+'be/business_listings/delete/'+business_listing_id,
        type: 'POST',
        data: '',
        xhr: function() {
            var myXhr = $.ajaxSettings.xhr();
            return myXhr;
        },
        cache: false,
        contentType: false,
        processData: false,
        success: function (res) {
            try{
                var obj1 = res;
                var obj = $.parseJSON(obj1);

                if(obj['status'] == 'ERR'){
                    $div_business_listing_error.html(obj['message']);
                    $div_business_listing_success.fadeOut("fast");
                    $div_business_listing_error.fadeIn("fast");
                }else if (obj['status'] == 'SUCCESS'){
                    $div_business_listing_success.html(obj['message']);
                    $div_business_listing_error.fadeOut("fast");
                    $div_business_listing_success.fadeIn("fast");

					load_business_listings();
                    
                }
            }catch(err){
                alert(err);
            }           
        },
        error: function(){
            $div_business_listing_error.html("Something went wrong. Please check your network and try again.");
            $div_business_listing_success.fadeOut("fast");
            $div_business_listing_error.fadeIn("fast");
        }
    });
}

//HOME BACKGROUND IMAGE
function set_home_image(){
	$div_home_image_error = $("#div_home_image_error");
	$div_home_image_success = $("#div_home_image_success");
				
	$home_image = $("#home_image").val();
	//$property_id = $("#home_image_id").val();	
		
	$valmsg = "";
	$valmsg2 = "";
		
		if ($home_image == ""){
			$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please click Browse to select an image <br/>";
		}else{
			$allowed_extensions = new Array("png","jpg","jpeg","gif");
    		$file_extension = $home_image.split('.').pop();
			
			$found = false;
			for(var i = 0; i <= $allowed_extensions.length; i++){
        		if($allowed_extensions[i]==$file_extension){
					$found = true;
					break;
				}
			}
			
			if ($found == false){
				$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> The file you chose has an incorrect format. Only files with the following extensions are allowed: .png, .jpg, .jpeg, .gif <br/>";
			}
		}
		
		if ($valmsg != $valmsg2){
			$div_home_image_error.html($valmsg);
			$div_home_image_success.fadeOut("fast");
			$div_home_image_error.fadeIn("fast");
		}else{
			$div_home_image_error.fadeOut("fast");
			$div_home_image_success.fadeOut("fast");
				
			$("#home_image_loader").show();
					
			var form = document.getElementById('frm_sethomeimage');
			var formData = new FormData(form);

			$.ajax({
            	url: baseDir+'be/ads/upload_home_image',
            	type: 'POST',
            	data: formData,
				dataType: 'json',
            	xhr: function() {
               		var myXhr = $.ajaxSettings.xhr();
               		return myXhr;
            	},
            	cache: false,
            	contentType: false,
            	processData: false,
            	success: function (res) {
					$("#home_image_loader").hide();
					if(res.status == 'ERR'){
						$div_home_image_error.html(res.message);
						$div_home_image_success.fadeOut("fast");
						$div_home_image_error.fadeIn("fast");
					}else if (res.status == 'SUCCESS'){
						location.reload();					
					}
            	},
				error: function(){
					$("#home_image_loader").hide();
					$div_home_image_error.html("Something went wrong. Please check your network and try again.");
					$div_home_image_success.fadeOut("fast");
					$div_home_image_error.fadeIn("fast");
				}
        	});	
		}
		return false;	
}


//HEADER ADVERTS
function upload_header_advert($header_advert_id){
	$div_header_advert_error = $("#div_header_advert_"+$header_advert_id+"_error");
	$div_header_advert_success = $("#div_header_advert_"+$header_advert_id+"_success");
				
	$header_advert = $("#header_advert_"+$header_advert_id).val();
		
	$valmsg = "";
	$valmsg2 = "";
		
		if ($header_advert == ""){
			$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please click Browse to select an image <br/>";
		}else{
			$allowed_extensions = new Array("png","jpg","jpeg","gif");
    		$file_extension = $header_advert.split('.').pop();
			
			$found = false;
			for(var i = 0; i <= $allowed_extensions.length; i++){
        		if($allowed_extensions[i]==$file_extension){
					$found = true;
					break;
				}
			}
			
			if ($found == false){
				$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> The file you chose has an incorrect format. Only files with the following extensions are allowed: .png, .jpg, .jpeg, .gif <br/>";
			}
		}
		
		if ($valmsg != $valmsg2){
			$div_header_advert_error.html($valmsg);
			$div_header_advert_success.fadeOut("fast");
			$div_header_advert_error.fadeIn("fast");
		}else{
			$div_header_advert_error.fadeOut("fast");
			$div_header_advert_success.fadeOut("fast");
				
			$("#header_advert_"+$header_advert_id+"_loader").show();
					
			var form = document.getElementById("frm_headeradvert"+$header_advert_id);
			var formData = new FormData(form);

			$.ajax({
            	url: baseDir+'be/ads/upload_header_advert/'+$header_advert_id,
            	type: 'POST',
            	data: formData,
				dataType: 'json',
            	xhr: function() {
               		var myXhr = $.ajaxSettings.xhr();
               		return myXhr;
            	},
            	cache: false,
            	contentType: false,
            	processData: false,
            	success: function (res) {
					$("#header_advert_"+$header_advert_id+"_loader").hide();
					if(res.status == 'ERR'){
						$div_header_advert_error.html(res.message);
						$div_header_advert_success.fadeOut("fast");
						$div_header_advert_error.fadeIn("fast");
					}else if (res.status == 'SUCCESS'){
						location.reload();					
					}
            	},
				error: function(){
					$("#header_advert_"+$header_advert_id+"_loader").hide();
					$div_header_advert_error.html("Something went wrong. Please check your network and try again.");
					$div_header_advert_success.fadeOut("fast");
					$div_header_advert_error.fadeIn("fast");
				}
        	});	
		}
		return false;	
}

function upload_header_advert2(){
	//alert('Am here!');
	$div_header_advert_error = $("#div_header_ad_error");
	$div_header_advert_success = $("#div_header_ad_success");
				
	$header_advert = $("#hd_img").val();
	//$property_id = $("#header_advert_"+$header_advert_id+"_id").val();	
		
	$valmsg = "";
	$valmsg2 = "";
		
		if ($header_advert == ""){
			$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please click Browse to select an image <br/>";
		}else{
			$allowed_extensions = new Array("png","jpg","jpeg","gif");
    		$file_extension = $header_advert.split('.').pop();
			
			$found = false;
			for(var i = 0; i <= $allowed_extensions.length; i++){
        		if($allowed_extensions[i]==$file_extension){
					$found = true;
					break;
				}
			}
			
			if ($found == false){
				$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> The file you chose has an incorrect format. Only files with the following extensions are allowed: .png, .jpg, .jpeg, .gif <br/>";
			}
		}
		
		if ($valmsg != $valmsg2){
			$div_header_advert_error.html($valmsg);
			$div_header_advert_success.fadeOut("fast");
			$div_header_advert_error.fadeIn("fast");
		}else{
			$div_header_advert_error.fadeOut("fast");
			$div_header_advert_success.fadeOut("fast");
				
			$("#header_ad_loader").show();
					
			var form = document.getElementById("frm_headerad");
			var formData = new FormData(form);

			$.ajax({
            	url: baseDir+'be/ads/upload_header_advert2',
            	type: 'POST',
            	data: formData,
				dataType: 'json',
            	xhr: function() {
               		var myXhr = $.ajaxSettings.xhr();
               		return myXhr;
            	},
            	cache: false,
            	contentType: false,
            	processData: false,
            	success: function (res) {
					$("#header_ad_loader").hide();
					if(res.status == 'ERR'){
						$div_header_advert_error.html(res.message);
						$div_header_advert_success.fadeOut("fast");
						$div_header_advert_error.fadeIn("fast");
					}else if (res.status == 'SUCCESS'){
						location.reload();					
					}
            	},
				error: function(){
					$("#header_ad_loader").hide();
					$div_header_advert_error.html("Something went wrong. Please check your network and try again.");
					$div_header_advert_success.fadeOut("fast");
					$div_header_advert_error.fadeIn("fast");
				}
        	});	
		}
		return false;	
}



//SIDEBAR ADVERTS
function upload_sidebar_advert($sidebar_advert_id){
	$div_sidebar_advert_error = $("#div_sidebar_advert_"+$sidebar_advert_id+"_error");
	$div_sidebar_advert_success = $("#div_sidebar_advert_"+$sidebar_advert_id+"_success");
				
	$sidebar_advert = $("#sidebar_advert_"+$sidebar_advert_id).val();
		
	$valmsg = "";
	$valmsg2 = "";
		
		if ($sidebar_advert == ""){
			$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please click Browse to select an image <br/>";
		}else{
			$allowed_extensions = new Array("png","jpg","jpeg","gif");
    		$file_extension = $sidebar_advert.split('.').pop();
			
			$found = false;
			for(var i = 0; i <= $allowed_extensions.length; i++){
        		if($allowed_extensions[i]==$file_extension){
					$found = true;
					break;
				}
			}
			
			if ($found == false){
				$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> The file you chose has an incorrect format. Only files with the following extensions are allowed: .png, .jpg, .jpeg, .gif <br/>";
			}
		}
		
		if ($valmsg != $valmsg2){
			$div_sidebar_advert_error.html($valmsg);
			$div_sidebar_advert_success.fadeOut("fast");
			$div_sidebar_advert_error.fadeIn("fast");
		}else{
			$div_sidebar_advert_error.fadeOut("fast");
			$div_sidebar_advert_success.fadeOut("fast");
				
			$("#sidebar_advert_"+$sidebar_advert_id+"_loader").show();
					
			var form = document.getElementById("frm_sidebaradvert"+$sidebar_advert_id);
			var formData = new FormData(form);

			$.ajax({
            	url: baseDir+'be/ads/upload_sidebar_advert/'+$sidebar_advert_id,
            	type: 'POST',
            	data: formData,
				dataType: 'json',
            	xhr: function() {
               		var myXhr = $.ajaxSettings.xhr();
               		return myXhr;
            	},
            	cache: false,
            	contentType: false,
            	processData: false,
            	success: function (res) {
					$("#sidebar_advert_"+$sidebar_advert_id+"_loader").hide();
					if(res.status == 'ERR'){
						$div_sidebar_advert_error.html(res.message);
						$div_sidebar_advert_success.fadeOut("fast");
						$div_sidebar_advert_error.fadeIn("fast");
					}else if (res.status == 'SUCCESS'){
						location.reload();					
					}
            	},
				error: function(){
					$("#sidebar_advert_"+$sidebar_advert_id+"_loader").hide();
					$div_sidebar_advert_error.html("Something went wrong. Please check your network and try again.");
					$div_sidebar_advert_success.fadeOut("fast");
					$div_sidebar_advert_error.fadeIn("fast");
				}
        	});	
		}
		return false;	
}

function upload_sidebar_advert2(){
	//alert('Am here!');
	$div_sidebar_advert_error = $("#div_sidebar_ad_error");
	$div_sidebar_advert_success = $("#div_sidebar_ad_success");
				
	$sidebar_advert = $("#hd_img").val();
	//$property_id = $("#sidebar_advert_"+$sidebar_advert_id+"_id").val();	
		
	$valmsg = "";
	$valmsg2 = "";
		
		if ($sidebar_advert == ""){
			$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please click Browse to select an image <br/>";
		}else{
			$allowed_extensions = new Array("png","jpg","jpeg","gif");
    		$file_extension = $sidebar_advert.split('.').pop();
			
			$found = false;
			for(var i = 0; i <= $allowed_extensions.length; i++){
        		if($allowed_extensions[i]==$file_extension){
					$found = true;
					break;
				}
			}
			
			if ($found == false){
				$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> The file you chose has an incorrect format. Only files with the following extensions are allowed: .png, .jpg, .jpeg, .gif <br/>";
			}
		}
		
		if ($valmsg != $valmsg2){
			$div_sidebar_advert_error.html($valmsg);
			$div_sidebar_advert_success.fadeOut("fast");
			$div_sidebar_advert_error.fadeIn("fast");
		}else{
			$div_sidebar_advert_error.fadeOut("fast");
			$div_sidebar_advert_success.fadeOut("fast");
				
			$("#sidebar_ad_loader").show();
					
			var form = document.getElementById("frm_sidebarad");
			var formData = new FormData(form);

			$.ajax({
            	url: baseDir+'be/ads/upload_sidebar_advert2',
            	type: 'POST',
            	data: formData,
				dataType: 'json',
            	xhr: function() {
               		var myXhr = $.ajaxSettings.xhr();
               		return myXhr;
            	},
            	cache: false,
            	contentType: false,
            	processData: false,
            	success: function (res) {
					$("#sidebar_ad_loader").hide();
					if(res.status == 'ERR'){
						$div_sidebar_advert_error.html(res.message);
						$div_sidebar_advert_success.fadeOut("fast");
						$div_sidebar_advert_error.fadeIn("fast");
					}else if (res.status == 'SUCCESS'){
						location.reload();					
					}
            	},
				error: function(){
					$("#sidebar_ad_loader").hide();
					$div_sidebar_advert_error.html("Something went wrong. Please check your network and try again.");
					$div_sidebar_advert_success.fadeOut("fast");
					$div_sidebar_advert_error.fadeIn("fast");
				}
        	});	
		}
		return false;	
}





//DETAIL ADVERTS
function upload_detail_advert($detail_advert_id){
	$div_detail_advert_error = $("#div_detail_advert_"+$detail_advert_id+"_error");
	$div_detail_advert_success = $("#div_detail_advert_"+$detail_advert_id+"_success");
				
	$detail_advert = $("#detail_advert_"+$detail_advert_id).val();
		
	$valmsg = "";
	$valmsg2 = "";
		
		if ($detail_advert == ""){
			$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please click Browse to select an image <br/>";
		}else{
			$allowed_extensions = new Array("png","jpg","jpeg","gif");
    		$file_extension = $detail_advert.split('.').pop();
			
			$found = false;
			for(var i = 0; i <= $allowed_extensions.length; i++){
        		if($allowed_extensions[i]==$file_extension){
					$found = true;
					break;
				}
			}
			
			if ($found == false){
				$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> The file you chose has an incorrect format. Only files with the following extensions are allowed: .png, .jpg, .jpeg, .gif <br/>";
			}
		}
		
		if ($valmsg != $valmsg2){
			$div_detail_advert_error.html($valmsg);
			$div_detail_advert_success.fadeOut("fast");
			$div_detail_advert_error.fadeIn("fast");
		}else{
			$div_detail_advert_error.fadeOut("fast");
			$div_detail_advert_success.fadeOut("fast");
				
			$("#detail_advert_"+$detail_advert_id+"_loader").show();
					
			var form = document.getElementById("frm_detailadvert"+$detail_advert_id);
			var formData = new FormData(form);

			$.ajax({
            	url: baseDir+'be/ads/upload_detail_advert/'+$detail_advert_id,
            	type: 'POST',
            	data: formData,
				dataType: 'json',
            	xhr: function() {
               		var myXhr = $.ajaxSettings.xhr();
               		return myXhr;
            	},
            	cache: false,
            	contentType: false,
            	processData: false,
            	success: function (res) {
					$("#detail_advert_"+$detail_advert_id+"_loader").hide();
					if(res.status == 'ERR'){
						$div_detail_advert_error.html(res.message);
						$div_detail_advert_success.fadeOut("fast");
						$div_detail_advert_error.fadeIn("fast");
					}else if (res.status == 'SUCCESS'){
						location.reload();					
					}
            	},
				error: function(){
					$("#detail_advert_"+$detail_advert_id+"_loader").hide();
					$div_detail_advert_error.html("Something went wrong. Please check your network and try again.");
					$div_detail_advert_success.fadeOut("fast");
					$div_detail_advert_error.fadeIn("fast");
				}
        	});	
		}
		return false;	
}

function upload_detail_advert2(){
	//alert('Am here!');
	$div_detail_advert_error = $("#div_detail_ad_error");
	$div_detail_advert_success = $("#div_detail_ad_success");
				
	$detail_advert = $("#hd_img").val();
	//$property_id = $("#detail_advert_"+$detail_advert_id+"_id").val();	
		
	$valmsg = "";
	$valmsg2 = "";
		
		if ($detail_advert == ""){
			$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> Please click Browse to select an image <br/>";
		}else{
			$allowed_extensions = new Array("png","jpg","jpeg","gif");
    		$file_extension = $detail_advert.split('.').pop();
			
			$found = false;
			for(var i = 0; i <= $allowed_extensions.length; i++){
        		if($allowed_extensions[i]==$file_extension){
					$found = true;
					break;
				}
			}
			
			if ($found == false){
				$valmsg = $valmsg + "<i class='fa fa-exclamation-circle'></i> The file you chose has an incorrect format. Only files with the following extensions are allowed: .png, .jpg, .jpeg, .gif <br/>";
			}
		}
		
		if ($valmsg != $valmsg2){
			$div_detail_advert_error.html($valmsg);
			$div_detail_advert_success.fadeOut("fast");
			$div_detail_advert_error.fadeIn("fast");
		}else{
			$div_detail_advert_error.fadeOut("fast");
			$div_detail_advert_success.fadeOut("fast");
				
			$("#detail_ad_loader").show();
					
			var form = document.getElementById("frm_detailad");
			var formData = new FormData(form);

			$.ajax({
            	url: baseDir+'be/ads/upload_detail_advert2',
            	type: 'POST',
            	data: formData,
				dataType: 'json',
            	xhr: function() {
               		var myXhr = $.ajaxSettings.xhr();
               		return myXhr;
            	},
            	cache: false,
            	contentType: false,
            	processData: false,
            	success: function (res) {
					$("#detail_ad_loader").hide();
					if(res.status == 'ERR'){
						$div_detail_advert_error.html(res.message);
						$div_detail_advert_success.fadeOut("fast");
						$div_detail_advert_error.fadeIn("fast");
					}else if (res.status == 'SUCCESS'){
						location.reload();					
					}
            	},
				error: function(){
					$("#detail_ad_loader").hide();
					$div_detail_advert_error.html("Something went wrong. Please check your network and try again.");
					$div_detail_advert_success.fadeOut("fast");
					$div_detail_advert_error.fadeIn("fast");
				}
        	});	
		}
		return false;	
}