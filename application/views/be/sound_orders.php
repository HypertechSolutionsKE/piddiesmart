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
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h6 class="panel-title" style="margin-top: 5px"><i class="icon-cart5"></i> Sound Orders</h6>
                        </div>
                        <div class="panel-body">
                            <div id="">
                                <div class="alert alert-danger block-inner" style="display: none;" id="div_order_error">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                        Error
                                </div>
                                
                                <div class="alert alert-success block-inner" style="display: none;" id="div_order_success">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                        Success
                                </div>
                                <div class="alert alert-info">
                                    <form class="validate" method="post" role="form" id="frm_soundordersfilter" name="frm_soundordersfilter" onsubmit="return filter_sound_orders();" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-md-2">
                                                 <div class="form-group">
                                                    <label>From (yyyy-mm-dd):</label>
                                                    <input type="text" class="datepicker form-control" name="order_date_from" id="sou_order_date_from">
                                                </div>                                    
                                            </div>
                                            <div class="col-md-2">
                                                 <div class="form-group">
                                                    <label>To (yyyy-mm-dd):</label>
                                                    <input type="text" class="datepicker form-control" name="order_date_to" id="sou_order_date_to">
                                                    </select> 
                                                </div>                                    
                                            </div>

                                            <div class="col-sm-8">
                                                 <div class="form-group">
                                                    <label>Order Status:</label>
                                                    <div class="block-inner">
                                                        <label class="radio-inline">
                                                            <input type="radio" name="order_status" id="sou_order_status1" checked="checked" class="styled" value="All">
                                                                All
                                                        </label>                                     
                                                        <label class="radio-inline">
                                                            <input type="radio" name="order_status" id="sou_order_status2" class="styled" value="Unread">
                                                                Unread
                                                        </label>
                                                        <label class="radio-inline">
                                                            <input type="radio" name="order_status" id="sou_order_status3" class="styled" value="Pending">
                                                                Pending
                                                        </label>
                                                        <label class="radio-inline">
                                                            <input type="radio" name="order_status" id="sou_order_status4" class="styled" value="Processing">
                                                                Processing
                                                        </label>

                                                        <label class="radio-inline">
                                                            <input type="radio" name="order_status" id="sou_order_status5" class="styled" value="Completed">
                                                                Completed
                                                        </label>
                                                        <label class="radio-inline">
                                                            <input type="radio" name="order_status" id="sou_order_status6" class="styled" value="Cancelled">
                                                                Cancelled
                                                        </label>

                                                    </div> 
                                                </div>                                    
                                            </div>
                                        </div>

                                        
                                    </form>
                                </div>

                                <!--<hr>-->
                                <div id="sound_orders_div" style="min-height:200px">

                                </div>
                            </div>
                        </div> 
                    </div>                           
                </div>
            </div>

            <!-- /form modal -->
            <script>
                filter_sound_orders();
            </script>

            <!-- Footer -->
            <div class="footer clearfix">
                <div class="pull-left">&copy; <?php echo date('Y');?>. PiddieSmart powered by <a href="http://hypertechsolutions.co.ke">Hypertech Solutions Limited</a></div>
            </div>
            <!-- /footer -->


        </div>
        <!-- /page content -->
