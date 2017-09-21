        <!-- Page content -->
        <div class="page-content">


            <!-- Page header -->
            <div class="page-header">
                <div class="page-title">
                    <h6>&nbsp;</h6>
                </div>
            </div>
            <!-- /page header -->


            <!--<div class="breadcrumb-line">
                <ul class="breadcrumb">
                    <li><a href="<?php echo base_url();?>be">Dashboard</a></li>
                    <li class="active">Currencies</li>
                </ul>
            </div>-->


                <?php foreach ($property as $row2): ?>


                    <div class="row">
                        <div class="col-md-9">
                            <form class="validate" method="post" role="form" id="frm_newpropertycontacts" name="frm_newpropertycontacts" onsubmit="return update_property_contacts();" enctype="multipart/form-data">

                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <h6 class="panel-title" style="margin-top: 5px"><i class="icon-user4"></i> Edit Agent Property</h6>
                                    </div>
                                    <div class="panel-body">
                                        <ul class="nav nav-pills nav-justified">
                                            <li class="bg-succ"><a href="<?php echo base_url();?>be/properties/edit_agent_start/<?php echo $row2->property_id; ?>">Step 1: Basic Info</a></li>
                                            <li class="bg-succ"><a href="<?php echo base_url();?>be/properties/edit_agent_features/<?php echo $row2->property_id; ?>">Step 2: Property Features</a></li>
                                            <li class="active"><a href="<?php echo base_url();?>be/properties/edit_agent_contacts/<?php echo $row2->property_id; ?>">Step 3: Contact Details</a></li>
                                            <li class="bg-succ"><a href="<?php echo base_url();?>be/properties/edit_agent_attachments/<?php echo $row2->property_id; ?>">Step 4: Attachments &amp; Publish</a></li>                                        
                                        </ul>
                                        <div class="clearfix"></div>
                                        <hr>

                                        <?php if($row2->profile_picture != ''): ?>
                                            <?php if (file_exists("./uploads/profile_pictures/" . $row2->profile_picture)): ?>
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                                        <div class="block">
                                                            <div class="thumbnail thumbnail-boxed">     
                                                                <a href="<?php echo base_url(); ?>uploads/profile_pictures/<?php echo $row2->profile_picture; ?>" class="thumb-zoom lightbox">
                                                                    <img src="<?php echo base_url(); ?>uploads/profile_pictures/<?php echo $row2->profile_picture; ?>" alt="">
                                                                </a>
                                                                <div class="caption text-center">
                                                                    <h6>Agent Profile Image</h6>
                                                                    <!--<div class="caption text-center">
                                                                        <h6>
                                                                            <a data-toggle="modal" role="button" href="#modal_main_image" class="badge btn-sm btn-info" title="Change Image"><i class="icon-pencil"></i></a>
                                                                            
                                                                            <a href="<?php echo base_url(); ?>uploads/property_images/<?php echo $row2->main_image; ?>" class="badge btn-sm btn-success" download><i class="icon-download" title="Download Image"></i></a>

                                                                        </h6>
                                                                    </div>-->
                                                                </div>                               
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        <?php endif; ?>

                                        <div class="alert alert-danger fade in block-inner" style="display: none;" id="div_new_property_contacts_error">
                                            <button type="button" class="close" data-dismiss="alert">×</button>
                                            Error
                                        </div>
                                        
                                        <div class="alert alert-success block-inner" style="display: none;" id="div_new_property_contacts_success">
                                            <button type="button" class="close" data-dismiss="alert">×</button>
                                            Error
                                        </div>

                                        <input type="hidden" name="property_id" id="property_id" value="<?php echo $row2->property_id; ?>">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-7">
                                                    <label>Full Name *&nbsp;&nbsp;<a data-placement="top" class="tip" title="Contact person full name"><i class="icon-question2"></i></a></label>
                                                    <input type="text" id="full_name" name="full_name" class="form-control" value="<?php echo $row2->full_name;  ?>">
                                                </div>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-7">
                                                    <label>Email Address *&nbsp;&nbsp;<a data-placement="top" class="tip" title="Contact person email address"><i class="icon-question2"></i></a></label>
                                                    <input type="text" id="email_address" name="email_address" class="form-control" value="<?php echo $row2->email_address; ?>">
                                                </div>

                                            </div>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-7">
                                                    <label>Mobile Phone *&nbsp;&nbsp;<a data-placement="top" class="tip" title="Contact person mobile phone number"><i class="icon-question2"></i></a></label>
                                                    <input type="text" id="mobile_phone" name="mobile_phone" class="form-control" value="<?php echo $row2->mobile_phone; ?>">
                                                </div>

                                            </div>
                                        </div>
                                       <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-7">
                                                    <label>Office Phone&nbsp;&nbsp;<a data-placement="top" class="tip" title="Contact person office phone number"><i class="icon-question2"></i></a></label>
                                                    <input type="text" id="office_phone" name="office_phone" class="form-control" value="<?php echo $row2->office_phone; ?>">
                                                </div>

                                            </div>
                                        </div>
                                       <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-7">
                                                    <label>Home Phone&nbsp;&nbsp;<a data-placement="top" class="tip" title="Contact person home phone number"><i class="icon-question2"></i></a></label>
                                                    <input type="text" id="home_phone" name="home_phone" class="form-control" value="<?php echo $row2->home_phone; ?>">
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <div class="pull-left" id="new_property_contacts_loader" style="display: none;"><i class="icon-spinner3 spin block-inner"></i></div>
                                            <button type="submit" class="btn btn-success"><i class="icon-arrow-right11"></i> Save &amp; Continue with Next Step</button>

                                    </div>

                                 </div>                           
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>

            <!-- Footer -->
            <div class="footer clearfix">
                <div class="pull-left">&copy; <?php echo date('Y');?>. PiddieSmart powered by <a href="http://hypertechsolutions.co.ke">Hypertech Solutions Limited</a></div>
            </div>
            <!-- /footer -->


        </div>
        <!-- /page content -->
