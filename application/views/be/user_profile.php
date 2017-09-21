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
            <?php foreach ($system_user as $row): ?>
                <div class="row">
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-3">

                                <div class="block">
                                    <div class="thumbnail">
                                        <div class="thumb">
                                            <?php if (file_exists("./uploads/profile_pictures/" . $row->profile_picture)): ?>
                                                <img src="<?php echo base_url(); ?>uploads/profile_pictures/<?php echo $row->profile_picture; ?>" alt="">
                                            <?php else: ?>
                                                <img src="<?php echo base_url();?>assets/be/images/demo/users/avi-1.png" alt="">
                                            <?php endif; ?>
                                        </div>
                                    
                                        <div class="caption text-center">
                                            <h6><a data-toggle="modal" role="button" href="#modal_change_profile_picture" class="badge btn-success">Change Profile Picture</a></h6>
                                        </div>
                                    </div>
                                </div>

                                <ul class="nav nav-list">
                                    <li class="nav-header">My Profile <i class="icon-user"></i></li>
                                    <li><a href="<?php echo base_url();?>be/system_users/profile/<?php echo $row->user_id; ?>"><b>Profile Information</b></a></li>
                                    <li><a data-toggle="modal" role="button" href="#modal_change_user_password" onclick="return change_user_password_load();"><b>Change Password</b></a></li>
                                </ul>

                            </div>

                            <div class="col-md-9">

                                <!-- Form inside modal -->
                                <form class="validate" method="post" role="form" id="frm_editsystemuser" name="frm_editsystemuser" onsubmit="return update_user_profile();">

                                    <div class="with-padding">
                                        <div class="block-inner text-danger">
                                            <h6 class="heading-hr"><i class="icon-profile"></i> Profile information:</h6>
                                        </div>

                                        <div class="alert alert-danger block-inner" style="display: none;" id="div_edit_system_user_error">
                                            <button type="button" class="close" data-dismiss="alert">×</button>
                                                Error
                                        </div>
                                        
                                        <div class="alert alert-success block-inner" style="display: none;" id="div_edit_system_user_success">
                                            <button type="button" class="close" data-dismiss="alert">×</button>
                                                Error
                                        </div>

                                        <input type="hidden" id="edit_user_id" name="user_id" value="<?php echo $row->user_id; ?>">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <label>First Name*</label>
                                                    <input type="text" id="edit_first_name" name="first_name" class="form-control" value="<?php echo $row->first_name; ?>">
                                                </div>
                                                <div class="col-sm-6">
                                                    <label>Last Name*</label>
                                                    <input type="text" id="edit_last_name" name="last_name" class="form-control" value="<?php echo $row->last_name; ?>">
                                                </div>
                                            </div>
                                        </div>
                                         <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <label>Phone</label>
                                                    <input type="text" id="edit_phone_number" name="phone_number" class="form-control" value="<?php echo $row->phone_number; ?>">
                                                </div>
                                                <div class="col-sm-6">
                                                    <label>Email Address*</label>
                                                    <input type="text" id="edit_email_address" name="email_address" class="form-control" value="<?php echo $row->email_address; ?>">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <label>Gender</label>

                                                    <select data-placeholder="Select Gender..." class="clear-results" tabindex="2" id="edit_gender" name="gender">
                                                        <option value=""></option>
                                                        <option value="Female" <?php if ($row->gender == 'Female'){echo 'selected';} ?>>Female</option>
                                                        <option value="Male" <?php if ($row->gender == 'Male'){echo 'selected';} ?>>Male</option>              
                                                    </select> 
                                                </div>
                                                <div class="col-sm-6">
                                                    <label>Department</label>

                                                    <select data-placeholder="Select Department..." class="clear-results" tabindex="2" id="edit_department_id" name="department_id">
                                                        <option value=""></option>
                                                        <?php foreach($departments as $row2): ?>
                                                            <option value="<?php echo $row2->department_id; ?>" <?php if ($row2->department_id == $row->department_id){echo 'selected';} ?>><?php echo $row2->department_name; ?></option>
                                                        <?php endforeach; ?>
                                                    </select> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <label>Access Level*</label>

                                                    <select data-placeholder="Select Access Level..." class="clear-results" tabindex="2" id="edit_access_level_id" name="access_level_id">
                                                        <option value=""></option>
                                                        <?php foreach($access_levels as $row2): ?>
                                                            <option value="<?php echo $row2->access_level_id; ?>" <?php if ($row2->access_level_id == $row->access_level_id){echo 'selected';} ?>><?php echo $row2->access_level_name; ?></option>
                                                        <?php endforeach; ?>                       
                                                    </select> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="pull-left" id="edit_system_user_loader" style="display: none;">
                                                        <i class="icon-spinner3 spin block-inner"></i>
                                                    </div>
                                                    <button type="submit" class="btn btn-success pull-right"><i class="icon-disk"></i> Update Profile</button>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


            <!-- Form modal -->
            <div id="modal_change_user_password" class="modal fade" tabindex="-1" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title"><i class="icon-pencil"></i> Change Password</h4>
                        </div>

                        <!-- Form inside modal -->
                        <form class="validate" method="post" role="form" id="frm_changeuserpassword" name="frm_changeuserpassword" onsubmit="return change_user_password();">

                            <div class="modal-body with-padding">
                                <div class="block-inner text-danger">
                                    <h6 class="heading-hr"> <small class="display-block">Enter your Old Password and New Password then click Update</small></h6>
                                </div>

                                <div class="alert alert-danger block-inner" style="display: none;" id="div_change_user_password_error">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                        Error
                                </div>
                                <div class="alert alert-success block-inner" style="display: none;" id="div_change_user_password_success">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                        Error
                                </div>
                                <input type="hidden" id="password_user_id" name="password_user_id" value="<?php echo $row->user_id; ?>">
                                        
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <label>Old Password *</label>
                                            <input type="password" id="old_password" name="old_password" class="form-control">
                                        </div>
                                    </div>
                                </div>
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
                                <div class="pull-left" id="change_user_password_loader" style="display: none;"><i class="icon-spinner3 spin block-inner"></i></div>
                                <button type="submit" class="btn btn-success"><i class="icon-disk"></i> Update</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-close"></i> Close</button>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /form modal -->

            <!-- Form modal -->
            <div id="modal_change_profile_picture" class="modal fade" tabindex="-1" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title"><i class="icon-user"></i> Change Profile Picture</h4>
                        </div>

                        <!-- Form inside modal -->
                        <form class="validate" method="post" role="form" id="frm_changeprofilepicture" name="frm_changeprofilepicture" onsubmit="return change_profile_picture();">

                            <div class="modal-body with-padding">
                                <div class="block-inner text-danger">
                                    <h6 class="heading-hr"> <small class="display-block">Browse for your Profile Picture then click Update</small></h6>
                                </div>

                                <div class="alert alert-danger block-inner" style="display: none;" id="div_change_profile_picture_error">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                        Error
                                </div>
                                <div class="alert alert-success block-inner" style="display: none;" id="div_change_profile_picture_success">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                        Error
                                </div>
                                <input type="hidden" id="profile_picture_user_id" name="profile_picture_user_id" value="<?php echo $row->user_id; ?>">
                                        
                                 <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <label>Profile Picture</label>
                                            <input type="file" class="styled form-control" id="profile_picture" name="profile_picture">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <div class="pull-left" id="change_profile_picture_loader" style="display: none;"><i class="icon-spinner3 spin block-inner"></i></div>
                                <button type="submit" class="btn btn-success"><i class="icon-disk"></i> Update</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-close"></i> Close</button>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /form modal -->




            <?php endforeach; ?>



            <!-- Footer -->
            <div class="footer clearfix">
                <div class="pull-left">&copy; <?php echo date('Y');?>. PiddieSmart powered by <a href="http://hypertechsolutions.co.ke">Hypertech Solutions Limited</a></div>
            </div>
            <!-- /footer -->


        </div>
        <!-- /page content -->
