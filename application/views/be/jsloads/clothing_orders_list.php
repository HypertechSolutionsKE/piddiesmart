                                <script type="text/javascript">

                                    $.extend( $.fn.dataTable.defaults, {
                                        autoWidth: false,
                                        pagingType: 'full_numbers',
                                        dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
                                        language: {
                                            search: '<span>Filter:</span> _INPUT_',
                                            lengthMenu: '<span>Show:</span> _MENU_',
                                            paginate: { 'first': 'First', 'last': 'Last', 'next': '>', 'previous': '<' }
                                        }
                                    });

                                    //===== Default datatable =====//

                                    $('.datatable table').dataTable({ 
                                        order: [[0, 'desc']] 
                                    });


                                    $('.datatable-tools table').dataTable({
                                        dom: '<"datatable-header"Tfl>t<"datatable-footer"ip>',
                                        tableTools: {
                                            sRowSelect: "single",
                                            sSwfPath: "media/swf/copy_csv_xls_pdf.swf",
                                            aButtons: [
                                                {
                                                    sExtends:    'copy',
                                                    sButtonText: 'Copy',
                                                    sButtonClass: 'btn btn-default'
                                                },
                                                {
                                                    sExtends:    'print',
                                                    sButtonText: 'Print',
                                                    sButtonClass: 'btn btn-default'
                                                },
                                                {
                                                    sExtends:    'collection',
                                                    sButtonText: 'Save <span class="caret"></span>',
                                                    sButtonClass: 'btn btn-primary',
                                                    aButtons:    [ 'csv', 'xls', 'pdf' ]
                                                }
                                            ]
                                        },                                        
                                        order: [[4, 'desc']]
                                    });

                                    $(".dataTables_length select").select2({
                                        minimumResultsForSearch: "-1"
                                    });

                                    $(".select2-offscreen").select2({
                                        minimumResultsForSearch: "-1"
                                    });     
                                </script>

                                    <div class="datatable-tools">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Order No</th>
                                                    <th>Product</th>
                                                    <th>Customer</th>
                                                    <th>Order Description</th>
                                                    <th>Date</th>                                                
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php foreach ($orders as $row): ?>
                                                    <?php if ($row->is_deleted == 1): ?>
                                                        <tr style="color: #999999 !important;">
                                                    <?php else: ?>
                                                        <tr>
                                                    <?php endif; ?>
                                                        <td>
                                                            <a href="<?php echo base_url(); ?>be/orders/clothing_order_view/<?php echo $row->order_id; ?>"><b><?php echo $row->order_reference_id; ?></b></a>
                                                        </td>
                                                        <td><?php echo $row->product_name; ?></td>
                                                        <td><b>Name:</b> <?php echo $row->customer_name; ?><br />
                                                        <b>Phone:</b>  <?php echo $row->phone_number; ?><br />
                                                        <b>Email:</b> <?php echo $row->email_address; ?></td>
                                                        <td><?php echo $row->order_description; ?></td>
                                                        <td><?php echo $row->created_on; ?></td>                                                        
                                                        <td>
                                                            <?php if ($row->is_deleted == 1): ?>
                                                                <span class="label label-primary">Cancelled</span>
                                                            <?php else: ?>
                                                                <?php if ($row->order_status == 0): ?>
                                                                    <span class="label label-success">Unread</span>
                                                                <?php elseif ($row->order_status == 1): ?>
                                                                    <span class="label label-danger">Pending</span>
                                                                <?php elseif ($row->order_status == 2): ?>
                                                                    <span class="label label-danger">Processing</span>
                                                                <?php elseif ($row->order_status == 3): ?>
                                                                    <span class="label label-danger">Completed</span>
                                                                <?php endif; ?>
                                                            <?php endif; ?>                                
                                                        </td>

<!--                                                         <td>
                                                            <?php if($row->main_image != '' && file_exists("./uploads/order_images/" . $row->main_image)): ?>
                                                                <img class="table-image" src="<?php echo base_url();?>uploads/order_images/<?php echo $row->main_image; ?>" alt="">
                                                            <?php endif; ?>
                                                        </td>
 -->                                                    <td>
                                                            <div class="btn-group">
                                                                <button class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown"><i class="icon-cogs"></i> <span class="caret"></span></button>
                                                                <ul class="dropdown-menu dropdown-menu-right icons-right">
                                                                    <?php if ($row->is_deleted != 1): ?>                            
                                                                        <li><a href="<?php echo base_url(); ?>be/orders/clothing_order_view/<?php echo $row->order_id; ?>"><i class="icon-pencil"></i> View Order</a></li>
                                                                        <?php if ($row->order_status == 'Offline'): ?>
                                                                            <li><a onClick="javascript:return confirm('Do you really wish to set this order as Online?');" href="javascript:set_online(<?php echo $row->order_id; ?>,'Clothing');"><i class="icon-switch text-primary"></i> Set Online</a></li>
                                                                        <?php else: ?>
                                                                            <li><a onClick="javascript:return confirm('Do you really wish to set this order as Offline?');" href="javascript:set_offline(<?php echo $row->order_id; ?>,'Clothing');"><i class="icon-switch text-success"></i> Set Offline</a></li>
                                                                         <?php endif; ?>

<!--                                                                         <li><a onClick="javascript:return confirm('Do you really wish to delete this order?');" href="javascript:delete_order(<?php echo $row->order_id; ?>,'Clothing');"><i class="icon-remove3"></i> Delete order</a></li> 
 -->                                                                         
                                                                    <?php else: ?>
                                                                        <li><a onClick="javascript:return confirm('Do you really wish to restore this Order?');" href="javascript:restore_order(<?php echo $row->order_id; ?>,'Clothing');"><i class="icon-redo"></i> Restore Order</a></li>  

                                                                    <?php endif; ?>

                                                                </ul>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
