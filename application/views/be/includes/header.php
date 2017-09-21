<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1">
		<title><?php echo $page_title;?>PiddieSmart</title>
		<link rel="icon" href="<?php echo base_url();?>assets/be/images/favicon.png">

		
		<link rel="stylesheet" href="https://use.fontawesome.com/5b2df044cb.css">
		<link href="<?php echo base_url();?>assets/be/css/bootstrap.min.css" rel="stylesheet" type="text/css">
		<link href="<?php echo base_url();?>assets/be/css/londinium-theme.css" rel="stylesheet" type="text/css">
		<link href="<?php echo base_url();?>assets/be/css/styles.css" rel="stylesheet" type="text/css">
		<link href="<?php echo base_url();?>assets/be/css/icons.css" rel="stylesheet" type="text/css">
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&amp;subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">

		<script type="text/javascript" src="<?php echo base_url();?>assets/be/ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>assets/be/ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>

		<script type="text/javascript" src="<?php echo base_url();?>assets/be/js/plugins/charts/sparkline.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>assets/be/js/plugins/charts/flot.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>assets/be/js/plugins/charts/flot.orderbars.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>assets/be/js/plugins/charts/flot.pie.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>assets/be/js/plugins/charts/flot.time.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>assets/be/js/plugins/charts/flot.animator.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>assets/be/js/plugins/charts/excanvas.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>assets/be/js/plugins/charts/flot.resize.min.js"></script>
        
        
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
		<script type="text/javascript" src="<?php echo base_url();?>assets/be/js/scripts.js"></script>

		<script type="text/javascript" src="<?php echo base_url();?>assets/be/js/plugins/oLoader/js/jquery.oLoader.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>assets/be/js/plugins/oLoader/js/jquery.elevateZoom-3.0.8.min.js"></script>



	    <script type="text/javascript">
	    	var baseDir = '<?php echo base_url(); ?>';
	    	var cur_city_id = '';
	   	</script>

	</head>

	<body>

	<!-- Navbar -->
	<div class="navbar navbar-inverse" role="navigation">
		<div class="navbar-header">
			<a class="navbar-brand" href="#"><img src="<?php echo base_url();?>assets/be/images/piddie-logo.png" alt="PiddieSmart"></a>
			<a class="sidebar-toggle"><i class="icon-paragraph-justify2"></i></a>
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-icons">
				<span class="sr-only">Toggle navbar</span>
				<i class="icon-grid3"></i>
			</button>
			<button type="button" class="navbar-toggle offcanvas">
				<span class="sr-only">Toggle navigation</span>
				<i class="icon-paragraph-justify2"></i>
			</button>
		</div>

		<ul class="nav navbar-nav navbar-right collapse" id="navbar-icons">
			<li class="user dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown">
						<?php if ($this->session->userdata('profile_picture')): ?>
							<?php if (file_exists('./uploads/profile_pictures/' . $this->session->userdata('profile_picture'))): ?>
								<img src="<?php echo base_url(); ?>uploads/profile_pictures/<?php echo $this->session->userdata('profile_picture');?>" alt="">
							<?php else: ?>
								<img src="<?php echo base_url();?>assets/be/images/demo/users/avi-1.png" alt="">
							<?php endif; ?>						
						<?php else: ?>
							<img src="<?php echo base_url();?>assets/be/images/demo/users/avi-1.png" alt="">						
						<?php endif; ?>

					<span><?php echo $this->session->userdata('user_name'); ?></span>
					<i class="caret"></i>
				</a>
				<ul class="dropdown-menu dropdown-menu-right icons-right">
					<li><a href="<?php echo base_url();?>be/system_users/profile/<?php echo $this->session->userdata('user_id');?>"><i class="icon-user"></i> Profile</a></li>
					<!--<li><a href="#"><i class="icon-bubble4"></i> Messages</a></li>
					<li><a href="#"><i class="icon-cog"></i> Settings</a></li>-->
					<li><a href="<?php echo base_url();?>be/auth/logout"><i class="icon-exit"></i> Logout</a></li>
				</ul>
			</li>
		</ul>
	</div>

	<!-- Page container -->
 	<div class="page-container">

		<!-- Sidebar -->
		<div class="sidebar">
			<div class="sidebar-content">

				<!-- User dropdown -->
				<div class="user-menu dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<?php if ($this->session->userdata('profile_picture')): ?>
							<?php if (file_exists('./uploads/profile_pictures/' . $this->session->userdata('profile_picture'))): ?>
								<img src="<?php echo base_url(); ?>uploads/profile_pictures/<?php echo $this->session->userdata('profile_picture');?>" alt="">
							<?php else: ?>
								<img src="<?php echo base_url();?>assets/be/images/demo/users/avi-1.png" alt="">
							<?php endif; ?>						
						<?php else: ?>
							<img src="<?php echo base_url();?>assets/be/images/demo/users/avi-1.png" alt="">						
						<?php endif; ?>

						<div class="user-info">
							<?php echo $this->session->userdata('user_name'); ?> <!--<span>Administrator</span>-->
						</div>
					</a>
					<div class="popup dropdown-menu dropdown-menu-right">
					    <div class="thumbnail">
					    	<div class="thumb">
								<?php if ($this->session->userdata('profile_picture')): ?>
									<?php if (file_exists('./uploads/profile_pictures/' . $this->session->userdata('profile_picture'))): ?>
										<img src="<?php echo base_url(); ?>uploads/profile_pictures/<?php echo $this->session->userdata('profile_picture');?>" alt="">
									<?php else: ?>
										<img src="<?php echo base_url();?>assets/be/images/demo/users/avi-1.png" alt="">
									<?php endif; ?>						
								<?php else: ?>
									<img src="<?php echo base_url();?>assets/be/images/demo/users/avi-1.png" alt="">						
								<?php endif; ?>

								<div class="thumb-options">
									<span>
										<a href="<?php echo base_url();?>be/system_users/profile/<?php echo $this->session->userdata('user_id');?>" class="btn btn-icon btn-success"><i class="icon-profile"></i></a>
										<!--<a href="#" class="btn btn-icon btn-success"><i class="icon-remove"></i></a>-->
									</span>
								</div>
						    </div>
					    
					    	<div class="caption text-center">
					    		<h6><?php echo $this->session->userdata('user_name'); ?> <!--<small>Administrator</small>--></h6>
					    	</div>
				    	</div>
					</div>
				</div>
				<!-- /user dropdown -->


				<!-- Main navigation -->
				<ul class="navigation">
					<li class="active"><a href="<?php echo base_url();?>be"><span>Dashboard</span> <i class=" icon-home"></i></a></li>
					<li class="active">
						<a href="#"><span>Products</span> <i class=" icon-grid4"></i></a>
						<ul>
							<li><a href="<?php echo base_url();?>be/products/clothing"><span>Clothing Products</span> <i class=" icon-user4"></i></a></li>
							<li><a href="<?php echo base_url();?>be/products/cosmetics"><span>Cosmetics Products</span> <i class=" icon-watch"></i></a></li>
							<li><a href="<?php echo base_url();?>be/products/sound"><span>Sound Products</span> <i class=" icon-mic"></i></a></li>

						</ul>
					</li>

					<li class="active">
						<a href="#"><span>Orders</span> <i class=" icon-cart4"></i></a>
						<ul>
							<li><a href="<?php echo base_url();?>be/orders/clothing"><span>Clothing Orders <!--<span class="label label-success">1</span>--></span> <i class=" icon-cart3"></i></a></li>
							<li><a href="<?php echo base_url();?>be/orders/cosmetics"><span>Cosmetics Orders</span> <i class=" icon-cart2"></i></a></li>
							<li><a href="<?php echo base_url();?>be/orders/sound"><span>Sound Orders</span> <i class=" icon-cart5"></i></a></li>

						</ul>
					</li>

					<li class="active">
						<a href="#"><span>System Setup</span> <i class=" icon-cogs"></i></a>
						<ul>
							<li><a href="<?php echo base_url();?>be/customers"><span>Customers</span> <i class=" icon-address-book"></i></a></li>
							<li><a href="<?php echo base_url();?>be/categories"><span>Categories</span> <i class=" icon-tree3"></i></a></li>
							<li><a href="<?php echo base_url();?>be/brands"><span>Brands</span> <i class="icon-trophy-star"></i></a></li>
							<li><a href="<?php echo base_url();?>be/countries"><span>Countries</span> <i class="icon-globe"></i></a></li>
							<li><a href="<?php echo base_url();?>be/towns"><span>Towns</span> <i class="icon-location2"></i></a></li>
							<li><a href="<?php echo base_url();?>be/currencies"><span>Currencies</span> <i class="icon-coin"></i></a></li>
						</ul>
					</li>
