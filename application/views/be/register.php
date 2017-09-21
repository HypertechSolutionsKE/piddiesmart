<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1">
		<title>Set System Administrator - PiddieSmart</title>
		<link rel="icon" href="<?php echo base_url();?>assets/be/images/favicon.png">

		<link href="<?php echo base_url();?>assets/be/css/bootstrap.min.css" rel="stylesheet" type="text/css">
		<link href="<?php echo base_url();?>assets/be/css/londinium-theme.css" rel="stylesheet" type="text/css">
		<link href="<?php echo base_url();?>assets/be/css/styles.css" rel="stylesheet" type="text/css">
		<link href="<?php echo base_url();?>assets/be/css/select2.min.css" rel="stylesheet" type="text/css">
		<link href="<?php echo base_url();?>assets/be/css/icons.css" rel="stylesheet" type="text/css">
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&amp;subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">

		<script type="text/javascript" src="<?php echo base_url();?>assets/be/ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>assets/be/ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>assets/be/js/plugins/charts/sparkline.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>assets/be/js/plugins/forms/uniform.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>assets/be/js/plugins/forms/select2.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>assets/be/js/plugins/forms/inputmask.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>assets/be/js/plugins/forms/autosize.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>assets/be/js/plugins/forms/inputlimit.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>assets/be/js/plugins/forms/listbox.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>assets/be/js/plugins/forms/multiselect.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>assets/be/js/plugins/forms/validate.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>assets/be/js/plugins/forms/tags.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>assets/be/js/plugins/forms/switch.min.js"></script>

		<script type="text/javascript" src="<?php echo base_url();?>assets/be/js/plugins/forms/uploader/plupload.full.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>assets/be/js/plugins/forms/uploader/plupload.queue.min.js"></script>

		<script type="text/javascript" src="<?php echo base_url();?>assets/be/js/plugins/forms/wysihtml5/wysihtml5.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>assets/be/js/plugins/forms/wysihtml5/toolbar.js"></script>

		<script type="text/javascript" src="<?php echo base_url();?>assets/be/js/plugins/interface/daterangepicker.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>assets/be/js/plugins/interface/fancybox.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>assets/be/js/plugins/interface/moment.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>assets/be/js/plugins/interface/jgrowl.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>assets/be/js/plugins/interface/datatables.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>assets/be/js/plugins/interface/colorpicker.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>assets/be/js/plugins/interface/fullcalendar.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>assets/be/js/plugins/interface/timepicker.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>assets/be/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>assets/be/js/application.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>assets/be/js/form_validation.js"></script>
        
	</head>

	<body class="full-width page-condensed">

	<!-- Navbar -->
	<div class="navbar navbar-inverse" role="navigation">
		<div class="navbar-header">
			<!--<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-right">
				<span class="sr-only">Toggle navbar</span>
				<i class="icon-grid3"></i>
			</button>-->
			<a class="navbar-brand" href="#"><img src="<?php echo base_url();?>assets/be/images/piddie-logo.png" alt="PiddieSmart"></a>
		</div>
	</div>
	<!-- /navbar -->


	<!-- Login wrapper -->
	<div class="register-wrapper">
    	<form class="set-system-admin-form" action="<?php echo base_url();?>be/auth/register" method="post" role="form" enctype="multipart/form-data">
			<div class="popup-header">
				<a href="#" class="pull-left"><i class="icon-user-plus"></i></a>
				<span class="text-semibold">PiddieSmart Set System Administrator</span>
			</div>
			<div class="well">
         		<div class="form-group">
                	<div class="row">
                    	<div class="col-md-12">
                        	<p><i>Being your first login, the system allows you to create an administrator account with full rights and priviledges. This account will be the parent account to all other accounts that may be added later.</i></p>
                        </div>
                    </div>
                </div>
				<?php if (isset($error)): ?>
 					<div class="alert alert-danger block-inner">
                 		<button type="button" class="close" data-dismiss="alert">×</button>
                     	<?php echo $error; ?>
        			</div>               
                <?php endif; ?>
         		<div class="form-group">
                	<div class="row">
                    	<div class="col-md-6">
                            <label>First Name: <span class="mandatory">*</span></label>
                            <input type="text" class="required form-control" placeholder="First Name" id="first_name" name="first_name">
                        </div>
                    	<div class="col-md-6">
                            <label>Last Name: <span class="mandatory">*</span></label>
                            <input type="text" class="required form-control" placeholder="Last Name" id="last_name" name="last_name">
                        </div>
                    </div>
                </div>
         		<!--<div class="form-group">
                	<div class="row">
                    	<div class="col-md-6">
                            <label>Phone Number:</label>
                            <input type="text" class="form-control" placeholder="Phone Number" id="phone_number" name="phone_number">
                        </div>
                    	<div class="col-md-6">
                            <label>Gender: <span class="mandatory">*</span></label><br />
                       		<select data-placeholder="Select..." class="clear-results required" name="gender" id="gender">
		                    	<option value=""></option> 
		                        <option value="FEMALE">FEMALE</option> 
		                        <option value="MALE">MALE</option> 
		                    </select>
                        </div>
                    </div>
                </div>-->
         		<div class="form-group">
                	<div class="row">
                    	<div class="col-md-12">
                            <label>Email Address: <span class="mandatory">*</span></label>
                            <input type="email" class="required form-control" placeholder="Email Address" id="email_address" name="email_address">
                        </div>
                    </div>
                </div>
         		<div class="form-group">
                	<div class="row">
                    	<div class="col-md-6">
                            <label>Password: <span class="mandatory">*</span></label>
                            <input type="password" class="required form-control" placeholder="Password" id="user_password" name="user_password">
                        </div>
                    	<div class="col-md-6">
                            <label>Confirm Password: <span class="mandatory">*</span></label>
                            <input type="password" class="required form-control" placeholder="Confirm Password" id="confirm_password" name="confirm_password">
                        </div>
                    </div>
                </div>
                
               
				<div class="row form-actions">
					<div class="col-md-12">
						<button type="submit" class="btn btn-success pull-right"><i class="icon-lock3"></i> Register</button>
					</div>
				</div>
			</div>
    	</form>
	</div>  
	<!-- /login wrapper -->


    <!-- Footer -->
    <div class="footer clearfix">
        <div class="pull-left">Copyright &copy; <?php echo date('Y'); ?> - All Rights Reserved - <a href="#">PiddieSmart</a></div>
    </div>
    <!-- /footer -->


</body>
</html>