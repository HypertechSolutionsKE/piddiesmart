<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1">
		<title>Admin Login - PiddieSmart</title>
		<link rel="icon" href="<?php echo base_url();?>assets/be/images/favicon.png">

		<link href="<?php echo base_url();?>assets/be/css/bootstrap.min.css" rel="stylesheet" type="text/css">
		<link href="<?php echo base_url();?>assets/be/css/londinium-theme.css" rel="stylesheet" type="text/css">
		<link href="<?php echo base_url();?>assets/be/css/styles.css" rel="stylesheet" type="text/css">
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
	<div class="login-wrapper">
    	<form class="validate" action="<?php echo base_url();?>be/auth/login" method="post" role="form">
			<div class="popup-header">
				<a href="#" class="pull-left"><i class="icon-user"></i></a>
				<span class="text-semibold">PiddieSmart Admin Login</span>
				<div class="btn-group pull-right">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-cogs"></i></a>
                    <ul class="dropdown-menu icons-right dropdown-menu-right">
						<!--<li><a href="#"><i class="icon-people"></i> Change user</a></li>-->
						<li><a href="#"><i class="icon-info"></i> Forgot password?</a></li>
						<li><a href="#"><i class="icon-support"></i> Contact admin</a></li>
						<!--<li><a href="#"><i class="icon-wrench"></i> Settings</a></li>-->
                    </ul>
				</div>
			</div>
			<div class="well">

				<?php if (isset($success)): ?>
 					<div class="alert alert-success block-inner">
                 		<button type="button" class="close" data-dismiss="alert">×</button>
                     	<?php echo $success; ?>
        			</div>               
                <?php endif; ?>

				<?php if ($this->session->flashdata('success')): ?>
 					<div class="alert alert-success block-inner">
                 		<button type="button" class="close" data-dismiss="alert">×</button>
                     	<?php echo $this->session->flashdata('success'); ?>
        			</div>               
                <?php endif; ?>
         
				<?php if (isset($incorrect)): ?>
 					<div class="alert alert-danger block-inner">
                 		<button type="button" class="close" data-dismiss="alert">×</button>
                     	<?php echo $incorrect; ?>
        			</div>               
                <?php endif; ?>
            
				<div class="form-group has-feedback">
					<label>Email Address: <span class="mandatory">*</span></label>
					<input type="email" class="required form-control" placeholder="Email" id="email_address" name="email_address">
					<i class="icon-users form-control-feedback"></i>
				</div>

				<div class="form-group has-feedback">
					<label>Password <span class="mandatory">*</span></label>
					<input type="password" class="required form-control" placeholder="Password" id="user_password" name="user_password">
					<i class="icon-lock form-control-feedback"></i>
				</div>

				<div class="row form-actions">
					<div class="col-xs-6">
						<div class="checkbox checkbox-success">
						<label>
							<input type="checkbox" class="styled">
							Remember me
						</label>
						</div>
					</div>

					<div class="col-xs-6">
						<button type="submit" class="btn btn-success pull-right"><i class="icon-lock3"></i> Sign in</button>
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