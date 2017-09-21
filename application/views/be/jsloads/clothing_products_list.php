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
                                                    <th>Product Name</th>
                                                    <th>Category</th>
                                                    <th>Brand</th>
                                                    <th>Price</th>
                                                    <th>Status</th>
                                                    <th>Image</th>                                         
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php foreach ($products as $row): ?>
                                                    <?php if ($row->is_deleted == 1): ?>
                                                        <tr style="color: #999999 !important;">
                                                    <?php else: ?>
                                                        <tr>
                                                    <?php endif; ?>
                                                        <td>
                                                            <?php if ($row->is_deleted == 1): ?>
                                                                <b><?php echo $row->product_name; ?></b><br />
                                                            <b>SKU:</b> <?php echo $row->product_sku_code; ?>
                                                            <?php else: ?>
                                                                <a href="<?php echo base_url(); ?>be/products/clothing_edit_start/<?php echo $row->product_id; ?>"><b><?php echo $row->product_name; ?></b></a><br />
                                                            <b>SKU:</b> <?php echo $row->product_sku_code; ?>
                                                            <?php endif; ?>                                      
                                                        </td>
                                                        <td></td>
                                                        <td><?php echo $row->brand_name; ?></td>
                                                        <td><?php echo $row->currency_symbol . ' ' . number_format($row->product_price); ?></td>
                                                        <td>
                                                            <?php if ($row->is_deleted == 1): ?>
                                                                <span class="label label-primary">Deleted</span>
                                                            <?php else: ?>
                                                                <?php if ($row->product_status == 'Online'): ?>
                                                                    <span class="label label-success"><?php echo $row->product_status; ?></span>
                                                                <?php elseif ($row->product_status == 'Offline'): ?>
                                                                    <span class="label label-danger"><?php echo $row->product_status; ?></span>
                                                                <?php endif; ?>
                                                            <?php endif; ?>                                
                                                        </td>
                                                        <td>
                                                            <?php if($row->main_image != '' && file_exists("./uploads/product_images/" . $row->main_image)): ?>
                                                                <img class="table-image" src="<?php echo base_url();?>uploads/product_images/<?php echo $row->main_image; ?>" alt="">
                                                            <?php endif; ?>
                                                        </td>
                                                        <td>
                                                            <div class="btn-group">
                                                                <button class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown"><i class="icon-cogs"></i> <span class="caret"></span></button>
                                                                <ul class="dropdown-menu dropdown-menu-right icons-right">
                                                                    <?php if ($row->is_deleted != 1): ?>                            
                                                                        <li><a href="<?php echo base_url(); ?>be/products/clothing_edit_start/<?php echo $row->product_id; ?>"><i class="icon-pencil"></i> Edit Product</a></li>
                                                                        <?php if ($row->product_status == 'Offline'): ?>
                                                                            <li><a onClick="javascript:return confirm('Do you really wish to set this Product as Online?');" href="javascript:set_online(<?php echo $row->product_id; ?>,'Clothing');"><i class="icon-switch text-primary"></i> Set Online</a></li>
                                                                        <?php else: ?>
                                                                            <li><a onClick="javascript:return confirm('Do you really wish to set this Product as Offline?');" href="javascript:set_offline(<?php echo $row->product_id; ?>,'Clothing');"><i class="icon-switch text-success"></i> Set Offline</a></li>
                                                                         <?php endif; ?> 

                                                                        <?php if ($row->featured == 'No'): ?>
                                                                            <li><a onClick="javascript:return confirm('Do you really wish to set this Product as Featured?');" href="javascript:set_featured(<?php echo $row->product_id; ?>,'Clothing');"><i class="icon-tags2"></i> Set Featured</a></li>
                                                                        <?php else: ?>
                                                                            <li><a onClick="javascript:return confirm('Do you really wish to unset this Product as Featured?');" href="javascript:unset_featured(<?php echo $row->product_id; ?>,'Clothing');"><i class="icon-tags2"></i> Unset Featured</a></li>
                                                                         <?php endif; ?>

                                                                        <?php if ($row->new_arrival == 'No'): ?>
                                                                            <li><a onClick="javascript:return confirm('Do you really wish to set this Product as New Arrival?');" href="javascript:set_new_arrival(<?php echo $row->product_id; ?>,'Clothing');"><i class="icon-star"></i> Set New Arrival</a></li>
                                                                        <?php else: ?>
                                                                            <li><a onClick="javascript:return confirm('Do you really wish to unset this Product as New Arrival?');" href="javascript:unset_new_arrival(<?php echo $row->product_id; ?>,'Clothing');"><i class="icon-star"></i> Unset New Arrival</a></li>
                                                                         <?php endif; ?>

                                                                        <?php if ($row->special_offer == 'No'): ?>
                                                                            <li><a onClick="javascript:return confirm('Do you really wish to set this Product as Special Offer?');" href="javascript:set_special_offer(<?php echo $row->product_id; ?>,'Clothing');"><i class="icon-wand"></i> Set Special Offer</a></li>
                                                                        <?php else: ?>
                                                                            <li><a onClick="javascript:return confirm('Do you really wish to unset this Product as Special Offer?');" href="javascript:unset_special_offer(<?php echo $row->product_id; ?>,'Clothing');"><i class="icon-wand"></i> Unset Special Offer</a></li>
                                                                         <?php endif; ?>

                                                                        <?php if ($row->deal_of_the_week == 'No'): ?>
                                                                            <li><a onClick="javascript:return confirm('Do you really wish to set this Product as Deal of the Week?');" href="javascript:set_deal_of_the_week(<?php echo $row->product_id; ?>,'Clothing');"><i class="icon-king"></i> Set Deal of the Week</a></li>
                                                                        <?php else: ?>
                                                                            <li><a onClick="javascript:return confirm('Do you really wish to unset this Product as Deal of the Week?');" href="javascript:unset_deal_of_the_week(<?php echo $row->product_id; ?>,'Clothing');"><i class="icon-king"></i> Unset Deal of the Week</a></li>
                                                                         <?php endif; ?>

                                                                        <li><a onClick="javascript:return confirm('Do you really wish to delete this Product?');" href="javascript:delete_product(<?php echo $row->product_id; ?>,'Clothing');"><i class="icon-remove3"></i> Delete Product</a></li>  
                                                                    <?php else: ?>
                                                                        <li><a onClick="javascript:return confirm('Do you really wish to restore this Product?');" href="javascript:restore_product(<?php echo $row->product_id; ?>,'Clothing');"><i class="icon-redo"></i> Restore Product</a></li>  

                                                                    <?php endif; ?>

                                                                </ul>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
