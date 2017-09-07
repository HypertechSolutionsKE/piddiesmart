
  <footer> 
    

    <div class="container" style="padding-top: 60px;text-align: center;">
      <div class="row">
        <div class="col-sm-4">
          <div class="footer-links">
            <h3 class="links-title">Information<a class="expander visible-xs" href="#TabBlock-1">+</a></h3>
            <div class="tabBlock" id="TabBlock-1">
              <ul class="list-links list-unstyled">
                
                <li><a href="#">Terms &amp; Condition</a></li>
              </ul>
            </div>
          </div>
        </div>
         <div class="col-sm-4" style="text-align: left">
          <div class="footer-links">
            <h3 class="links-title">Contact Us<a class="expander visible-xs" href="#TabBlock-3">+</a></h3>
            <div class="tabBlock" id="TabBlock-3">
              <ul class="list-links list-unstyled">
                <li><i class="fa fa-home"></i>Moi Avenue</li>
                  <li><i class="fa fa-phone"></i><span> +254 718 246 853</span></li>
                  <li><i class="fa fa-envelope"></i>Email: <span><a href="mailto:amonkinyua@gmail.com">amonkinyua@gmail.com</a></span></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="footer-links">
          <h3 class="links-title">Social Media</h3>
            
            <div class="social">
              <ul class="inline-mode">
                <li class="social-network fb"><a title="Connect us on Facebook" target="_blank" href="https://www.facebook.com/"><i class="fa fa-facebook"></i></a></li>
                
                <li class="social-network tw"><a title="Connect us on Twitter" target="_blank" href="https://twitter.com/"><i class="fa fa-twitter"></i></a></li>
                
                <li class="social-network rss"><a title="Connect us on Instagram" target="_blank" href="https://instagram.com/"><i class="fa fa-rss"></i></a></li>
              </ul>
            </div>
          </div>
        </div>
       
        
      </div>
    </div>
    <div class="footer-coppyright">
      <div class="container">
        <div class="row">
          <div class="col-sm-6 col-xs-12 coppyright"> Copyright © <?php echo date('Y'); ?> <a href="#"> PiddieSmart </a>. All Rights Reserved. </div>
          <div class="col-sm-6 col-xs-12">
            <div class="payment">
              <ul>
                <li><a href="#"><img title="Visa" alt="Visa" src="<?php echo base_url();?>assets/images/visa.png"></a></li>
                <li><a href="#"><img title="Paypal" alt="Paypal" src="<?php echo base_url();?>assets/images/paypal.png"></a></li>
                <li><a href="#"><img title="Discover" alt="Discover" src="<?php echo base_url();?>assets/images/discover.png"></a></li>
                <li><a href="#"><img title="Master Card" alt="Master Card" src="<?php echo base_url();?>assets/images/master-card.png"></a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <a href="#" class="totop"><i class="fa fa-arrow-up"></i></a> 
  <!-- End Footer --> 
  
  
</div>

<!-- JS -- 
<script type="text/javascript" src="<?php echo base_url();?>assets/js/general.js"></script>
   
<!-- jquery js --> 
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.min.js"></script> 

<!-- bootstrap js --> 
<script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script> 

<!-- Slider Js --> 
<script type="text/javascript" src="<?php echo base_url();?>assets/js/revolution-slider.js"></script> 

<!-- owl.carousel.min js --> 
<script type="text/javascript" src="<?php echo base_url();?>assets/js/owl.carousel.min.js"></script> 

<!-- bxslider js --> 
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.bxslider.js"></script> 

<!-- megamenu js --> 
<script type="text/javascript" src="<?php echo base_url();?>assets/js/megamenu.js"></script> 
<script type="text/javascript">
  /* <![CDATA[ */   
  var mega_menu = '0';
  
  /* ]]> */
  </script> 

<!-- jquery.mobile-menu js --> 
<script type="text/javascript" src="<?php echo base_url();?>assets/js/mobile-menu.js"></script> 

<!--jquery-ui.min js --> 
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-ui.js"></script> 

<!-- main js --> 
<script type="text/javascript" src="<?php echo base_url();?>assets/js/main.js"></script> 

<!-- countdown js --> 
<script type="text/javascript" src="<?php echo base_url();?>assets/js/countdown.js"></script> 

<!-- Revolution slider --> 
<script type="text/javascript">
      var setREVStartSize=function(){};
            
        
      setREVStartSize();
      function revslider_showDoubleJqueryError(sliderID) {}
      var tpj=jQuery;
      tpj.noConflict();
      var revapi6;
      tpj(document).ready(function() {
        if(tpj("#rev_slider_6_1").revolution == undefined){
          revslider_showDoubleJqueryError("#rev_slider_6_1");
        }else{
          revapi6 = tpj("#rev_slider_6_1").show().revolution({
            sliderType:"standard",
            sliderLayout:"auto",
            dottedOverlay:"none",
            delay:6000,
            navigation: {
              keyboardNavigation:"off",
              keyboard_direction: "horizontal",
              mouseScrollNavigation:"off",
              onHoverStop:"off",
              touch:{
                touchenabled:"on",
                swipe_threshold: 0.7,
                swipe_min_touches: 1,
                swipe_direction: "horizontal",
                drag_block_vertical: false
              }
              ,
              arrows: {
                style:"hades",
                enable:true,
                hide_onmobile:false,
                hide_onleave:true,
                hide_delay:200,
                hide_delay_mobile:1200,
                tmp:'<div class="tp-arr-allwrapper">  <div class="tp-arr-imgholder"></div></div>',
                left: {
                  h_align:"left",
                  v_align:"center",
                  h_offset:20,
                  v_offset:0
                },
                right: {
                  h_align:"right",
                  v_align:"center",
                  h_offset:20,
                  v_offset:0
                }
              }
              ,
              bullets: {
                enable:true,
                hide_onmobile:false,
                style:"hades",
                hide_onleave:true,
                hide_delay:200,
                hide_delay_mobile:1200,
                direction:"horizontal",
                h_align:"center",
                v_align:"bottom",
                h_offset:0,
                v_offset:20,
                space:5,
                tmp:'<span class="tp-bullet-image"></span>'
              }
            },
            gridwidth:1920,
            gridheight:750,
            lazyType:"none",
            shadow:0,
            spinner:"spinner0",
            stopLoop:"off",
            stopAfterLoops:-1,
            stopAtSlide:-1,
            shuffle:"off",
            autoHeight:"on",
            disableProgressBar:"on",
            hideThumbsOnMobile:"off",
            hideSliderAtLimit:0,
            hideCaptionAtLimit:0,
            hideAllCaptionAtLilmit:0,
            startWithSlide:0,
            debugMode:false,
            fallbacks: {
              simplifyAll:"off",
              nextSlideOnWindowFocus:"off",
              disableFocusListener:false,
            }
          });
        }
      }); /*ready*/
    </script>
</body>

<!-- Mirrored from htmlsmart.justthemevalley.com/version2/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 23 Aug 2017 10:29:14 GMT -->
</html>
