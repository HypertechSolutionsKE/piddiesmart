        <!-- Page content -->
        <div class="page-content">


            <!-- Page header -->
            <div class="page-header">
                <div class="page-title">
                    <h6>&nbsp;</h6>
                </div>
            </div>
            <!-- /page header -->

            <div class="row">
                <div class="col-md-9">
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            <h6 class="panel-title" style="margin-top: 5px"><i class="icon-image"></i> Sidebar Ads</h6>
                        </div>
                        <div class="panel-body">

                                    <?php if ($this->session->flashdata('success')): ?>
                                        <div class="alert alert-success block-inner">
                                            <button type="button" class="close" data-dismiss="alert">×</button>
                                            <?php echo $this->session->flashdata('success'); ?>
                                        </div>                                    

                                    <?php endif; ?>
                                    <?php if ($this->session->flashdata('error')): ?>
                                        <div class="alert alert-danger block-inner">
                                            <button type="button" class="close" data-dismiss="alert">×</button>
                                            <?php echo $this->session->flashdata('errorx'); ?>
                                        </div>                                    
                                    <?php endif; ?>
                            <div class="clearfix" style="margin-top: 10px"></div>

                            <?php foreach ($sidebar_adverts as $row): ?>
                                <div class="col-lg-4 col-md-6 col-sm-6">
                                    <div class="block">
                                        <div class="thumbnail thumbnail-boxed"> 
                                            <?php if($row->sidebar_advert_image != ''): ?>
                                                <?php if (file_exists("./uploads/sidebar_adverts/" . $row->sidebar_advert_image)): ?>
                                                    <a href="<?php echo base_url(); ?>uploads/sidebar_adverts/<?php echo $row->sidebar_advert_image; ?>" class="thumb-zoom lightbox" title="">
                                                        <img src="<?php echo base_url(); ?>uploads/sidebar_adverts/<?php echo $row->sidebar_advert_image; ?>" alt="">
                                                    </a>
                                                    <div class="caption text-center">
                                                        <div class="caption text-center">
                                                            <h6>
                                                                <a data-toggle="modal" role="button" href="#modal_sidebar_advert_<?php echo $row->sidebar_advert_id; ?>" class="btn btn-icon btn-success"><i class="tip icon-pencil" title="Change Image"></i></a>

                                                                <a href="<?php echo base_url(); ?>uploads/sidebar_adverts/<?php echo $row->sidebar_advert_image; ?>" class="btn btn-icon btn-info" title="Download Image" download><i class="tip icon-download" title="Download Image"></i></a>

                                                                <?php if ($row->is_active == 1): ?>
                                                                    <a href="<?php echo base_url(); ?>be/ads/sidebar_advert_inactive/<?php echo $row->sidebar_advert_id; ?>" class="btn btn-icon btn-warning"><i class="tip icon-esc" title="Set Inactive"></i></a>
                                                                <?php else: ?>
                                                                    <a href="<?php echo base_url(); ?>be/ads/sidebar_advert_active/<?php echo $row->sidebar_advert_id; ?>" class="btn btn-icon btn-primary"><i class="tip icon-esc" title="Set Active"></i></a>
                                                                <?php endif; ?>

                                                                <a onClick="javascript:return confirm('Do you really wish to delete this Advert?');" href="<?php echo base_url(); ?>be/ads/sidebar_advert_delete/<?php echo $row->sidebar_advert_id; ?>" class="btn btn-icon btn-danger"><i class="tip icon-close" title="Delete Image"></i></a>

                                                            </h6>
                                                        </div>
                                                    </div>
                                                <?php else: ?>
                                                    <div class="caption text-center">
                                                        <div class="caption text-center">
                                                            <h6>
                                                                <a data-toggle="modal" role="button" href="#modal_sidebar_advert_<?php echo $row->sidebar_advert_id; ?>" class="badge btn-sm btn-success"><i class="icon-plus" title="Add Advert"></i></a>
                                                                <a onClick="javascript:return confirm('Do you really wish to delete this Advert?');" href="<?php echo base_url(); ?>be/ads/sidebar_advert_delete/<?php echo $row->sidebar_advert_id; ?>" class="btn btn-icon btn-danger"><i class="tip icon-close" title="Delete Image"></i></a>

                                                            </h6>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <div class="caption text-center">
                                                    <div class="caption text-center">
                                                        <h6>
                                                            <a data-toggle="modal" role="button" href="#modal_sidebar_advert_<?php echo $row->sidebar_advert_id; ?>" class="badge btn-sm btn-success" title="Add Advert"><i class="icon-plus"></i></a>
                                                            <a onClick="javascript:return confirm('Do you really wish to delete this Advert?');" href="<?php echo base_url(); ?>be/ads/sidebar_advert_delete/<?php echo $row->sidebar_advert_id; ?>" class="btn btn-icon btn-danger"><i class="tip icon-close" title="Delete Image"></i></a>

                                                        </h6>
                                                    </div>
                                                </div>
                                            <?php endif; ?>                                  
                                        </div>
                                    </div>
                                </div>


                            <?php endforeach; ?>
                            <div class="clearfix"></div>
                            <hr>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="block">
                                    <div class="thumbnail thumbnail-boxed">
                                        <div class="caption text-center">
                                            <div class="caption text-center">
                                                <h6><a data-toggle="modal" role="button" href="#md_sidebar_ad" class="btn btn-sm btn-success"><i class="icon-plus-circle" title="Add Advert"></i> Add Advert</a></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


                            <?php foreach ($sidebar_adverts as $row): ?>

                                <!-- Form modal -->
                                <div id="modal_sidebar_advert_<?php echo $row->sidebar_advert_id; ?>" class="modal fade" tabindex="-1" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <h4 class="modal-title"><i class="icon-image"></i> Upload Ad Image</h4>
                                            </div>

                                            <!-- Form inside modal -->
                                            <form class="validate" method="post" role="form" id="frm_sidebaradvert<?php echo $row->sidebar_advert_id; ?>" name="frm_sidebaradvert<?php echo $row->sidebar_advert_id; ?>" onsubmit="return upload_sidebar_advert(<?php echo $row->sidebar_advert_id; ?>);">

                                                <div class="modal-body with-padding">
                                                    <div class="block-inner text-danger">
                                                        <h6 class="heading-hr"> <small class="display-block">Browse for the image then click Upload</small></h6>
                                                    </div>

                                                    <div class="alert alert-danger block-inner" style="display: none;" id="div_sidebar_advert_<?php echo $row->sidebar_advert_id; ?>_error">
                                                        <button type="button" class="close" data-dismiss="alert">×</button>
                                                            Error
                                                    </div>
                                                    <div class="alert alert-success block-inner" style="display: none;" id="div_sidebar_advert_<?php echo $row->sidebar_advert_id; ?>_success">
                                                        <button type="button" class="close" data-dismiss="alert">×</button>
                                                            Error
                                                    </div>
                                                    <input type="hidden" id="sidebar_advert_<?php echo $row->sidebar_advert_id; ?>_id" name="sidebar_advert_<?php echo $row->sidebar_advert_id; ?>_id" value="<?php echo $row->sidebar_advert_id; ?>">
                                                            
                                                     <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <input type="file" class="styled form-control" id="sidebar_advert_<?php echo $row->sidebar_advert_id; ?>" name="sidebar_advert_<?php echo $row->sidebar_advert_id; ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <div class="pull-left" id="sidebar_advert_<?php echo $row->sidebar_advert_id; ?>_loader" style="display: none;"><i class="icon-spinner3 spin block-inner"></i></div>
                                                    <button type="submit" class="btn btn-success"><i class="icon-upload2"></i> Upload</button>
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-close"></i> Close</button>

                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- /form modal -->

                            <?php endforeach; ?>


                    <!-- Form modal -->
                    <div id="md_sidebar_ad" class="modal fade" tabindex="-1" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title"><i class="icon-image"></i> Upload Ad Image</h4>
                                </div>

                                <!-- Form inside modal -->
                                <form class="validate" method="post" role="form" id="frm_sidebarad" name="frm_sidebarad" onsubmit="return upload_sidebar_advert2();">

                                    <div class="modal-body with-padding">
                                        <div class="block-inner text-danger">
                                            <h6 class="heading-hr"> <small class="display-block">Browse for the image then click Upload</small></h6>
                                        </div>

                                        <div class="alert alert-danger block-inner" style="display: none;" id="div_sidebar_ad_error">
                                            <button type="button" class="close" data-dismiss="alert">×</button>
                                                Error
                                        </div>
                                        <div class="alert alert-success block-inner" style="display: none;" id="div_sidebar_ad_success">
                                            <button type="button" class="close" data-dismiss="alert">×</button>
                                                Error
                                        </div>
                                                
                                         <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <input type="file" class="styled form-control" id="hd_img" name="hd_img">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <div class="pull-left" id="sidebar_ad_loader" style="display: none;"><i class="icon-spinner3 spin block-inner"></i></div>
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
