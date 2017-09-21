
              <!-- CSS Style -->
              <link rel="stylesheet" href="<?php echo base_url();?>assets/fe/style.css">

              <link rel="stylesheet" href="<?php echo base_url();?>assets/fe/font-awesome-4.7.0/css/font-awesome.css">

              <?php foreach($product as $row): ?>
                  <div style="width:auto;height:auto;overflow: auto;position:relative;">
                      <div class="product-view-area">
                          <div class="product-big-image col-xs-12 col-sm-5 col-lg-5 col-md-5">
                              <!--<div class="icon-sale-label sale-left">Sale</div>-->                              
                              <div class="large-image">
                                  <?php if($row->main_image != ''): ?>
                                    <?php if (file_exists("./uploads/product_images/" . $row->main_image)): ?>
                                      <?php $main_image = "uploads/product_images/".$row->main_image; ?>
                                    <?php else: ?>
                                      <?php //$main_image = "assets/fe/media-demo/properties/554x360/06.jpg"; ?>
                                    <?php endif; ?>
                                  <?php else: ?>
                                    <?php //$main_image = "assets/fe/media-demo/properties/554x360/06.jpg"; ?>
                                  <?php endif; ?>

                                  <a href="<?php echo $main_image; ?>" class="cloud-zoom" id="zoom1" rel="useWrapper: false, adjustY:0, adjustX:20">
                                      <img class="zoom-img" src="<?php echo $main_image; ?>">
                                  </a>
                              </div>
                          </div>

                          <div class="col-xs-12 col-sm-7 col-lg-7 col-md-7">
                              <div class="product-details-area">
                                  <div class="product-name">
                                      <h5><?php echo $row->product_name; ?></h5>
                                  </div>
                                  <div class="price-box">
                                      <p class="special-price"> <span class="price-label">Special Price</span> <span class="price"><?php echo $row->currency_symbol; ?> <?php echo number_format($row->product_price); ?></span> </p>
                                      <!--<p class="old-price"> <span class="price-label">Regular Price:</span> <span class="price"> $359.99 </span> </p>-->
                                  </div>
                                  <div class="short-description">
                                      <h6>Please fill the Order Form below and submit</h6>
                                      <form>
                                          <div class="form-group">
                                              <input type="text" class="form-control input input-sm" placeholder="Full Name">
                                          </div>
                                          <div class="form-group">
                                              <input type="email" class="form-control input input-sm" placeholder="E-mail Address">
                                          </div>
                                          <div class="form-group">
                                              <input type="text" class="form-control input input-sm" placeholder="Phone Number">
                                          </div>
                                          <div class="form-group">
                                              <textarea class="form-control" rows="4" placeholder="Describe your order"></textarea>
                                          </div>
                                          <div class="form-group">
                                              <button class="btn btn-sm btn-success pull-right">Submit Order</button>
                                          </div>
                                      </form>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              <?php endforeach; ?>          

 
              <!-- bootstrap js --> 
              <script type="text/javascript" src="<?php echo base_url();?>assets/fe/js/bootstrap.min.js"></script> 

              <!-- flexslider js --> 
              <script type="text/javascript" src="<?php echo base_url();?>assets/fe/js/jquery.flexslider.js"></script> 

              <!-- jquery.mobile-menu js --> 
              <script type="text/javascript" src="<?php echo base_url();?>assets/fe/js/mobile-menu.js"></script> 

              <!-- main js --> 
              <script type="text/javascript" src="<?php echo base_url();?>assets/fe/js/main.js"></script> 
