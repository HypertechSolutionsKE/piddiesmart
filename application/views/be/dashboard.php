		<!-- Page content -->
	 	<div class="page-content">


			<!-- Page header -->
			<div class="page-header">
				<div class="page-title">
					<h3>Dashboard <small>Welcome <strong><?php echo $this->session->userdata('user_name'); ?></strong>. Enjoy your stay here and may your visit be productive!</small></h3>
				</div>

				<!--<div id="reportrange" class="range">
					<div class="visible-xs header-element-toggle">
						<a class="btn btn-primary btn-icon"><i class="icon-calendar"></i></a>
					</div>
					<div class="date-range"></div>
					<span class="label label-danger">9</span>
				</div>-->
			</div>
			<!-- /page header -->


			<!-- Breadcrumbs line -->
			<div class="breadcrumb-line">
				<ul class="breadcrumb">
					<li><a href="index-2.html">Home</a></li>
					<li class="active">Dashboard</li>
				</ul>
			</div>
			<!-- /breadcrumbs line -->



			<!-- Statistics -->
			<div class="block">



<!-- 	    		<ul class="statistics">
	    			<li>
	    				<div class="statistics-info">
		    				<a href="<?php echo base_url();?>be/listing_types" title="" class="bg-success"><i class="icon-list2"></i></a>
		    				<strong><?php //echo $total_listing_types; ?></strong>
		    			</div>
						<div class="progress progress-micro">
							<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
								<span class="sr-only">0% Complete</span>
							</div>
						</div>
						<span>Listing Types</span>
	    			</li>
	    			<li>
	    				<div class="statistics-info">
		    				<a href="<?php echo base_url();?>be/property_types" title="" class="bg-warning"><i class="icon-library"></i></a>
		    				<strong><?php //echo $total_property_types; ?></strong>
		    			</div>
						<div class="progress progress-micro">
							<div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
								<span class="sr-only">0% Complete</span>
							</div>
						</div>
						<span>Property Types</span>
	    			</li>
	    			<li>
	    				<div class="statistics-info">
		    				<a href="<?php echo base_url();?>be/property_subcategories" title="" class="bg-info"><i class="icon-grid2"></i></a>
		    				<strong><?php //echo $total_property_subcategories; ?></strong>
		    			</div>
						<div class="progress progress-micro">
							<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
								<span class="sr-only">0% Complete</span>
							</div>
						</div>
						<span>Property Subcategories</span>
	    			</li>
	    			<li>
	    				<div class="statistics-info">
		    				<a href="<?php echo base_url();?>be/regions" title="" class="bg-danger"><i class="icon-globe2"></i></a>
		    				<strong><?php //echo $total_regions; ?></strong>
		    			</div>
						<div class="progress progress-micro">
							<div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
								<span class="sr-only">70% Complete</span>
							</div>
						</div>
						<span>Regions</span>
	    			</li>
	    			<li>
	    				<div class="statistics-info">
		    				<a href="<?php echo base_url();?>be/cities" title="" class="bg-primary"><i class="icon-map2"></i></a>
		    				<strong><?php //echo $total_cities; ?></strong>
		    			</div>
						<div class="progress progress-micro">
							<div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
								<span class="sr-only">0% Complete</span>
							</div>
						</div>
						<span>Cities/Towns</span>
	    			</li>
	    			<li>
	    				<div class="statistics-info">
		    				<a href="<?php echo base_url();?>be/areas" title="" class="bg-success"><i class="icon-bookmarks"></i></a>
		    				<strong><?php //echo $total_areas; ?></strong>
		    			</div>
						<div class="progress progress-micro">
							<div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
								<span class="sr-only">0% Complete</span>
							</div>
						</div>
						<span>Areas/Localities</span>
	    			</li>
	    			<li>
	    				<div class="statistics-info">
		    				<a href="<?php echo base_url();?>be/property_feature_types" title="" class="bg-warning"><i class="icon-menu3"></i></a>
		    				<strong><?php //echo $total_property_feature_types; ?></strong>
		    			</div>
						<div class="progress progress-micro">
							<div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
								<span class="sr-only">0% Complete</span>
							</div>
						</div>
						<span>Property Feature Types</span>
	    			</li>
	    			<li>
	    				<div class="statistics-info">
		    				<a href="<?php echo base_url();?>be/property_features" title="" class="bg-info"><i class="icon-equalizer"></i></a>
		    				<strong><?php //echo $total_property_features; ?></strong>
		    			</div>
						<div class="progress progress-micro">
							<div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
								<span class="sr-only">0% Complete</span>
							</div>
						</div>
						<span>Property Features</span>
	    			</li>
	    			<li>
	    				<div class="statistics-info">
		    				<a href="<?php echo base_url();?>be/currencies" title="" class="bg-danger"><i class="icon-coin"></i></a>
		    				<strong><?php //echo $total_currencies; ?></strong>
		    			</div>
						<div class="progress progress-micro">
							<div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
								<span class="sr-only">0% Complete</span>
							</div>
						</div>
						<span>Currencies</span>
	    			</li>
	    			<li>
	    				<div class="statistics-info">
		    				<a href="<?php echo base_url();?>be/system_users" title="" class="bg-primary"><i class="icon-users"></i></a>
		    				<strong><?php //echo $total_system_users; ?></strong>
		    			</div>
						<div class="progress progress-micro">
							<div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
								<span class="sr-only">0% Complete</span>
							</div>
						</div>
						<span>System Users</span>
	    			</li>



	    		</ul> -->
    		</div>
    		<!-- /statistics -->


			<!--<div class="row">
				<div class="col-md-6">
			        <div class="panel panel-default">
				        <div class="panel-heading">
					        <h6 class="panel-title"><i class="icon-coin"></i> Sales (Kshs)</h6>
				        </div>
				        <div class="panel-body">
					        <div class="graph-standard" id="filled_green"></div>
				        </div>
			        </div>
				</div> 
                <div class="col-md-6">
			        <div class="panel panel-default">
				        <div class="panel-heading">
					        <h6 class="panel-title"><i class="icon-cog2"></i> Transactions</h6>
				        </div>
				        <div class="panel-body">
					        <div class="graph-standard" id="filled_red"></div>
				        </div>
			        </div>
                </div>
                
            </div>  -->

	        <!-- Footer -->
	        <div class="footer clearfix">
		        <div class="pull-left">&copy; <?php echo date('Y');?>. PiddieSmart powered by <a href="http://hypertechsolutions.co.ke">Hypertech Solutions Limited</a></div>
	        </div>
	        <!-- /footer -->


		</div>
		<!-- /page content -->
