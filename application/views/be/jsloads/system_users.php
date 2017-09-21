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

                                    $('.datatable table').dataTable();


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
                                        }
                                    });

                                    $(".dataTables_length select").select2({
                                        minimumResultsForSearch: "-1"
                                    });

                                    $(".select2-offscreen").select2({
                                        minimumResultsForSearch: "-1"
                                    });     
                                </script>

                                <div id="div_system_users_loader" style="min-height:2px"></div>
                                <div class="alert alert-danger block-inner" style="display: none;" id="div_system_user_error">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                        Error
                                </div>
                                
                                <div class="alert alert-success block-inner" style="display: none;" id="div_system_user_success">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                        Success
                                </div>

                                <script type="text/javascript">
                                    //load_system_users();
                                </script>
                                <div class="datatable-tools">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Gender</th>
                                                <th>Department</th>
                                                <th>Access Level</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($system_users as $row): ?>
                                                <tr>
                                                    <td><?php echo $row->first_name . ' ' . $row->last_name; ?></td>
                                                    <td><?php echo $row->email_address; ?></td>
                                                    <td><?php echo $row->phone_number; ?></td>
                                                    <td><?php echo $row->gender; ?></td>
                                                    <td><?php echo $row->department_name; ?></td>
                                                    <td><?php echo $row->access_level_name; ?></td>
                                                    <td>
                                                        <a data-toggle="modal" role="button" href="#modal_edit_systemuser" onclick="return system_user_edit_load(<?php echo $row->user_id;?>);" class="label label-success btn-icon"><i class="icon-pencil" title="Edit User"></i></a>
                                                        <a data-toggle="modal" role="button" href="#modal_change_system_user_password" onclick="return change_system_user_password_load(<?php echo $row->user_id;?>);" class="label label-success btn-icon"><i class="icon-eye-blocked2" title="Change User Password"></i></a>
                                                        <a onClick="javascript:return confirm('Do you really wish to delete this System User?');" href="javascript:delete_system_user(<?php echo $row->user_id; ?>);" class="label label-danger btn-icon"><i class="icon-remove3" title="Delete User"></i></a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
