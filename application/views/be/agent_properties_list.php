        <!-- Page content -->
        <div class="page-content">


            <!-- Page header -->
            <div class="page-header">
                <div class="page-title">
                    <h3>Agent Properties List <small></small></h3>
                </div>
            </div>
            <!-- /page header -->

            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h6 class="panel-title" style="margin-top: 5px"><i class="icon-user4"></i> Agent Properties List</h6>
                            <!--<div class="panel-icons-group">
                                <a role="button" href="<?php echo base_url();?>be/properties/add_start" class="label btn-success"><i class="icon-plus-circle"></i> New Property</a>
                            </div>-->

                        </div>
                        <div class="panel-body">
                            <div id="">
                                <div class="alert alert-danger block-inner" style="display: none;" id="div_property_error">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                        Error
                                </div>
                                
                                <div class="alert alert-success block-inner" style="display: none;" id="div_property_success">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                        Success
                                </div>

                                <form class="validate" method="post" role="form" id="frm_agentpropertiesfilter" name="frm_agentpropertiesfilter" onsubmit="return filter_agent_properties();" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-2">
                                             <div class="form-group">
                                                <label>Listing Type:</label>
                                                <select data-placeholder="Listing Type" class="clear-results" tabindex="2" id="ag_pl_listing_type_id" name="ag_pl_listing_type_id">
                                                    <option value=""></option>
                                                    <?php foreach($listing_types as $row): ?>
                                                        <option value="<?php echo $row->listing_type_id; ?>" <?php if(false !== $this->session->userdata('listing_type_id')){if($this->session->userdata('listing_type_id') == $row->listing_type_id){echo 'selected';}}  ?>><?php echo $row->listing_type_name; ?></option>
                                                    <?php endforeach; ?>    
                                                </select> 
                                            </div>                                    
                                        </div>
                                        <div class="col-md-2">
                                             <div class="form-group">
                                                <label>Property Type:</label>
                                                <select data-placeholder="Property Type" class="clear-results" tabindex="2" id="ag_pl_property_type_id" name="ag_pl_property_type_id">
                                                    <option value=""></option>
                                                    <?php foreach($property_types as $row): ?>
                                                        <option value="<?php echo $row->property_type_id; ?>" <?php if(false !== $this->session->userdata('property_type_id')){if($this->session->userdata('property_type_id') == $row->property_type_id){echo 'selected';}}  ?>><?php echo $row->property_type_name; ?></option>
                                                    <?php endforeach; ?>                       
                                                </select> 
                                            </div>                                    
                                        </div>
                                        <div class="col-md-2">
                                             <div class="form-group">
                                                <label>Property Subcategory:</label>
                                                <select data-placeholder="Property Subcategory" class="clear-results" tabindex="2" id="ag_pl_property_subcategory_id" name="ag_pl_property_subcategory_id">
                                                    <option value=""></option>
                                                </select> 
                                            </div>                                    
                                        </div>
                                        <div class="col-md-2">
                                             <div class="form-group">
                                                <label>City:</label>
                                                <select data-placeholder="City" class="clear-results" tabindex="2" id="ag_pl_city_id" name="ag_pl_city_id">
                                                    <option value=""></option>
                                                    <?php foreach($cities as $row): ?>
                                                        <option value="<?php echo $row->city_id; ?>" <?php if(false !== $this->session->userdata('city_id')){if($this->session->userdata('city_id') == $row->city_id){echo 'selected';}}  ?>><?php echo $row->city_name; ?></option>
                                                    <?php endforeach; ?>                   

                                                </select> 
                                            </div>                                    
                                        </div>   
                                        <div class="col-md-2">
                                             <div class="form-group">
                                                <label>Area:</label>
                                                <select data-placeholder="Area" class="clear-results" tabindex="2" id="ag_pl_area_id" name="ag_pl_area_id">
                                                    <option value=""></option>
                                                </select> 
                                            </div>                                    
                                        </div>
                                        <div class="col-md-2">
                                             <div class="form-group">
                                                <label>Package</label>
                                                <select data-placeholder="Standard" class="clear-results" tabindex="2" id="ag_pl_package" name="ag_pl_package">
                                                    <option value=""></option>
                                                    <option value="Standard">Standard</option>
                                                    <option value="Premium">Premium</option>
                                                </select> 
                                            </div>                                    
                                        </div>   


                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                             <div class="form-group">
                                                <label>From (yyyy-mm-dd):</label>
                                                <input type="text" class="datepicker form-control" name="ag_pl_date_from" id="ag_pl_date_from">
                                            </div>                                    
                                        </div>
                                        <div class="col-md-2">
                                             <div class="form-group">
                                                <label>To (yyyy-mm-dd):</label>
                                                <input type="text" class="datepicker form-control" name="ag_pl_date_to" id="ag_pl_date_to">
                                                </select> 
                                            </div>                                    
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>Featured:</label>
                                                <div class="block-inner">
                                                    <label class="radio-inline">
                                                        <input type="radio" name="ag_pl_featured" id="ag_pl_featured1" class="styled" value="All" checked="checked">
                                                                All
                                                    </label>                               
                                                    <label class="radio-inline">
                                                        <input type="radio" name="ag_pl_featured" id="ag_pl_featured2" class="styled" value="Yes">
                                                                Yes
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="ag_pl_featured" id="ag_pl_featured3" class="styled" value="No">
                                                            No
                                                    </label>
                                                </div> 
                                            </div>                                    
                                        </div>
                                        <div class="col-sm-3">
                                             <div class="form-group">
                                                <label>Publish Status:</label>
                                                <div class="block-inner">
                                                    <label class="radio-inline">
                                                        <input type="radio" name="ag_pl_publish_status" id="ag_pl_publish_status1" checked="checked" class="styled" value="All">
                                                            All
                                                    </label>                                     
                                                    <label class="radio-inline">
                                                        <input type="radio" name="ag_pl_publish_status" id="ag_pl_publish_status2" class="styled" value="Online">
                                                            Online
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="ag_pl_publish_status" id="ag_pl_publish_status3" class="styled" value="Offline">
                                                            Offline
                                                    </label>
                                                </div> 
                                            </div>                                    
                                        </div>     

                                    </div>
                                </form>

                                <!--<hr>-->
                                <div id="agent_properties_div" style="min-height:200px">
                                    <!--<div class="datatable-tools">
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Property Title</th>
                                                    <th>Property SKU</th>
                                                    <th>Listing Type</th>
                                                    <th>Property Type</th>
                                                    <th>Property Subcategory</th>
                                                    <th>Region</th>
                                                    <th>City</th>
                                                    <th>Area</th>
                                                    <th>Price</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($properties as $row): ?>
                                                    <tr>
                                                        <td><?php echo $row->property_title; ?></td>
                                                        <td><?php echo $row->property_sku; ?></td>
                                                        <td><?php echo $row->listing_type_name; ?></td>
                                                        <td><?php echo $row->property_type_name; ?></td>
                                                        <td><?php echo $row->property_subcategory_name; ?></td>
                                                        <td><?php echo $row->region_name; ?></td>
                                                        <td><?php echo $row->city_name; ?></td>
                                                        <td><?php echo $row->area_name; ?></td>            
                                                        <td><?php echo $row->price; ?></td>
                                                        <td>
                                                            <a role="button" href="" class="label label-success btn-icon"><i class="icon-pencil"></i></a>
                                                            <a onClick="javascript:return confirm('Do you really wish to delete this Property Listing?');" href="javascript:delete_system_user(<?php echo $row->property_id; ?>);" class="label label-danger btn-icon"><i class="icon-remove3"></i></a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>-->
                                </div>
                                

                            </div>
                        </div> 
                    </div>                           
                </div>
            </div>


            <script>
                //filter_properties();
                filter_agent_properties();
            </script>

            <!-- Footer -->
            <div class="footer clearfix">
                <div class="pull-left">&copy; <?php echo date('Y');?>. PiddieSmart powered by <a href="http://hypertechsolutions.co.ke">Hypertech Solutions Limited</a></div>
            </div>
            <!-- /footer -->


        </div>
        <!-- /page content -->
