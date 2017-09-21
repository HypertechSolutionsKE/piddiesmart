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
            <?php if (!isset($home_image)): ?>
                <div class="row">
                    <div class="col-md-9">
                        <div class="panel panel-danger">
                            <div class="panel-heading">
                                <h6 class="panel-title" style="margin-top: 5px"><i class="icon-image"></i> Homepage Background Image</h6>
                            </div>
                            <div class="panel-body">
                                <div class="block">
                                    <div class="thumbnail thumbnail-boxed">
                                        <div class="caption text-center">
                                            <div class="caption text-center">
                                                <h6><a data-toggle="modal" role="button" href="#modal_main_image" class="badge btn-sm btn-success"><i class="icon-plus-circle" title="Add Image"></i> Set Image</a></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <?php foreach ($home_image as $row2): ?>
                    <div class="row">
                        <div class="col-md-9">
                            <div class="panel panel-danger">
                                <div class="panel-heading">
                                    <h6 class="panel-title" style="margin-top: 5px"><i class="icon-image"></i> Homepage Background Image</h6>
                                </div>
                                <div class="panel-body">
                                    <div class="block">
                                        <div class="thumbnail thumbnail-boxed">
                                            <?php if($row2->home_image != ''): ?>
                                                <?php if (file_exists("./uploads/home_image/" . $row2->home_image)): ?>
                                                    <a href="<?php echo base_url(); ?>uploads/home_image/<?php echo $row2->home_image; ?>" class="thumb-zoom lightbox" title="">
                                                        <img src="<?php echo base_url(); ?>uploads/home_image/<?php echo $row2->home_image; ?>" alt="">
                                                    </a>
                                                    <div class="caption text-center">
                                                        <h6>Main Image</h6>
                                                        <div class="caption text-center">
                                                        <h6>
                                                            <a data-toggle="modal" role="button" href="#modal_main_image" class="badge btn-sm btn-info" title="Change Image"><i class="icon-pencil"></i></a>
                                                                            
                                                            <a href="<?php echo base_url(); ?>uploads/property_images/<?php echo $row2->home_image; ?>" class="badge btn-sm btn-success" download><i class="icon-download" title="Download Image"></i></a>

                                                        </h6>
                                                    </div>
                                                </div>
                                            <?php else: ?>
                                                <div class="caption text-center">
                                                    <h6>Main Image</h6>
                                                    <div class="caption text-center">
                                                        <h6><a data-toggle="modal" role="button" href="#modal_main_image" class="badge btn-sm btn-success"><i class="icon-plus" title="Add Image"></i> Add</a></h6>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <div class="caption text-center">
                                                <h6>Main Image</h6>
                                                <div class="caption text-center">
                                                    <h6><a data-toggle="modal" role="button" href="#modal_main_image" class="badge btn-sm btn-success"><i class="icon-plus" title="Add Image"></i> Add</a></h6>
                                                </div>
                                            </div>
                                        <?php endif; ?>                                  
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>


                    <!-- Form modal -->
                    <div id="modal_main_image" class="modal fade" tabindex="-1" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title"><i class="icon-image"></i> Set Homepage Background Image</h4>
                                </div>

                                <!-- Form inside modal -->
                                <form class="validate" method="post" role="form" id="frm_sethomeimage" name="frm_sethomeimage" onsubmit="return set_home_image();">

                                    <div class="modal-body with-padding">
                                        <div class="block-inner text-danger">
                                            <h6 class="heading-hr"> <small class="display-block">Browse for the image then click Upload</small></h6>
                                        </div>

                                        <div class="alert alert-danger block-inner" style="display: none;" id="div_home_image_error">
                                            <button type="button" class="close" data-dismiss="alert">×</button>
                                                Error
                                        </div>
                                        <div class="alert alert-success block-inner" style="display: none;" id="div_home_image_success">
                                            <button type="button" class="close" data-dismiss="alert">×</button>
                                                Error
                                        </div>
                                                
                                         <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <input type="file" class="styled form-control" id="home_image" name="home_image">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <div class="pull-left" id="home_image_loader" style="display: none;"><i class="icon-spinner3 spin block-inner"></i></div>
                                        <button type="submit" class="btn btn-success"><i class="icon-upload2"></i> Upload</button>
                                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-close"></i> Close</button>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- /form modal -->

            <!-- Footer -->
            <div class="footer clearfix">
                <div class="pull-left">&copy; <?php echo date('Y');?>. PiddieSmart powered by <a href="http://hypertechsolutions.co.ke">Hypertech Solutions Limited</a></div>
            </div>
            <!-- /footer -->


        </div>
        <!-- /page content -->
