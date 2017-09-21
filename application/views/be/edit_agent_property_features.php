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
                            <form class="validate" method="post" role="form" id="frm_newpropertyfeatures" name="frm_newpropertyfeatures" onsubmit="return update_agent_property_features();" enctype="multipart/form-data">

                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <h6 class="panel-title" style="margin-top: 5px"><i class="icon-user4"></i> Edit Agent Property</h6>
                                    </div>
                                    <div class="panel-body">
                                        <ul class="nav nav-pills nav-justified">
                                            <li class="bg-succ"><a href="<?php echo base_url();?>be/properties/edit_agent_start/<?php echo $row2->property_id; ?>">Step 1: Basic Info</a></li>
                                            <li class="active"><a href="<?php echo base_url();?>be/properties/edit_agent_features/<?php echo $row2->property_id; ?>">Step 2: Property Features</a></li>
                                            <li class="bg-succ"><a href="<?php echo base_url();?>be/properties/edit_agent_contacts/<?php echo $row2->property_id; ?>">Step 3: Contact Details</a></li>
                                            <li class="bg-succ"><a href="<?php echo base_url();?>be/properties/edit_agent_attachments/<?php echo $row2->property_id; ?>">Step 4: Attachments &amp; Publish</a></li>                                        
                                        </ul>
                                        <div class="clearfix"></div>
                                        <hr>

                                        <!--<div class="block-inner text-danger">
                                            <h6 class="heading-hr">Step 2: Property Features <small class="display-block">Please fill in the property features and click 'Next'</small></h6>
                                        </div>-->

                                        <div class="alert alert-danger fade in block-inner" style="display: none;" id="div_new_property_features_error">
                                            <button type="button" class="close" data-dismiss="alert">×</button>
                                            Error
                                        </div>
                                        
                                        <div class="alert alert-success block-inner" style="display: none;" id="div_new_property_features_success">
                                            <button type="button" class="close" data-dismiss="alert">×</button>
                                            Error
                                        </div>
                                        <input type="hidden" name="property_id" id="property_id" value="<?php echo $row2->property_id; ?>">
                                        <?php foreach ($property_type as $row): ?>
                                            <?php if ($row->is_bedrooms == 1): ?>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-sm-7">
                                                            <label>Bedrooms *&nbsp;&nbsp;<a data-placement="top" class="tip" title="How many bedrooms does your property have?"><i class="icon-question2"></i></a></label>
                                                            <input type="number" id="bedrooms" name="bedrooms" class="form-control" value="<?php echo $row2->bedrooms;  ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                            <?php if ($row->is_bathrooms == 1): ?>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-sm-7">
                                                            <label>Bathrooms *&nbsp;&nbsp;<a data-placement="top" class="tip" title="How many bathrooms does your property have?"><i class="icon-question2"></i></a></label>
                                                            <input type="number" id="bathrooms" name="bathrooms" class="form-control" value="<?php echo $row2->bathrooms;  ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                            <?php if ($row->is_total_rooms == 1): ?>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-sm-7">
                                                            <label>Total Rooms&nbsp;&nbsp;<a data-placement="top" class="tip" title="How many rooms in total does your property have?"><i class="icon-question2"></i></a></label>
                                                            <input type="number" id="total_rooms" name="total_rooms" class="form-control" value="<?php echo $row2->total_rooms;  ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                            <?php if ($row->is_living_area == 1): ?>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-sm-7">
                                                            <label>Living Area (m<sup>2</sup>) *&nbsp;&nbsp;<a data-placement="top" class="tip" title="How large are all rooms of your property in total?"><i class="icon-question2"></i></a></label>
                                                            <input type="number" id="living_area" name="living_area" class="form-control" value="<?php echo $row2->living_area;  ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                            <?php if ($row->is_floor == 1): ?>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-sm-7">
                                                            <label>Floor&nbsp;&nbsp;<a data-placement="top" class="tip" title="On which floor is your property located?"><i class="icon-question2"></i></a></label>
                                                            <input type="text" id="floor" name="floor" class="form-control" value="<?php echo $row2->floor;  ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                            <?php if ($row->is_total_floors == 1): ?>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-sm-7">
                                                            <label>Total Floors&nbsp;&nbsp;<a data-placement="top" class="tip" title="How many floors does your property have in total?"><i class="icon-question2"></i></a></label>
                                                            <input type="number" id="total_floors" name="total_floors" class="form-control" value="<?php echo $row2->total_floors;  ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                            <?php if ($row->is_land_size == 1): ?>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-sm-7">
                                                            <label>Land Size (m<sup>2</sup>) *&nbsp;&nbsp;<a data-placement="top" class="tip" title="How large is your property size?"><i class="icon-question2"></i></a></label>
                                                            <input type="number" id="land_size" name="land_size" class="form-control" value="<?php echo $row2->land_size;  ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                            <?php if ($row->is_building_size == 1): ?>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-sm-7">
                                                            <label>Building Size (m<sup>2</sup>) *&nbsp;&nbsp;<a data-placement="top" class="tip" title="How large is your property building size?"><i class="icon-question2"></i></a></label>
                                                            <input type="number" id="building_size" name="building_size" class="form-control" value="<?php echo $row2->building_size;  ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                        <hr>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-7">
                                                    <label>Description *&nbsp;&nbsp;<a data-placement="top" class="tip" title="Description of your property"><i class="icon-question2"></i></a></label>
                                                    <textarea id="description" name="description" class="form-control"><?php echo $row2->description;  ?></textarea>
                                                </div>
                                                <div class="col-sm-5">
                                                    <small>Describe your property to inform users, build their trust, and answer their questions. Don't forget information on Property condition and facilities Location and neighbourhood
                                                    <br>Provide detailed, easy-to-read information on notable features or a good story associated with the property.</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-7">
                                                    <label>Available From&nbsp;&nbsp;<a data-placement="top" class="tip" title="When is your property availabe?"><i class="icon-question2"></i></a></label>
                                                    <input type="text" id="available_from" name="available_from" class="form-control" value="<?php echo $row2->available_from;  ?>">
                                                </div>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-7">
                                                    <label>Build (Year)&nbsp;&nbsp;<a data-placement="top" class="tip" title="When was the property built?"><i class="icon-question2"></i></a></label>
                                                    <input type="number" id="build_year" name="build_year" class="form-control" value="<?php echo $row2->build_year;  ?>">
                                                </div>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-7">
                                                    <label>Car Spaces&nbsp;&nbsp;<a data-placement="top" class="tip" title="How many parking slots / car spaces belong to your property?    "><i class="icon-question2"></i></a></label>
                                                    <input type="number" id="car_spaces" name="car_spaces" class="form-control" value="<?php echo $row2->car_spaces;  ?>">
                                                </div>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-7">
                                                    <label>Fully Furnished&nbsp;&nbsp;<a data-placement="top" class="tip" title="Is your property furnished and ready to move in?"><i class="icon-question2"></i></a></label>
                                                    <select data-placeholder="Please Choose..." class="clear-results" tabindex="2" id="fully_furnished" name="fully_furnished">
                                                        <option value=""></option>
                                                        <option value="Yes" <?php if($row2->fully_furnished == 'Yes'){echo 'selected';}  ?>>Yes</option>
                                                        <option value="No" <?php if($row2->fully_furnished == 'No'){echo 'selected';}  ?>>No</option>                               
                                                    </select> 
                                                </div>

                                            </div>
                                        </div>
                                        <div class="panel panel-default">
                                            <div class="panel-heading"><h6 class="panel-title">More Features</h6></div>
                                            <div class="panel-body">
                                                <?php //foreach ($property_feature_types as $row): ?>
                                                    <p class="text-danger" style="font-weight: bold;"><?php //echo $row->property_feature_type_name; ?></p>
                                                    <div class="block-inner">
                                                        <?php foreach ($property_features as $row3): ?>
                                                            <?php //if ($row->property_feature_type_id == $row3->property_feature_type_id): ?>
                                                                <div class="col-sm-4">
                                                                    <label class="checkbox-inline">
                                                                        <input type="checkbox" name="property_feature_id[]" value="<?php echo $row3->property_feature_id; ?>"
                                                                            <?php 
                                                                                foreach ($property_listing_features as $row4) {
                                                                                    if($row4->property_feature_id == $row3->property_feature_id){
                                                                                            echo 'checked';
                                                                                    }
                                                                                }                        
                                                                            ?>
                                                                        ><?php echo $row3->property_feature_name; ?>
                                                                    </label>
                                                                </div>                          
                                                            <?php //endif; ?>
                                                        <?php endforeach; ?>                    
                                                    </div>
                                                    <div class="clearfix"></div>
                                                    <hr>
                                                <?php //endforeach; ?>

                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <div class="pull-left" id="new_property_features_loader" style="display: none;"><i class="icon-spinner3 spin block-inner"></i></div>
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
