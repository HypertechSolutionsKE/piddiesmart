        <?php
            if ($this->session->userdata('product_subcategory_id')){$product_subcat_id = $this->session->userdata('product_subcategory_id');}else{$product_subcat_id = '';}
            
            if ($this->session->userdata('brand_id')){$cit_id = $this->session->userdata('brand_id');}else{$cit_id = '';}
            
            if ($this->session->userdata('area_id')){$are_id = $this->session->userdata('area_id');}else{$are_id = '';}

        ?>
        <script type="text/javascript">
            $product_subcat_id = '<?php echo $product_subcat_id; ?>';
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

            <?php if (!isset($product)): ?>
                <div class="row">
                    <div class="col-md-9">
                        <form method="post" role="form" id="frm_newproductstart" name="frm_newproductstart" onsubmit="return save_new_product_start();" enctype="multipart/form-data">

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
                                            <li class="active"><a href="<?php echo base_url();?>be/products/clothing_add_start">Step 1: Basic Product Info</a></li>
                                            <li class="bg-succ"><a href="<?php echo base_url();?>be/products/clothing_add_features">Step 2: Product Features</a></li>
                                            <li class="bg-succ"><a href="<?php echo base_url();?>be/products/clothing_add_images">Step 3: Product Images</a></li>                      
                                        <?php elseif($product_type == 'Cosmetics'): ?>
                                            <li class="active"><a href="<?php echo base_url();?>be/products/cosmetics_add_start">Step 1: Basic Product Info</a></li>
                                            <li class="bg-succ"><a href="<?php echo base_url();?>be/products/cosmetics_add_features">Step 2: Product Features</a></li>
                                            <li class="bg-succ"><a href="<?php echo base_url();?>be/products/cosmetics_add_images">Step 3: Product Images</a></li>                     
                                        <?php elseif($product_type == 'Sound'): ?>
                                            <li class="active"><a href="<?php echo base_url();?>be/products/sound_add_start">Step 1: Basic Product Info</a></li>
                                            <li class="bg-succ"><a href="<?php echo base_url();?>be/products/sound_add_features">Step 2: Product Features</a></li>
                                            <li class="bg-succ"><a href="<?php echo base_url();?>be/products/sound_add_images">Step 3: Product Images</a></li>               
                                        <?php endif; ?>                                
                                    </ul>
                                    <div class="clearfix"></div>
                                    <hr>

                                    <?php if ($this->session->flashdata('success')): ?>
                                        <div class="alert alert-success block-inner">
                                            <button type="button" class="close" data-dismiss="alert">×</button>
                                            <?php echo $this->session->flashdata('success'); ?>
                                        </div>                                    

                                    <?php endif; ?>

                                    <div class="alert alert-danger block-inner" style="display: none;" id="div_new_product_start_error">
                                        <button type="button" class="close" data-dismiss="alert">×</button>
                                        Error
                                    </div>
                                        
                                    <div class="alert alert-success block-inner" style="display: none;" id="div_new_product_start_success">
                                        <button type="button" class="close" data-dismiss="alert">×</button>
                                        Error
                                    </div>
                                    <input type="hidden" id="product_type" name="product_type" class="form-control" value="<?php echo $product_type;?>">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-7">
                                                <label>Product Name *&nbsp;&nbsp;<a data-placement="top" class="tip" title="Name of the product that is displayed in the front end"><i class="icon-question2"></i></a></label>
                                                <input type="text" id="product_name" name="product_name" class="form-control" value="<?php if(false !== $this->session->userdata('product_name')){echo $this->session->userdata('product_name');}  ?>">
                                            </div>
                                            <div class="col-sm-5">
                                                <small>Writing a good title is important. Use words buyers would use to search for products like yours.</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-7">
                                                <label>Product Description</label>
                                                <textarea id="product_description" name="product_description" class="form-control text-area"><?php if(false !== $this->session->userdata('product_description')){echo $this->session->userdata('product_description');}  ?></textarea> 
                                            </div>
                                            <div class="col-sm-5">
                                                <small>By selecting the right product type, you can help the user to find the right product for his specific needs.</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-7">
                                                <label>Product Category</label>
                                                <select name="category_id[]" id="category_id" data-placeholder="Select your product categories here..." class="select-multiple" multiple="multiple" tabindex="2">
                                                    <option value=""></option>
                                                    <?php foreach($categories as $row): ?>
                                                        <option value="<?php echo $row->category_id; ?>" <?php if(false !== $this->session->userdata('category_id')){if($this->session->userdata('category_id') == $row->category_id){echo 'selected';}}  ?>><?php echo $row->category_name; ?></option>
                                                    <?php endforeach; ?>                       
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-7">
                                                <label>Brand</label>
                                                <select data-placeholder="Select Brand..." class="clear-results" tabindex="2" id="brand_id" name="brand_id">
                                                    <option value=""></option>
                                                    <?php foreach($brands as $row): ?>
                                                        <option value="<?php echo $row->brand_id; ?>" <?php if(false !== $this->session->userdata('brand_id')){if($this->session->userdata('brand_id') == $row->brand_id){echo 'selected';}}  ?>><?php echo $row->brand_name; ?></option>
                                                    <?php endforeach; ?>                       

                                                </select> 
                                            </div>
                                        </div>
                                    </div>

                                    <hr>
                                    <h6 style="margin-top: 0; margin-bottom: 10px; font-weight: bold !important;" class="text-danger">Pricing</h6>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-7">
                                                <label>Price *&nbsp;&nbsp;<a data-placement="top" class="tip" title="Original Price"><i class="icon-question2"></i></a></label>
                                                <input type="number" id="price" name="price" class="form-control" value="<?php if(false !== $this->session->userdata('price')){echo $this->session->userdata('price');}  ?>"> 
                                            </div>
                                            <div class="col-sm-5">
                                                <small><b>IMPORTANT:</b> Your Price should contain only Numbers. Please don't use commas or periods</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-7">
                                                <label>Deal Price</label>
                                                <input type="number" id="deal_price" name="deal_price" class="form-control" value="<?php if(false !== $this->session->userdata('deal_price')){echo $this->session->userdata('deal_price');}  ?>"> 
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-7">
                                                <label>Currency * &nbsp;&nbsp;<a data-placement="top" class="tip" title="Currency"><i class="icon-question2"></i></a></label>
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
                                    <div class="pull-left" id="new_product_start_loader" style="display: none;"><i class="icon-spinner3 spin block-inner"></i></div>
                                    <button type="submit" class="btn btn-success"><i class="icon-arrow-right11"></i> Save &amp; Continue with Next Step</button>
                                </div>

                             </div>                           
                        </form>
                    </div>
                </div>
            <?php else: ?>
                <?php foreach ($product as $row2): ?>
                    <div class="row">
                        <div class="col-md-9">
                            <form method="post" role="form" id="frm_newproductstart" name="frm_newproductstart" onsubmit="return update_product_start();" enctype="multipart/form-data">

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
                                                <li class="active"><a href="<?php echo base_url();?>be/products/clothing_edit_start/<?php echo $row2->product_id; ?>">Step 1: Basic Product Info</a></li>
                                                <li class="bg-succ"><a href="<?php echo base_url();?>be/products/clothing_edit_features/<?php echo $row2->product_id; ?>">Step 2: Product Features</a></li>
                                                <li class="bg-succ"><a href="<?php echo base_url();?>be/products/clothing_edit_images/<?php echo $row2->product_id; ?>">Step 3: Product Images</a></li>                      
                                            <?php elseif($product_type == 'Cosmetics'): ?>
                                                <li class="active"><a href="<?php echo base_url();?>be/products/cosmetics_edit_start/<?php echo $row2->product_id; ?>">Step 1: Basic Product Info</a></li>
                                                <li class="bg-succ"><a href="<?php echo base_url();?>be/products/cosmetics_edit_features/<?php echo $row2->product_id; ?>">Step 2: Product Features</a></li>
                                                <li class="bg-succ"><a href="<?php echo base_url();?>be/products/cosmetics_edit_images/<?php echo $row2->product_id; ?>">Step 3: Product Images</a></li>                     
                                            <?php elseif($product_type == 'Sound'): ?>
                                                <li class="active"><a href="<?php echo base_url();?>be/products/sound_edit_start/<?php echo $row2->product_id; ?>">Step 1: Basic Product Info</a></li>
                                                <li class="bg-succ"><a href="<?php echo base_url();?>be/products/sound_edit_features/<?php echo $row2->product_id; ?>">Step 2: Product Features</a></li>
                                                <li class="bg-succ"><a href="<?php echo base_url();?>be/products/sound_edit_images/<?php echo $row2->product_id; ?>">Step 3: Product Images</a></li>               
                                            <?php endif; ?>                                
                                        </ul>
                                        <div class="clearfix"></div>
                                        <hr>

                                        <?php if ($this->session->flashdata('success')): ?>
                                            <div class="alert alert-success block-inner">
                                                <button type="button" class="close" data-dismiss="alert">×</button>
                                                <?php echo $this->session->flashdata('success'); ?>
                                            </div>                                    

                                        <?php endif; ?>

                                        <div class="alert alert-danger block-inner" style="display: none;" id="div_new_product_start_error">
                                            <button type="button" class="close" data-dismiss="alert">×</button>
                                            Error
                                        </div>
                                            
                                        <div class="alert alert-success block-inner" style="display: none;" id="div_new_product_start_success">
                                            <button type="button" class="close" data-dismiss="alert">×</button>
                                            Error
                                        </div>
                                        <input type="hidden" id="product_type" name="product_type" class="form-control" value="<?php echo $product_type;?>">
                                        <input type="hidden" name="product_id" id="product_id" value="<?php echo $row2->product_id; ?>">                                        
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-7">
                                                    <label>Product Name *&nbsp;&nbsp;<a data-placement="top" class="tip" title="Name of the product that is displayed in the front end"><i class="icon-question2"></i></a></label>
                                                    <input type="text" id="product_name" name="product_name" class="form-control" value="<?php echo $row2->product_name; ?>">
                                                </div>
                                                <div class="col-sm-5">
                                                    <small>Writing a good title is important. Use words buyers would use to search for products like yours.</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-7">
                                                    <label>Product Description</label>
                                                    <textarea id="product_description" name="product_description" class="form-control text-area"><?php echo $row2->product_description; ?></textarea> 
                                                </div>
                                                <div class="col-sm-5">
                                                    <small>By selecting the right product type, you can help the user to find the right product for his specific needs.</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-7">
                                                    <label>Product Category</label>
                                                    <select name="category_id[]" id="category_id" data-placeholder="Select your product categories here..." class="select-multiple" multiple="multiple" tabindex="2">
                                                        <option value=""></option>
                                                        <?php foreach($categories as $row): ?>
                                                            <option value="<?php echo $row->category_id; ?>"
                                                                <?php 
                                                                    foreach ($product_categories as $row4) {
                                                                        if($row4->category_id == $row->category_id){
                                                                            echo 'selected';
                                                                        }
                                                                    }                        
                                                                ?>
                                                            ><?php echo $row->category_name; ?></option>
                                                        <?php endforeach; ?>                       
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-7">
                                                    <label>Brand</label>
                                                    <select data-placeholder="Select Brand..." class="clear-results" tabindex="2" id="brand_id" name="brand_id">
                                                        <option value=""></option>
                                                        <?php foreach($brands as $row): ?>
                                                            <option value="<?php echo $row->brand_id; ?>" <?php if($row2->brand_id == $row->brand_id){echo 'selected';}  ?>><?php echo $row->brand_name; ?></option>
                                                        <?php endforeach; ?>                       

                                                    </select> 
                                                </div>
                                            </div>
                                        </div>

                                        <hr>
                                        <h6 style="margin-top: 0; margin-bottom: 10px; font-weight: bold !important;" class="text-danger">Pricing</h6>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-7">
                                                    <label>Price *&nbsp;&nbsp;<a data-placement="top" class="tip" title="Original Price"><i class="icon-question2"></i></a></label>
                                                    <input type="number" id="price" name="price" class="form-control" value="<?php echo $row2->product_price; ?>"> 
                                                </div>
                                                <div class="col-sm-5">
                                                    <small><b>IMPORTANT:</b> Your Price should contain only Numbers. Please don't use commas or periods</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-7">
                                                    <label>Deal Price</label>
                                                    <input type="number" id="deal_price" name="deal_price" class="form-control" value="<?php echo $row2->product_deal_price; ?>"> 
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-7">
                                                    <label>Currency * &nbsp;&nbsp;<a data-placement="top" class="tip" title="Currency"><i class="icon-question2"></i></a></label>
                                                    <select data-placeholder="Select Currency..." class="clear-results" tabindex="2" id="currency_id" name="currency_id">
                                                        <option value=""></option>
                                                        <?php foreach($currencies as $row): ?>
                                                            <option value="<?php echo $row->currency_id; ?>"<?php if($row2->currency_id == $row->currency_id){echo 'selected';} ?>><?php echo $row->currency_name; ?></option>
                                                        <?php endforeach; ?>                       

                                                    </select> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <div class="pull-left" id="new_product_start_loader" style="display: none;"><i class="icon-spinner3 spin block-inner"></i></div>
                                        <button type="submit" class="btn btn-success"><i class="icon-arrow-right11"></i> Save &amp; Continue with Next Step</button>
                                    </div>

                                 </div>                           
                            </form>
                        </div>
                    </div>



                <?php endforeach; ?>
            <?php endif; ?>


            <!-- Footer -->
            <div class="footer clearfix">
                <div class="pull-left">&copy; <?php echo date('Y');?>. PiddieSmart powered by <a href="http://hypertechsolutions.co.ke">Hypertech Solutions Limited</a></div>
            </div>
            <!-- /footer -->


        </div>
        <!-- /page content -->
