        <?php
            if ($this->session->userdata('property_subcategory_id')){$property_subcat_id = $this->session->userdata('property_subcategory_id');}else{$property_subcat_id = '';}
            
            if ($this->session->userdata('city_id')){$cit_id = $this->session->userdata('city_id');}else{$cit_id = '';}
            
            if ($this->session->userdata('area_id')){$are_id = $this->session->userdata('area_id');}else{$are_id = '';}

        ?>
        <script type="text/javascript">
            $property_subcat_id = '<?php echo $property_subcat_id; ?>';
            $cit_id = '<?php echo $cit_id; ?>';
            $are_id = '<?php echo $are_id; ?>';
        </script>


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
                        <form class="validate" method="post" role="form" id="frm_newpropertystart" name="frm_newpropertystart" onsubmit="return save_new_property_start();" enctype="multipart/form-data">

                            <div class="panel panel-danger">
                                <div class="panel-heading">
                                    <h6 class="panel-title" style="margin-top: 5px"><i class="icon-office"></i> New Property</h6>
                                </div>
                                <div class="panel-body">

                                    <ul class="nav nav-pills nav-justified">
                                        <li class="active"><a href="<?php echo base_url();?>be/properties/add_start">Step 1: Basic Info</a></li>
                                        <li class="bg-succ"><a href="<?php echo base_url();?>be/properties/add_features">Step 2: Property Features</a></li>
                                        <li class="bg-succ"><a href="<?php echo base_url();?>be/properties/add_contacts">Step 3: Contact Details</a></li>
                                        <li class="bg-succ"><a href="<?php echo base_url();?>be/properties/add_attachments">Step 4: Attachments &amp; Publish</a></li>                                        
                                    </ul>
                                    <div class="clearfix"></div>
                                    <hr>

                                    <!--<div class="block-inner text-danger">
                                        <h6 class="heading-hr">Step 1: Basic information <small class="display-block">Please fill in the property's basic information and click 'Next'</small></h6>
                                    </div>-->

                                    <?php if ($this->session->flashdata('success')): ?>
                                        <div class="alert alert-success block-inner">
                                            <button type="button" class="close" data-dismiss="alert">×</button>
                                            <?php echo $this->session->flashdata('success'); ?>
                                        </div>                                    

                                    <?php endif; ?>

                                    <div class="alert alert-danger block-inner" style="display: none;" id="div_new_property_start_error">
                                        <button type="button" class="close" data-dismiss="alert">×</button>
                                        Error
                                    </div>
                                        
                                    <div class="alert alert-success block-inner" style="display: none;" id="div_new_property_start_success">
                                        <button type="button" class="close" data-dismiss="alert">×</button>
                                        Error
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-7">
                                                <label>Listing Type *</label>
                                                <select data-placeholder="Select Listing Type..." class="clear-results" tabindex="2" id="listing_type_id" name="listing_type_id">
                                                    <option value=""></option> 
                                                    <?php foreach($listing_types as $row): ?>
                                                        <option value="<?php echo $row->listing_type_id; ?>" <?php if(false !== $this->session->userdata('listing_type_id')){if($this->session->userdata('listing_type_id') == $row->listing_type_id){echo 'selected';}}  ?>><?php echo $row->listing_type_name; ?></option>
                                                    <?php endforeach; ?>                       
                                                </select> 
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-7">
                                                <label>Property Title *&nbsp;&nbsp;<a data-placement="top" class="tip" title="Name of the property that is displayed in the front end"><i class="icon-question2"></i></a></label>
                                                <input type="text" id="property_title" name="property_title" class="form-control" value="<?php if(false !== $this->session->userdata('property_title')){echo $this->session->userdata('property_title');}  ?>">
                                            </div>
                                            <div class="col-sm-5">
                                                <small>Writing a good title is important. Use words buyers would use to search for properties like yours.</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-7">
                                                <label>Property Type *</label>
                                                <select data-placeholder="Select Property Type..." class="clear-results" tabindex="2" id="property_type_id" name="property_type_id">
                                                    <option value=""></option> 
                                                    <?php foreach($property_types as $row): ?>
                                                        <option value="<?php echo $row->property_type_id; ?>" <?php if(false !== $this->session->userdata('property_type_id')){if($this->session->userdata('property_type_id') == $row->property_type_id){echo 'selected';}}  ?>><?php echo $row->property_type_name; ?></option>
                                                    <?php endforeach; ?>                       
                                                </select> 
                                            </div>
                                            <div class="col-sm-5">
                                                <small>By selecting the right property type, you can help the user to find the right property for his specific needs.</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-7">
                                                <label>Property Subcategory *</label>
                                                <select data-placeholder="Select Subcategory..." class="clear-results" tabindex="2" id="property_subcategory_id" name="property_subcategory_id">
                                                    <option value=""></option>
                                                </select> 
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <h6 style="margin-top: 0; margin-bottom: 10px; font-weight: bold !important;" class="text-danger">Pick Location</h6>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-7">
                                                <label>Region *</label>
                                                <select data-placeholder="Select Region..." class="clear-results" tabindex="2" id="region_id" name="region_id">
                                                    <option value=""></option>
                                                    <?php foreach($regions as $row): ?>
                                                        <option value="<?php echo $row->region_id; ?>" <?php if(false !== $this->session->userdata('region_id')){if($this->session->userdata('region_id') == $row->region_id){echo 'selected';}}  ?>><?php echo $row->region_name; ?></option>
                                                    <?php endforeach; ?>                       

                                                </select> 
                                            </div>
                                            <div class="col-sm-5">
                                                <small>Please choose at least the region and the city of your property.<!-- This will help us to send the user the best new properties of his neighborhood.--></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-7">
                                                <label>City/Town *</label>
                                                <select data-placeholder="Select City/Town..." class="clear-results" tabindex="2" id="city_id" name="city_id">
                                                    <option value=""></option>
                                                </select> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-7">
                                                <label>Area/Locality *</label>
                                                <select data-placeholder="Select Area/Locality..." class="clear-results" tabindex="2" id="area_id" name="area_id">
                                                    <option value=""></option>
                                                </select> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-7">
                                                <label>Address (Street, Number etc) &nbsp;&nbsp;<a data-placement="top" class="tip" title="Address where your property is located"><i class="icon-question2"></i></a></label>
                                                <input type="text" id="physical_address" name="physical_address" class="form-control" value="<?php if(false !== $this->session->userdata('physical_address')){echo $this->session->userdata('physical_address');}  ?>">
                                            </div>
                                            <div class="col-sm-5">
                                                <small>Enter the address and co-ordinates of your property to show the user the correct position on the map.</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-12">
                                            <h6>Map Position</h6>
                                            </div>                                       
                                            <div class="col-sm-7">
                                                <div class="col-sm-6">
                                                    <label>Longitude</label>
                                                    <input type="text" id="longitude" name="longitude" class="form-control" value="<?php if(false !== $this->session->userdata('longitude')){echo $this->session->userdata('longitude');}  ?>">
                                                </div>
                                                <div class="col-sm-6">
                                                    <label>Latitude</label>
                                                    <input type="text" id="latitude" name="latitude" class="form-control" value="<?php if(false !== $this->session->userdata('latitude')){echo $this->session->userdata('latitude');}  ?>">
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                    <hr>
                                    <h6 style="margin-top: 0; margin-bottom: 10px; font-weight: bold !important;" class="text-danger">Pricing</h6>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-7">
                                                <label>Price *&nbsp;&nbsp;<a data-placement="top" class="tip" title="Original Price"><i class="icon-question2"></i></a></label>
                                                <input type="text" id="price" name="price" class="form-control" value="<?php if(false !== $this->session->userdata('price')){echo $this->session->userdata('price');}  ?>"> 
                                            </div>
                                            <div class="col-sm-5">
                                                <small><b>IMPORTANT:</b> Your Price should contain only Numbers. Please don't use commas or periods</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-7">
                                                <label>Currency &nbsp;&nbsp;<a data-placement="top" class="tip" title="Currency"><i class="icon-question2"></i></a></label>
                                                <select data-placeholder="Select Currency..." class="clear-results" tabindex="2" id="currency_id" name="currency_id">
                                                    <option value=""></option>
                                                    <?php foreach($currencies as $row): ?>
                                                        <option value="<?php echo $row->currency_id; ?>"<?php if(false !== $this->session->userdata('currency_id')){if($this->session->userdata('currency_id') == $row->currency_id){echo 'selected';}}  ?>><?php echo $row->currency_name; ?></option>
                                                    <?php endforeach; ?>                       

                                                </select> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <div class="pull-left" id="new_property_start_loader" style="display: none;"><i class="icon-spinner3 spin block-inner"></i></div>
                                    <button type="submit" class="btn btn-success"><i class="icon-arrow-right11"></i> Save &amp; Continue with Next Step</button>
                                </div>

                             </div>                           
                        </form>
                </div>
            </div>


            <!-- Footer -->
            <div class="footer clearfix">
                <div class="pull-left">&copy; <?php echo date('Y');?>. PiddieSmart powered by <a href="http://hypertechsolutions.co.ke">Hypertech Solutions Limited</a></div>
            </div>
            <!-- /footer -->


        </div>
        <!-- /page content -->
