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
                    <li class="active">customers</li>
                </ul>
            </div>-->

            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            <h6 class="panel-title" style="margin-top: 5px"><i class="icon-address-book"></i> Customers List</h6>
                            <div class="panel-icons-group">
                                <a data-toggle="modal" role="button" href="#modal_add_customer" class="label btn-success" onclick="return customer_add_clear();"><i class="icon-plus-circle"></i> Add Customer</a>
                            </div>

                        </div>
                        <div class="panel-body">
                            <div id="customers_div">
                                <div class="alert alert-danger block-inner" style="display: none;" id="div_customer_error">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                        Error
                                </div>
                                
                                <div class="alert alert-success block-inner" style="display: none;" id="div_customer_success">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                        Success
                                </div>

                                <script type="text/javascript">
                                    //load_customers();
                                </script>
                                <div class="datatable-tools">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Gender</th>
                                                <th>Country</th>
                                                <th>Town</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($customers as $row): ?>
                                                <tr>
                                                    <td><?php echo $row->first_name . ' ' . $row->last_name; ?></td>
                                                    <td><?php echo $row->email_address; ?></td>
                                                    <td><?php echo $row->phone_number; ?></td>
                                                    <td><?php echo $row->gender; ?></td>
                                                    <td><?php echo $row->country_name; ?></td>
                                                    <td><?php echo $row->town_name; ?></td>
                                                    <td>
                                                        <a data-toggle="modal" role="button" href="#modal_edit_customer" onclick="return customer_edit_load(<?php echo $row->customer_id;?>);" class="label label-success btn-icon"><i class="icon-pencil" title="Edit Customer"></i></a>
                                                        <a data-toggle="modal" role="button" href="#modal_change_customer_password" onclick="return change_customer_password_load(<?php echo $row->customer_id;?>);" class="label label-success btn-icon"><i class="icon-eye-blocked2" title="Change Customer Password"></i></a>
                                                        <a onClick="javascript:return confirm('Do you really wish to delete this customer?');" href="javascript:delete_customer(<?php echo $row->customer_id; ?>);" class="label label-danger btn-icon"><i class="icon-remove3" title="Delete Customer"></i></a>
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
            <div id="modal_add_customer" class="modal fade" tabindex="-1" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title"><i class="icon-plus-circle"></i> New Customer</h4>
                        </div>

                        <!-- Form inside modal -->
                        <form class="validate" method="post" role="form" id="frm_addcustomer" name="frm_addcustomer" onsubmit="return save_customer();">

                            <div class="modal-body with-padding">
                                <div class="block-inner text-danger">
                                    <h6 class="heading-hr"> <small class="display-block">Please fill in the required information and click Save</small></h6>
                                </div>

                                <div class="alert alert-danger block-inner" style="display: none;" id="div_add_customer_error">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                        Error
                                </div>
                                
                                <div class="alert alert-success block-inner" style="display: none;" id="div_add_customer_success">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                        Error
                                </div>

                                 <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label>First Name*</label>
                                            <input type="text" id="add_first_name" name="first_name" class="form-control">
                                        </div>
                                        <div class="col-sm-4">
                                            <label>Last Name*</label>
                                            <input type="text" id="add_last_name" name="last_name" class="form-control">
                                        </div>
                                        <div class="col-sm-4">
                                            <label>Phone*</label>
                                            <input type="text" id="add_phone_number" name="phone_number" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label>Email Address*</label>
                                            <input type="text" id="add_email_address" name="email_address" class="form-control">
                                        </div>                                 
                                        <div class="col-sm-4">
                                            <label>Password*</label>
                                            <input type="password" id="add_password" name="password" class="form-control">
                                        </div>
                                        <div class="col-sm-4">
                                            <label>Confirm Password*</label>
                                            <input type="password" id="add_confirm_password" name="confirm_password" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label>Gender</label>

                                            <select data-placeholder="Select Gender..." class="clear-results" tabindex="2" id="add_gender" name="gender">
                                                <option value=""></option>
                                                <option value="Female">Female</option>
                                                <option value="Male">Male</option>              
                                            </select> 
                                        </div>
                                        <div class="col-sm-4">
                                            <label>Country</label>

                                            <select data-placeholder="Select country..." class="clear-results" tabindex="2" id="add_country_id" name="country_id">
                                                <option value=""></option>
                                                <?php foreach($countries as $row): ?>
                                                    <option value="<?php echo $row->country_id; ?>"><?php echo $row->country_name; ?></option>
                                                <?php endforeach; ?>
                                            </select> 
                                        </div>
                                        <div class="col-sm-4">
                                            <label>Town</label>

                                            <select data-placeholder="Select Town..." class="clear-results" tabindex="2" id="add_town_id" name="town_id">
                                                <option value=""></option>
                                                <?php foreach($towns as $row): ?>
                                                    <option value="<?php echo $row->town_id; ?>"><?php echo $row->town_name; ?></option>
                                                <?php endforeach; ?>
               
                                            </select> 
                                        </div>


                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <div class="pull-left" id="add_customer_loader" style="display: none;"><i class="icon-spinner3 spin block-inner"></i></div>
                                <button type="submit" class="btn btn-success"><i class="icon-disk"></i> Save</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-close"></i> Close</button>

                            </div>

                        </form>
                    </div>
                </div>
            </div>
            <!-- /form modal -->
            <!-- Form modal -->
            <div id="modal_edit_customer" class="modal fade" tabindex="-1" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title"><i class="icon-pencil"></i> Edit Customer</h4>
                        </div>

                        <!-- Form inside modal -->
                        <form class="validate" method="post" role="form" id="frm_editcustomer" name="frm_editcustomer" onsubmit="return update_customer();">

                            <div class="modal-body with-padding">
                                <div class="block-inner text-danger">
                                    <h6 class="heading-hr"> <small class="display-block">Please fill in the required information and click Save</small></h6>
                                </div>

                                <div class="alert alert-danger block-inner" style="display: none;" id="div_edit_customer_error">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                        Error
                                </div>
                                <input type="hidden" id="edit_customer_id" name="customer_id">
                                <div class="alert alert-success block-inner" style="display: none;" id="div_edit_customer_success">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                        Error
                                </div>

                                 <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label>First Name*</label>
                                            <input type="text" id="edit_first_name" name="first_name" class="form-control">
                                        </div>
                                        <div class="col-sm-4">
                                            <label>Last Name*</label>
                                            <input type="text" id="edit_last_name" name="last_name" class="form-control">
                                        </div>
                                        <div class="col-sm-4">
                                            <label>Phone*</label>
                                            <input type="text" id="edit_phone_number" name="phone_number" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <label>Email Address*</label>
                                            <input type="text" id="edit_email_address" name="email_address" class="form-control">
                                        </div> 
                                    </div>                                
                                </div>
                                 <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label>Gender</label>

                                            <select data-placeholder="Select Gender..." class="clear-results" tabindex="2" id="edit_gender" name="gender">
                                                <option value=""></option>
                                                <option value="Female">Female</option>
                                                <option value="Male">Male</option>              
                                            </select> 
                                        </div>
                                        <div class="col-sm-4">
                                            <label>Country</label>

                                            <select data-placeholder="Select Country..." class="clear-results" tabindex="2" id="edit_country_id" name="country_id">
                                                <option value=""></option>
                                                <?php foreach($countries as $row): ?>
                                                    <option value="<?php echo $row->country_id; ?>"><?php echo $row->country_name; ?></option>
                                                <?php endforeach; ?>
                                            </select> 
                                        </div>
                                        <div class="col-sm-4">
                                            <label>Town</label>

                                            <select data-placeholder="Select Town..." class="clear-results" tabindex="2" id="edit_town_id" name="town_id">
                                                <option value=""></option>
                                                <?php foreach($towns as $row): ?>
                                                    <option value="<?php echo $row->town_id; ?>"><?php echo $row->town_name; ?></option>
                                                <?php endforeach; ?>
               
                                            </select> 
                                        </div>


                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <div class="pull-left" id="edit_customer_loader" style="display: none;"><i class="icon-spinner3 spin block-inner"></i></div>
                                <button type="submit" class="btn btn-success"><i class="icon-disk"></i> Save</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-close"></i> Close</button>

                            </div>

                        </form>
                    </div>
                </div>
            </div>
            <!-- /form modal -->

            <!-- Form modal -->
            <div id="modal_change_customer_password" class="modal fade" tabindex="-1" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title"><i class="icon-pencil"></i> Change Customer Password</h4>
                        </div>

                        <!-- Form inside modal -->
                        <form class="validate" method="post" role="form" id="frm_changecustomerpassword" name="frm_changecustomerpassword" onsubmit="return change_customer_password();">

                            <div class="modal-body with-padding">
                                <div class="block-inner text-danger">
                                    <h6 class="heading-hr"> <small class="display-block">Enter the customer's New Password then click Update</small></h6>
                                </div>

                                <div class="alert alert-danger block-inner" style="display: none;" id="div_change_customer_password_error">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                        Error
                                </div>
                                <div class="alert alert-success block-inner" style="display: none;" id="div_change_customer_password_success">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                        Error
                                </div>
                                <input type="hidden" id="password_customer_id" name="password_customer_id" value="">
                                        
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <label>New Password *</label>
                                            <input type="password" id="new_password" name="new_password" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <label>Confirm Password *</label>
                                            <input type="password" id="confirm_password" name="confirm_password" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <div class="pull-left" id="change_customer_password_loader" style="display: none;"><i class="icon-spinner3 spin block-inner"></i></div>
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