<!-- 					<li class="active">
						<a hreactivef="#"><span>Images &amp; Adverts</span> <i class=" icon-image"></i></a>
						<ul>
							<li><a href="<?php echo base_url();?>be/ads/home_image"><span>Homepage Background Image</span> </a></li>
							<li><a href="<?php echo base_url();?>be/ads/header_adverts"><span>Header Adverts</span></a></li>
							<li><a href="<?php echo base_url();?>be/ads/sidebar_adverts"><span>Sidebar Adverts</span></a></li>
							<li><a href="<?php echo base_url();?>be/ads/detail_adverts"><span>Detail View Adverts</span></a></li>
						</ul>
					</li>
 -->					
					<li class="active">
						<a href="#"><span>Administration</span> <i class=" icon-user"></i></a>
						<ul>
							<li><a href="<?php echo base_url();?>be/company_information">Company Information <i class="icon-info"></i></a></li>
							<li><a href="<?php echo base_url();?>be/access_levels">Access Levels <i class="icon-user-block"></i></a></li>
							<li><a href="<?php echo base_url();?>be/departments">Departments<i class="icon-archive"></i></a></li>
							<li><a href="<?php echo base_url();?>be/system_users">System Users <i class="icon-users"></i></a></li>
						</ul>
					</li>
				</ul>
				<!-- /main navigation -->
			</div>
		</div>
		<!-- /sidebar -->

