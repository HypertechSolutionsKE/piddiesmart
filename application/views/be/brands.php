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
                    <li class="active">brands</li>
                </ul>
            </div>-->

            <div class="row">
                <div class="col-md-8">
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            <h6 class="panel-title" style="margin-top: 5px"><i class="icon-trophy-star"></i> Brands List</h6>
                            <div class="panel-icons-group">
                                <a data-toggle="modal" role="button" href="#modal_add_brand" class="label btn-success" onclick="return brand_add_clear();"><i class="icon-plus-circle"></i> Add Brand</a>
                            </div>

                        </div>
                        <div class="panel-body">
                            <div id="brands_div">
                                <div class="alert alert-danger block-inner" style="display: none;" id="div_brand_error">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                        Error
                                </div>
                                
                                <div class="alert alert-success block-inner" style="display: none;" id="div_brand_success">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                        Success
                                </div>

                                <script type="text/javascript">
                                    //load_brands();
                                </script>
                                <div class="datatable-tools">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Description</th>
                                                <th>Type</th>
                                                <th>Logo</th>                                          
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($brands as $row): ?>
                                                <tr>
                                                    <td><?php echo $row->brand_name; ?></td>
                                                    <td><?php echo $row->brand_description; ?></td>
                                                    <td><?php echo $row->brand_type; ?></td>
                                                    <td>
                                                      <?php if($row->brand_logo != '' && file_exists("./uploads/brand_logos/" . $row->brand_logo)): ?>
                                                          <img class="table-image" src="<?php echo base_url();?>uploads/brand_logos/<?php echo $row->brand_logo; ?>" alt="">
                                                      <?php endif; ?>
                                                    </td>         
                                                    <td>
                                                        <a data-toggle="modal" role="button" href="#modal_edit_brand" onclick="return brand_edit_load(<?php echo $row->brand_id;?>);" class="label label-success btn-icon"><i class="icon-pencil"></i></a>
                                                        <a onClick="javascript:return confirm('Do you really wish to delete this Brand?');" href="javascript:delete_brand(<?php echo $row->brand_id; ?>);" class="label label-danger btn-icon"><i class="icon-remove3"></i></a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                                

                            </div>
                        </div> 
                    </div>                           
                </div>
            </div>

            <!-- Form modal -->
            <div id="modal_add_brand" class="modal fade" tabindex="-1" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title"><i class="icon-plus-circle"></i> New Brand</h4>
                        </div>

                        <!-- Form inside modal -->
                        <form class="validate" method="post" role="form" id="frm_addbrand" name="frm_addbrand" onsubmit="return save_brand();" enctype='multipart/form-data'>

                            <div class="modal-body with-padding">
                                <div class="block-inner text-danger">
                                    <h6 class="heading-hr"> <small class="display-block">Please fill in the required information and click Save</small></h6>
                                </div>

                                <div class="alert alert-danger block-inner" style="display: none;" id="div_add_brand_error">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                        Error
                                </div>
                                
                                <div class="alert alert-success block-inner" style="display: none;" id="div_add_brand_success">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                        Error
                                </div>

                                 <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <label>Brand Name *</label>
                                            <input type="text" id="add_brand_name" name="brand_name" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <label>Brand Category *</label>

                                            <select data-placeholder="Select Category..." class="clear-results" tabindex="2" id="add_brand_type" name="brand_type">
                                                <option value=""></option>
                                                <option value="Clothing">Clothing</option>
                                                <option value="Cosmetics">Cosmetics</option>              
                                                <option value="Sound">Sound</option>
                                            </select> 
                                        </div>
                                    </div>
                                </div>

                                 <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <label class="control-label">Brand Description</label>
                                            <textarea class="form-control" name="brand_description" id="add_brand_description"></textarea>
                                        </div>
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <label>Brand Logo</label>
                                            <input type="file" class="styled form-control" id="add_brand_logo" name="brand_logo">
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="modal-footer">
                                <div class="pull-left" id="add_brand_loader" style="display: none;"><i class="icon-spinner3 spin block-inner"></i></div>
                                <button type="submit" class="btn btn-success"><i class="icon-disk"></i> Save</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-close"></i> Close</button>

                            </div>

                        </form>
                    </div>
                </div>
            </div>
            <!-- /form modal -->
            <!-- Form modal -->
            <div id="modal_edit_brand" class="modal fade" tabindex="-1" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title"><i class="icon-pencil"></i> Edit Brand</h4>
                        </div>

                        <!-- Form inside modal -->
                        <form class="validate" method="post" role="form" id="frm_editbrand" name="frm_editbrand" onsubmit="return update_brand();" enctype='multipart/form-data'>

                            <div class="modal-body with-padding">
                                <div class="block-inner text-danger">
                                    <h6 class="heading-hr"> <small class="display-block">Please fill in the required information and click Update</small></h6>
                                </div>

                                <div class="row">
                                    <div class="col-sm-2">
                                        <div class="block">
                                            <div class="thumbnail">
                                                <div class="thumb">                                      
                                                    <img id="img_brand_logo" src="<?php echo base_url();?>assets/be/images/demo/users/avi-1.png" alt="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="alert alert-danger block-inner" style="display: none;" id="div_edit_brand_error">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                        Error
                                </div>
                                
                                <div class="alert alert-success block-inner" style="display: none;" id="div_edit_brand_success">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                        Error
                                </div>
                                <input type="hidden" id="edit_brand_id" name="brand_id" class="form-control">

                                 <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <label>Brand Name *</label>
                                            <input type="text" id="edit_brand_name" name="brand_name" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <label>Brand Category *</label>
                                            <select data-placeholder="Select Category..." class="clear-results" tabindex="2" id="edit_brand_type" name="brand_type">
                                                <option value=""></option>
                                                <option value="Clothing">Clothing</option>
                                                <option value="Cosmetics">Cosmetics</option>              
                                                <option value="Sound">Sound</option>
                                            </select> 
                                        </div>
                                    </div>
                                </div>

                                 <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <label class="control-label">Brand Description</label>
                                            <textarea class="form-control" name="brand_description" id="edit_brand_description"></textarea>
                                        </div>
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <label>Brand Logo</label>
                                            <input type="file" class="styled form-control" id="edit_brand_logo" name="brand_logo">
                                        </div>
                                    </div>
                                </div>                                 

                            </div>

                            <div class="modal-footer">
                                <div class="pull-left" id="edit_brand_loader" style="display: none;"><i class="icon-spinner3 spin block-inner"></i></div>
                                <button type="submit" class="btn btn-success"><i class="icon-disk"></i> Update</button>
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
