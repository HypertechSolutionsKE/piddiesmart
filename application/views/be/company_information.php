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

            <div class="row">
                <div class="col-md-12   ">
                    <!-- Form inside modal -->
                    <?php if ($company_information_exists == true): ?>
                        <?php foreach($company_information as $row): ?>
                            <div class="row">
                                <div class="col-md-2">

                                    <div class="block">
                                        <div class="thumbnail">
                                            <div class="thumb">
                                                <?php if ($row->company_logo != ''): ?>
                                                    <?php if (file_exists("./uploads/company_logos/" . $row->company_logo)): ?>
                                                        <img src="<?php echo base_url(); ?>uploads/company_logos/<?php echo $row->company_logo; ?>" alt="">
                                                    <?php else: ?>
                                                        <img src="<?php echo base_url();?>assets/be/images/demo/images/logo.png" alt="">
                                                    <?php endif; ?>
                                                <?php else: ?>
                                                    <img src="<?php echo base_url();?>assets/be/images/demo/images/logo.png" alt="">
                                                <?php endif; ?>
                                            </div>
                                        
                                            <div class="caption text-center">
                                                <h6><a data-toggle="modal" role="button" href="#modal_change_company_logo" class="badge btn-success">Change Company Logo</a></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <form class="form-horizontal" method="post" role="form" id="frm_companyinformation" name="frm_companyinformation" onsubmit="return save_company_information();" enctype="multipart/form-data">

                                        <div class="">
                                            <div class="with-padding">
                                                <div class="block-inner text-danger">
                                                    <h6 class="heading-hr">Company Information<small class="display-block">Please fill in the required information and click Update</small></h6>
                                                </div>

                                                <div class="alert alert-danger block-inner" style="display: none;" id="div_company_information_error">
                                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                                    Error
                                                </div>
                                                    
                                                <div class="alert alert-success block-inner" style="display: none;" id="div_company_information_success">
                                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                                    Error
                                                </div>

                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <label>Company Name*</label>
                                                            <input type="text" id="company_name" name="company_name" class="form-control" value="<?php echo $row->company_name; ?>">
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <label>Phone*</label>
                                                            <input type="text" id="phone_number" name="phone_number" class="form-control" value="<?php echo $row->phone_number; ?>">
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <label>Mobile</label>
                                                            <input type="text" id="mobile_number" name="mobile_number" class="form-control" value="<?php echo $row->mobile_number; ?>">
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <label>Company Tagline</label>
                                                            <textarea class="form-control" name="company_tagline" id="company_tagline"><?php echo $row->company_tagline; ?></textarea>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <label>Email</label>
                                                            <input type="text" id="email_address" name="email_address" class="form-control" value="<?php echo $row->email_address; ?>">
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <label>Website</label>
                                                            <input type="text" id="website" name="website" class="form-control" value="<?php echo $row->website; ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <label>Fax No.</label>
                                                            <input type="text" id="fax_number" name="fax_number" class="form-control" value="<?php echo $row->fax_number; ?>">
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <label>Postal Address</label>
                                                            <input type="text" id="postal_address" name="postal_address" class="form-control" value="<?php echo $row->postal_address; ?>">
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <label>ZIP Code</label>
                                                            <input type="text" id="zip_code" name="zip_code" class="form-control" value="<?php echo $row->zip_code; ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <label>City</label>
                                                            <input type="text" id="city" name="city" class="form-control" value="<?php echo $row->city; ?>">
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <label>Country</label>
                                                            <input type="text" id="country" name="country" class="form-control" value="<?php echo $row->country; ?>">
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <label>PIN No</label>
                                                            <input type="text" id="pin_number" name="pin_number" class="form-control" value="<?php echo $row->pin_number; ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <label>VAT No</label>
                                                            <input type="text" id="vat_number" name="vat_number" class="form-control" value="<?php echo $row->vat_number; ?>">
                                                        </div>
                                                        <!--<div class="col-sm-8">
                                                            <label>Company Logo</label>
                                                            <input type="file" id="company_logo" name="company_logo" class="form-control">
                                                        </div>-->
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="pull-left" id="company_information_loader" style="display: none;"><i class="icon-spinner3 spin block-inner"></i></div>
                                                            <button type="submit" class="btn btn-success pull-right"><i class="icon-disk"></i> Update</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                         </div>                           
                                    </form>
                                </div>
                            </div> 
                            <!-- Form modal -->
                            <div id="modal_change_company_logo" class="modal fade" tabindex="-1" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title"><i class="icon-image"></i> Change Company Logo</h4>
                                        </div>

                                        <!-- Form inside modal -->
                                        <form class="validate" method="post" role="form" id="frm_changecompanylogo" name="frm_changecompanylogo" onsubmit="return change_company_logo();">

                                            <div class="modal-body with-padding">
                                                <div class="block-inner text-danger">
                                                    <h6 class="heading-hr"> <small class="display-block">Browse for your Company Logo then click Update</small></h6>
                                                </div>

                                                <div class="alert alert-danger block-inner" style="display: none;" id="div_change_company_logo_error">
                                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                                        Error
                                                </div>
                                                <div class="alert alert-success block-inner" style="display: none;" id="div_change_company_logo_success">
                                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                                        Error
                                                </div>                                                       
                                                 <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <label>Company Logo</label>
                                                            <input type="file" class="styled form-control" id="company_logo" name="company_logo">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <div class="pull-left" id="change_company_logo_loader" style="display: none;"><i class="icon-spinner3 spin block-inner"></i></div>
                                                <button type="submit" class="btn btn-success"><i class="icon-disk"></i> Update</button>
                                                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-close"></i> Close</button>

                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- /form modal -->
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="row">
                            <div class="col-md-9">                        
                                <form class="validate" method="post" role="form" id="frm_companyinformation" name="frm_companyinformation" onsubmit="return save_company_information();" enctype="multipart/form-data">

                                    <div class="panel panel-danger">
                                        <div class="panel-heading">
                                            <h6 class="panel-title" style="margin-top: 5px"><i class="icon-info"></i> Company Information</h6>
                                        </div>
                                        <div class="panel-body">
                                            <div class="block-inner text-danger">
                                                <h6 class="heading-hr"> <small class="display-block">Please fill in the required information and click Save</small></h6>
                                            </div>

                                            <div class="alert alert-danger block-inner" style="display: none;" id="div_company_information_error">
                                                <button type="button" class="close" data-dismiss="alert">×</button>
                                                Error
                                            </div>
                                                
                                            <div class="alert alert-success block-inner" style="display: none;" id="div_company_information_success">
                                                <button type="button" class="close" data-dismiss="alert">×</button>
                                                Error
                                            </div>

                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <label>Company Name*</label>
                                                        <input type="text" id="company_name" name="company_name" class="form-control">
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label>Phone*</label>
                                                        <input type="text" id="phone_number" name="phone_number" class="form-control">
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label>Mobile</label>
                                                        <input type="text" id="mobile_number" name="mobile_number" class="form-control">
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <label>Company Tagline</label>
                                                        <textarea class="form-control" name="company_tagline" id="company_tagline"></textarea>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label>Email</label>
                                                        <input type="text" id="email_address" name="email_address" class="form-control">
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label>Website</label>
                                                        <input type="text" id="website" name="website" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <label>Fax No.</label>
                                                        <input type="text" id="fax_number" name="fax_number" class="form-control">
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label>Postal Address</label>
                                                        <input type="text" id="postal_address" name="postal_address" class="form-control">
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label>ZIP Code</label>
                                                        <input type="text" id="zip_code" name="zip_code" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <label>City</label>
                                                        <input type="text" id="city" name="city" class="form-control">
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label>Country</label>
                                                        <input type="text" id="country" name="country" class="form-control">
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label>PIN No</label>
                                                        <input type="text" id="pin_number" name="pin_number" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <label>VAT No</label>
                                                        <input type="text" id="vat_number" name="vat_number" class="form-control">
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <label>Company Logo</label>
                                                        <input type="file" class="styled form-control" id="company_logo" name="company_logo">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <div class="pull-left" id="company_information_loader" style="display: none;"><i class="icon-spinner3 spin block-inner"></i></div>
                                            <button type="submit" class="btn btn-success"><i class="icon-disk"></i> Save</button>
                                        </div>

                                     </div>                           
                                </form>
                            </div>
                        </div>


                    <?php endif; ?>

                </div>
            </div>



            <!-- Footer -->
            <div class="footer clearfix">
                <div class="pull-left">&copy; <?php echo date('Y');?>. PiddieSmart powered by <a href="http://hypertechsolutions.co.ke">Hypertech Solutions Limited</a></div>
            </div>
            <!-- /footer -->


        </div>
        <!-- /page content -->
