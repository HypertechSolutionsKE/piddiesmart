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
            <?php if (!isset($product)): ?>
                <div class="row">
                    <div class="col-md-9">
                        <form class="validate" method="post" role="form" id="frm_newproductimages" name="frm_newproductimages" onsubmit="return save_new_product_images();" enctype="multipart/form-data">

                            <div class="panel <?php if($product_type == 'Clothing'){echo 'panel-danger';}elseif($product_type == 'Cosmetics'){echo 'panel-default';}elseif($product_type == 'Sound'){echo 'panel-primary';} ?>">
                                <div class="panel-heading">
                                    <?php if($product_type == 'Clothing'): ?>
                                        <h6 class="panel-title" style="margin-top: 5px"><i class="icon-user4"></i> New Clothing Product</h6>
                                        <div class="panel-icons-group">
                                            <a role="button" href="<?php echo base_url();?>be/products/clothing" class="label btn-success"><i class="icon-arrow-left6"></i> Listing</a>
                                        </div>
                                    <?php elseif($product_type == 'Cosmetics'): ?>
                                        <h6 class="panel-title" style="margin-top: 5px"><i class="icon-watch"></i> New Cosmetics Product</h6>
                                        <div class="panel-icons-group">
                                            <a role="button" href="<?php echo base_url();?>be/products/cosmetics" class="label btn-success"><i class="icon-arrow-left6"></i> Listing</a>
                                        </div>
                                    <?php elseif($product_type == 'Sound'): ?>
                                        <h6 class="panel-title" style="margin-top: 5px"><i class="icon-mic"></i> New Sound Product</h6>
                                        <div class="panel-icons-group">
                                            <a role="button" href="<?php echo base_url();?>be/products/sound" class="label btn-success"><i class="icon-arrow-left6"></i> Listing</a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="panel-body">
                                    <ul class="nav nav-pills nav-justified">
                                        <?php if($product_type == 'Clothing'): ?>
                                            <li class="bg-succ"><a href="<?php echo base_url();?>be/products/clothing_add_start">Step 1: Basic Product Info</a></li>
                                            <li class="bg-succ"><a href="<?php echo base_url();?>be/products/clothing_add_features">Step 2: Product Features</a></li>
                                            <li class="active"><a href="<?php echo base_url();?>be/products/clothing_add_images">Step 3: Product Images</a></li>                      
                                        <?php elseif($product_type == 'Cosmetics'): ?>
                                            <li class="bg-succ"><a href="<?php echo base_url();?>be/products/cosmetics_add_start">Step 1: Basic Product Info</a></li>
                                            <li class="bg-succ"><a href="<?php echo base_url();?>be/products/cosmetics_add_features">Step 2: Product Features</a></li>
                                            <li class="active"><a href="<?php echo base_url();?>be/products/cosmetics_add_images">Step 3: Product Images</a></li>                     
                                        <?php elseif($product_type == 'Sound'): ?>
                                            <li class="bg-succ"><a href="<?php echo base_url();?>be/products/sound_add_start">Step 1: Basic Product Info</a></li>
                                            <li class="bg-succ"><a href="<?php echo base_url();?>be/products/sound_add_features">Step 2: Product Features</a></li>
                                            <li class="active"><a href="<?php echo base_url();?>be/products/sound_add_images">Step 3: Product Images</a></li>               
                                        <?php endif; ?>

                                    </ul>
                                    <div class="clearfix"></div>
                                    <hr>

                                    <!--<div class="block-inner text-danger">
                                        <h6 class="heading-hr">Step 2: product Features <small class="display-block">Please fill in the product features and click 'Next'</small></h6>
                                    </div>-->
                                    <input type="hidden" id="product_type" name="product_type" class="form-control" value="<?php echo $product_type;?>">

                                    <div class="alert alert-danger fade in block-inner" style="display: none;" id="div_new_product_images_error">
                                        <button type="button" class="close" data-dismiss="alert">×</button>
                                        Error
                                    </div>
                                    
                                    <div class="alert alert-success block-inner" style="display: none;" id="div_new_product_images_success">
                                        <button type="button" class="close" data-dismiss="alert">×</button>
                                        Error
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-7">
                                                <label>Main Image *&nbsp;&nbsp;<a data-placement="top" class="tip" title="Click here to browse for your product's main image."><i class="icon-question2"></i></a></label>
                                                <input type="file" id="main_image" name="main_image" class="styled">
                                            </div>
                                            <div class="col-sm-5">
                                                <label>&nbsp;</label>
                                                <div class="alert alert-danger fade in block-inner" id="div_main_image_error" style="display: none;">
                                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                                    Error
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-7">
                                                <label>Other Images</label>
                                                <input type="file" id="other_image_1" name="other_image_1" class="styled">
                                            </div>
                                            <div class="col-sm-5">
                                                <label>&nbsp;</label>
                                                <div class="alert alert-danger fade in block-inner" id="div_other_image_1_error" style="display: none;">
                                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                                    Error
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-7">
                                                <input type="file" id="other_image_2" name="other_image_2" class="styled">
                                            </div>
                                            <div class="col-sm-5">
                                                <label>&nbsp;</label>
                                                <div class="alert alert-danger fade in block-inner" id="div_other_image_2_error" style="display: none;">
                                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                                    Error
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-7">
                                                <input type="file" id="other_image_3" name="other_image_3" class="styled">
                                            </div>
                                            <div class="col-sm-5">
                                                <label>&nbsp;</label>
                                                <div class="alert alert-danger fade in block-inner" id="div_other_image_3_error" style="display: none;">
                                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                                    Error
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-7">
                                                <input type="file" id="other_image_4" name="other_image_4" class="styled">
                                            </div>
                                            <div class="col-sm-5">
                                                <label>&nbsp;</label>
                                                <div class="alert alert-danger fade in block-inner" id="div_other_image_4_error" style="display: none;">
                                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                                    Error
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-7">
                                                <input type="file" id="other_image_5" name="other_image_5" class="styled">
                                            </div>
                                            <div class="col-sm-5">
                                                <label>&nbsp;</label>
                                                <div class="alert alert-danger fade in block-inner" id="div_other_image_5_error" style="display: none;">
                                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                                    Error
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>

                                </div>
                                <div class="modal-footer">
                                    <div class="pull-left" id="new_product_images_loader" style="display: none;"><i class="icon-spinner3 spin block-inner"></i></div>
                                        <button type="submit" class="btn btn-success"><i class="icon-arrow-right11"></i> Save &amp; and Publish</button>

                                </div>

                             </div>                           
                        </form>
                    </div>
                </div>
            <?php else: ?>
                <?php foreach ($product as $row2): ?>
                    <div class="row">
                        <div class="col-md-9">
                            <form class="validate" method="post" role="form" id="frm_newproductimages" name="frm_newproductimages" onsubmit="return update_product_images();" enctype="multipart/form-data">
                                <div class="panel <?php if($product_type == 'Clothing'){echo 'panel-danger';}elseif($product_type == 'Cosmetics'){echo 'panel-default';}elseif($product_type == 'Sound'){echo 'panel-primary';} ?>">
                                    <div class="panel-heading">
                                        <?php if($product_type == 'Clothing'): ?>
                                            <h6 class="panel-title" style="margin-top: 5px"><i class="icon-user4"></i> Edit Clothing Product</h6>
                                            <div class="panel-icons-group">
                                                <a role="button" href="<?php echo base_url();?>be/products/clothing" class="label btn-success"><i class="icon-arrow-left6"></i> Listing</a>
                                            </div>
                                        <?php elseif($product_type == 'Cosmetics'): ?>
                                            <h6 class="panel-title" style="margin-top: 5px"><i class="icon-watch"></i> Edit Cosmetics Product</h6>
                                            <div class="panel-icons-group">
                                                <a role="button" href="<?php echo base_url();?>be/products/cosmetics" class="label btn-success"><i class="icon-arrow-left6"></i> Listing</a>
                                            </div>
                                        <?php elseif($product_type == 'Sound'): ?>
                                            <h6 class="panel-title" style="margin-top: 5px"><i class="icon-mic"></i> Edit Sound Product</h6>
                                            <div class="panel-icons-group">
                                                <a role="button" href="<?php echo base_url();?>be/products/sound" class="label btn-success"><i class="icon-arrow-left6"></i> Listing</a>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="panel-body">
                                        <ul class="nav nav-pills nav-justified">
                                            <?php if($product_type == 'Clothing'): ?>
                                                <li class="bg-succ"><a href="<?php echo base_url();?>be/products/clothing_edit_start/<?php echo $row2->product_id; ?>">Step 1: Basic Product Info</a></li>
                                                <li class="bg-succ"><a href="<?php echo base_url();?>be/products/clothing_edit_features/<?php echo $row2->product_id; ?>">Step 2: Product Features</a></li>
                                                <li class="active"><a href="<?php echo base_url();?>be/products/clothing_edit_images/<?php echo $row2->product_id; ?>">Step 3: Product Images</a></li>                      
                                            <?php elseif($product_type == 'Cosmetics'): ?>
                                                <li class="bg-succ"><a href="<?php echo base_url();?>be/products/cosmetics_edit_start/<?php echo $row2->product_id; ?>">Step 1: Basic Product Info</a></li>
                                                <li class="bg-succ"><a href="<?php echo base_url();?>be/products/cosmetics_edit_features/<?php echo $row2->product_id; ?>">Step 2: Product Features</a></li>
                                                <li class="active"><a href="<?php echo base_url();?>be/products/cosmetics_edit_images/<?php echo $row2->product_id; ?>">Step 3: Product Images</a></li>                     
                                            <?php elseif($product_type == 'Sound'): ?>
                                                <li class="bg-succ"><a href="<?php echo base_url();?>be/products/sound_edit_start/<?php echo $row2->product_id; ?>">Step 1: Basic Product Info</a></li>
                                                <li class="bg-succ"><a href="<?php echo base_url();?>be/products/sound_edit_features/<?php echo $row2->product_id; ?>">Step 2: Product Features</a></li>
                                                <li class="active"><a href="<?php echo base_url();?>be/products/sound_edit_images/<?php echo $row2->product_id; ?>">Step 3: Product Images</a></li>               
                                            <?php endif; ?>                                
                                        </ul>
                                        <div class="clearfix"></div>
                                        <hr>

                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                <div class="block">
                                                    <div class="thumbnail thumbnail-boxed">
                                                        <?php if($row2->main_image != ''): ?>
                                                            <?php if (file_exists("./uploads/product_images/" . $row2->main_image)): ?>
                                                                <a href="<?php echo base_url(); ?>uploads/product_images/<?php echo $row2->main_image; ?>" class="thumb-zoom lightbox" title="<?php echo $row2->product_name;?>">
                                                                    <img src="<?php echo base_url(); ?>uploads/product_images/<?php echo $row2->main_image; ?>" alt="">
                                                                </a>
                                                                <div class="caption text-center">
                                                                    <h6>Main Image</h6>
                                                                    <div class="caption text-center">
                                                                        <h6>
                                                                            <a data-toggle="modal" role="button" href="#modal_main_image" class="btn btn-icon btn-info" title="Change Image"><i class="icon-pencil"></i></a>
                                                                            
                                                                            <a href="<?php echo base_url(); ?>uploads/product_images/<?php echo $row2->main_image; ?>" class="btn btn-icon btn-success" download><i class="icon-download" title="Download Image"></i></a>

                                                                        </h6>
                                                                    </div>
                                                                </div>
                                                            <?php else: ?>
                                                                <div class="caption text-center">
                                                                    <h6>Main Image</h6>
                                                                    <div class="caption text-center">
                                                                        <h6><a data-toggle="modal" role="button" href="#modal_main_image" class="btn btn-icon btn-success"><i class="icon-plus" title="Add Image"></i> Add</a></h6>
                                                                    </div>
                                                                </div>
                                                            <?php endif; ?>
                                                        <?php else: ?>
                                                            <div class="caption text-center">
                                                                <h6>Main Image</h6>
                                                                <div class="caption text-center">
                                                                    <h6><a data-toggle="modal" role="button" href="#modal_main_image" class="btn btn-icon btn-success"><i class="icon-plus" title="Add Image"></i> Add</a></h6>
                                                                    </div>
                                                            </div>
                                                        <?php endif; ?>                                  
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">

                                        <?php $numimages = $product_num_other_images;?>
                                        <?php $i = 1; ?>
                                        <?php foreach ($product_other_images as $poi): ?>
                                            <div class="col-lg-3 col-md-6 col-sm-6">
                                                <div class="block">
                                                    <div class="thumbnail thumbnail-boxed"> 
                                                        <?php if($poi->image_filename != ''): ?>
                                                            <?php if (file_exists("./uploads/product_images/" . $poi->image_filename)): ?>
                                                                <a href="<?php echo base_url(); ?>uploads/product_images/<?php echo $poi->image_filename; ?>" class="thumb-zoom lightbox" title="<?php echo $row2->product_name;?>">
                                                                    <img src="<?php echo base_url(); ?>uploads/product_images/<?php echo $poi->image_filename; ?>" alt="">
                                                                </a>
                                                                <div class="caption text-center">
                                                                    <!--<h6>Other Image <?php echo $i; ?></h6>-->
                                                                    <div class="caption text-center">
                                                                        <h6>
                                                                            <a data-toggle="modal" role="button" href="#modal_edit_other_image" class="btn btn-icon btn-info edit_other_image"  data-id ="<?php echo $poi->product_image_id; ?>"><i class="icon-pencil" title="Change Image"></i></a>

                                                                            <a href="<?php echo base_url(); ?>uploads/product_images/<?php echo $poi->image_filename; ?>" class="btn btn-icon btn-success" download><i class="icon-download" title="Download Image"></i></a>

                                                                            <a onClick="javascript:return confirm('Do you really wish to delete this Image?');" href="javascript:delete_product_image(<?php echo $poi->product_image_id; ?>);" class="btn btn-icon btn-danger"><i class="tip icon-close" title="Delete Image"></i></a>
                                                                        </h6>
                                                                    </div>
                                                                </div>
                                                            <?php endif; ?>
                                                        <?php endif; ?>                                  
                                                    </div>
                                                </div>
                                            </div>
                                            <?php if($i == 4): ?>
                                                <div class="clearfix"></div>
                                            <?php endif; ?>
                                            <?php $i++; ?>
                                        <?php endforeach; ?>

                                        <?php //for($j =$i; $j <= 5; $j++){ ?>
                                            <div class="col-lg-3 col-md-6 col-sm-6">
                                                <div class="block">
                                                    <div class="thumbnail thumbnail-boxed"> 
                                                        <div class="caption text-center">
                                                            <h6>Add Image</h6>
                                                            <div class="caption text-center">
                                                                <h6><a data-toggle="modal" role="button" href="#modal_other_image" class="btn btn-icon btn-success"><i class="icon-plus" title="Add Image"></i></a></h6>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php //} ?>       

                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <div class="pull-left" id="new_product_images_loader" style="display: none;"><i class="icon-spinner3 spin block-inner"></i></div>
                                            <button type="submit" class="btn btn-success"><i class="icon-arrow-right11"></i> Save &amp; and Complete</button>
                                    </div>
                                 </div>                           
                            </form>
                        </div>
                    </div>


                    <!-- Form modal -->
                    <div id="modal_main_image" class="modal fade" tabindex="-1" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title"><i class="icon-image"></i> Change Product Main Image</h4>
                                </div>

                                <!-- Form inside modal -->
                                <form class="validate" method="post" role="form" id="frm_productmainimage" name="frm_productmainimage" onsubmit="return upload_product_main_image();"  enctype="multipart/form-data">

                                    <div class="modal-body with-padding">
                                        <div class="block-inner text-danger">
                                            <h6 class="heading-hr"> <small class="display-block">Browse for the image then click Upload</small></h6>
                                        </div>

                                        <div class="alert alert-danger block-inner" style="display: none;" id="div_product_main_image_error">
                                            <button type="button" class="close" data-dismiss="alert">×</button>
                                                Error
                                        </div>
                                        <div class="alert alert-success block-inner" style="display: none;" id="div_product_main_image_success">
                                            <button type="button" class="close" data-dismiss="alert">×</button>
                                                Error
                                        </div>
                                        <input type="hidden" id="product_main_image_id" name="product_main_image_id" value="<?php echo $row2->product_id; ?>">
                                                
                                         <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label>Main Image</label>
                                                    <input type="file" class="styled form-control" id="product_main_image" name="product_main_image">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <div class="pull-left" id="product_main_image_loader" style="display: none;"><i class="icon-spinner3 spin block-inner"></i></div>
                                        <button type="submit" class="btn btn-success"><i class="icon-upload2"></i> Upload</button>
                                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-close"></i> Close</button>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- /form modal -->

                    <div id="modal_edit_other_image" class="modal fade" tabindex="-1" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title"><i class="icon-image"></i> Change Image</h4>
                                </div>

                                <!-- Form inside modal -->
                                <form class="validate" method="post" role="form" id="frm_producteditotherimage" name="frm_producteditotherimage" onsubmit="return upload_edit_product_other_image();"  enctype="multipart/form-data">

                                    <div class="modal-body with-padding">
                                        <div class="block-inner text-danger">
                                            <h6 class="heading-hr"> <small class="display-block">Browse for the image then click Upload</small></h6>
                                        </div>

                                        <div class="alert alert-danger block-inner" style="display: none;" id="div_product_edit_other_image_error">
                                            <button type="button" class="close" data-dismiss="alert">×</button>
                                                Error
                                        </div>
                                        <div class="alert alert-success block-inner" style="display: none;" id="div_product_edit_other_image_success">
                                            <button type="button" class="close" data-dismiss="alert">×</button>
                                                Error
                                        </div>
                                        <input type="hidden" id="product_edit_other_image_id" name="product_edit_other_image_id" value="">

                                         <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label>&nbsp;</label>
                                                    <input type="file" class="styled form-control" id="product_edit_other_image" name="product_edit_other_image">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <div class="pull-left" id="product_edit_other_image_loader" style="display: none;"><i class="icon-spinner3 spin block-inner"></i></div>
                                        <button type="submit" class="btn btn-success"><i class="icon-upload2"></i> Upload</button>
                                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-close"></i> Close</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>


                    <div id="modal_other_image" class="modal fade" tabindex="-1" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title"><i class="icon-image"></i> Add Product Image</h4>
                                </div>

                                <!-- Form inside modal -->
                                <form class="validate" method="post" role="form" id="frm_productotherimage" name="frm_productotherimage" onsubmit="return upload_product_other_image();">

                                    <div class="modal-body with-padding">
                                        <div class="block-inner text-danger">
                                            <h6 class="heading-hr"> <small class="display-block">Browse for the image then click Upload</small></h6>
                                        </div>

                                        <div class="alert alert-danger block-inner" style="display: none;" id="div_product_other_image_error">
                                            <button type="button" class="close" data-dismiss="alert">×</button>
                                                Error
                                        </div>
                                        <div class="alert alert-success block-inner" style="display: none;" id="div_product_other_image_success">
                                            <button type="button" class="close" data-dismiss="alert">×</button>
                                                Error
                                        </div>
                                        <input type="hidden" id="product_other_image_product_id" name="product_other_image_product_id" value="<?php echo $row2->product_id; ?>">       
                                         <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label>&nbsp;</label>
                                                    <input type="file" class="styled form-control" id="product_other_image" name="product_other_image">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <div class="pull-left" id="product_other_image_loader" style="display: none;"><i class="icon-spinner3 spin block-inner"></i></div>
                                        <button type="submit" class="btn btn-success"><i class="icon-upload2"></i> Upload</button>
                                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-close"></i> Close</button>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                        <!-- /form modal -->
                <?php endforeach; ?>
            <?php endif; ?>



            <!-- Footer -->
            <div class="footer clearfix">
                <div class="pull-left">&copy; <?php echo date('Y');?>. PiddieSmart powered by <a href="http://hypertechsolutions.co.ke">Hypertech Solutions Limited</a></div>
            </div>
            <!-- /footer -->


        </div>
        <!-- /page content -->
