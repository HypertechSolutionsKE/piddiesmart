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
                <div class="col-md-12">
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            <h6 class="panel-title" style="margin-top: 5px"><i class="icon-user4"></i> Clothing Products List</h6>
                            <div class="panel-icons-group">
                                <a role="button" href="<?php echo base_url();?>be/products/clothing_add_start" class="label btn-success"><i class="icon-plus-circle"></i> New product</a>
                            </div>

                        </div>
                        <div class="panel-body">
                            <div id="">
                                <div class="alert alert-danger block-inner" style="display: none;" id="div_product_error">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                        Error
                                </div>
                                
                                <div class="alert alert-success block-inner" style="display: none;" id="div_product_success">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                        Success
                                </div>
                                <div class="alert alert-info">
                                    <form class="validate" method="post" role="form" id="frm_clothingproductsfilter" name="frm_clothingproductsfilter" onsubmit="return filter_clothing_products();" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-md-3">
                                                 <div class="form-group">
                                                    <label>Category:</label>
                                                    <select data-placeholder="Category" class="clear-results" tabindex="2" id="clo_category_id" name="category_id">
                                                        <option value=""></option>
                                                        <?php foreach($categories as $row): ?>
                                                            <option value="<?php echo $row->category_id; ?>" <?php if(false !== $this->session->userdata('category_id')){if($this->session->userdata('category_id') == $row->category_id){echo 'selected';}}  ?>><?php echo $row->category_name; ?></option>
                                                        <?php endforeach; ?>    
                                                    </select> 
                                                </div>                                    
                                            </div>
                                            <div class="col-md-3">
                                                 <div class="form-group">
                                                    <label>Brand:</label>
                                                    <select data-placeholder="Brand" class="clear-results" tabindex="2" id="clo_brand_id" name="brand_id">
                                                        <option value=""></option>
                                                        <?php foreach($brands as $row): ?>
                                                            <option value="<?php echo $row->brand_id; ?>" <?php if(false !== $this->session->userdata('brand_id')){if($this->session->userdata('brand_id') == $row->brand_id){echo 'selected';}}  ?>><?php echo $row->brand_name; ?></option>
                                                        <?php endforeach; ?>                       
                                                    </select> 
                                                </div>                                    
                                            </div>
                                            <div class="col-sm-3">
                                                 <div class="form-group">
                                                    <label>Product Status:</label>
                                                    <div class="block-inner">
                                                        <label class="radio-inline">
                                                            <input type="radio" name="product_status" id="clo_product_status1" checked="checked" class="styled" value="All">
                                                                All
                                                        </label>                                     
                                                        <label class="radio-inline">
                                                            <input type="radio" name="product_status" id="clo_product_status2" class="styled" value="Online">
                                                                Online
                                                        </label>
                                                        <label class="radio-inline">
                                                            <input type="radio" name="product_status" id="clo_product_status3" class="styled" value="Offline">
                                                                Offline
                                                        </label>
                                                    </div> 
                                                </div>                                    
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label>Featured:</label>
                                                    <div class="block-inner">
                                                        <label class="radio-inline">
                                                            <input type="radio" name="featured" id="clo_featured1" class="styled" value="All" checked="checked">
                                                                    All
                                                        </label>                               
                                                        <label class="radio-inline">
                                                            <input type="radio" name="featured" id="clo_featured2" class="styled" value="Yes">
                                                                    Yes
                                                        </label>
                                                        <label class="radio-inline">
                                                            <input type="radio" name="featured" id="clo_featured3" class="styled" value="No">
                                                                No
                                                        </label>
                                                    </div> 
                                                </div>                                    
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label>New Arrival:</label>
                                                    <div class="block-inner">
                                                        <label class="radio-inline">
                                                            <input type="radio" name="new_arrival" id="clo_new_arrival1" class="styled" value="All" checked="checked">
                                                                    All
                                                        </label>                               
                                                        <label class="radio-inline">
                                                            <input type="radio" name="new_arrival" id="clo_new_arrival2" class="styled" value="Yes">
                                                                    Yes
                                                        </label>
                                                        <label class="radio-inline">
                                                            <input type="radio" name="new_arrival" id="clo_new_arrival3" class="styled" value="No">
                                                                No
                                                        </label>
                                                    </div> 
                                                </div>                                    
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label>Special Offer:</label>
                                                    <div class="block-inner">
                                                        <label class="radio-inline">
                                                            <input type="radio" name="special_offer" id="clo_special_offer1" class="styled" value="All" checked="checked">
                                                                    All
                                                        </label>                               
                                                        <label class="radio-inline">
                                                            <input type="radio" name="special_offer" id="clo_special_offer2" class="styled" value="Yes">
                                                                    Yes
                                                        </label>
                                                        <label class="radio-inline">
                                                            <input type="radio" name="special_offer" id="clo_special_offer3" class="styled" value="No">
                                                                No
                                                        </label>
                                                    </div> 
                                                </div>                                    
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label>Deal of the Week:</label>
                                                    <div class="block-inner">
                                                        <label class="radio-inline">
                                                            <input type="radio" name="deal_of_the_week" id="clo_deal_of_the_week1" class="styled" value="All" checked="checked">
                                                                    All
                                                        </label>                               
                                                        <label class="radio-inline">
                                                            <input type="radio" name="deal_of_the_week" id="clo_deal_of_the_week2" class="styled" value="Yes">
                                                                    Yes
                                                        </label>
                                                        <label class="radio-inline">
                                                            <input type="radio" name="deal_of_the_week" id="clo_deal_of_the_week3" class="styled" value="No">
                                                                No
                                                        </label>
                                                    </div> 
                                                </div>                                    
                                            </div>

                                        </div>
                                    </form>
                                </div>

                                <!--<hr>-->
                                <div id="clothing_products_div" style="min-height:200px">
                                    <!--<div class="datatable-tools">
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>product Title</th>
                                                    <th>product SKU</th>
                                                    <th>Category</th>
                                                    <th>brand</th>
                                                    <th>product Subcategory</th>
                                                    <th>Region</th>
                                                    <th>City</th>
                                                    <th>Area</th>
                                                    <th>Price</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($products as $row): ?>
                                                    <tr>
                                                        <td><?php echo $row->product_title; ?></td>
                                                        <td><?php echo $row->product_sku; ?></td>
                                                        <td><?php echo $row->category_name; ?></td>
                                                        <td><?php echo $row->brand_name; ?></td>
                                                        <td><?php echo $row->product_subcategory_name; ?></td>
                                                        <td><?php echo $row->region_name; ?></td>
                                                        <td><?php echo $row->city_name; ?></td>
                                                        <td><?php echo $row->area_name; ?></td>            
                                                        <td><?php echo $row->price; ?></td>
                                                        <td>
                                                            <a role="button" href="" class="label label-success btn-icon"><i class="icon-pencil"></i></a>
                                                            <a onClick="javascript:return confirm('Do you really wish to delete this product Listing?');" href="javascript:delete_system_user(<?php echo $row->product_id; ?>);" class="label label-danger btn-icon"><i class="icon-remove3"></i></a>
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

            <!-- /form modal -->
            <script>
                filter_clothing_products();
                //filter_agent_products();
            </script>

            <!-- Footer -->
            <div class="footer clearfix">
                <div class="pull-left">&copy; <?php echo date('Y');?>. PiddieSmart powered by <a href="http://hypertechsolutions.co.ke">Hypertech Solutions Limited</a></div>
            </div>
            <!-- /footer -->


        </div>
        <!-- /page content -->
