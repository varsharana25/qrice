<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-size-18">Users</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="<?php echo BASE_URL; ?>admin/adminusers/dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item active">Users</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>     
        <div class="card">
            <div class="card-body">
                <a class="btn btn-danger float-right" href="<?php echo BASE_URL; ?>admin/adminusers/add">Add <i class="fa fa-plus"></i></a>
                <form method="get" action="<?php echo BASE_URL; ?>admin/adminusers/index" class="form-inline">
                    <div class="form-group">
                        <input type="text" value="<?php echo isset($_REQUEST['s']) ? $_REQUEST['s'] : "" ?>" class="form-control validate[required]" name="s" placeholder="Search"/>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-danger top-search" name="search" type="submit">Search</button>
                        <?php if (isset($_REQUEST['search'])) { ?><a class="btn btn-warning" href="<?php echo BASE_URL; ?>admin/adminusers/index">Cancel</a><?php } ?> 
                    </div>
                </form>
            </div>
        </div>
        <!-- end page title -->
        <?php if (!empty($adminusers)) { ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="">
                        <div class="table-responsive">
                            <table class="table project-list-table table-nowrap table-centered table-borderless">

                                <thead class="thead-colored thead-dark">  
                                    <tr>
                                        <th> S. No </th>
                                        <th> Name </th>
                                        <th> Email ID </th>
                                        <th> Mobile </th>
                                        <th> Role </th>
                                        <th> Status </th>
                                        <th> Actions </th>
                                    </tr>
                                </thead>
                                <?php
                                $i = 1;
                                foreach ($adminusers as $adminusers) {
                                    ?>
                                    <tr>
                                        <td>
                                            <?php echo $i; ?>
                                        </td>
                                        <td><?php echo $adminusers['Adminuser']['adminname']; ?></td>
                                        <td><?php echo $adminusers['Adminuser']['email']; ?></td>
                                        <td><?php echo $adminusers['Adminuser']['mobile']; ?></td>
                                        <td><?php echo $adminusers['Adminuser']['roll'] ?></td>
                                        <td>   
                                            <a data-toggle="modal" title="Update Status"  class="green label label-<?php echo $adminusers['Adminuser']['status']; ?>" data-status="<?php echo $adminusers['Adminuser']['status']; ?>" data-id="<?php echo $adminusers['Adminuser']['admin_id']; ?>" href="javascript:;" data-toggle="modal" data-target="#updatestaffstatus">
                                                <?php
                                                if ($adminusers['Adminuser']['status'] == "Active") {
                                                    echo "Approved";
                                                } else if ($adminusers['Adminuser']['status'] == "Inactive") {
                                                    echo"Rejected";
                                                } else if ($adminusers['Adminuser']['status'] == "Pending") {
                                                    echo"Pending";
                                                }
                                                ?>
                                            </a>
                                        </td>  
                                        <td>
                                            <div class="btn btn-group">
                                                <?php echo $this->Html->link('<i class="fas fa-pencil-alt"></i>', array('action' => 'edit/' . $adminusers['Adminuser']['admin_id']), array('escape' => false, 'class' => 'btn btn-outline-info')); ?>
                                                <?php echo $this->Html->link('<i class="fa fa-trash"></i>', array('action' => 'delete/' . $adminusers['Adminuser']['admin_id']), array('escape' => false, 'class' => 'confirmdel green  btn btn-outline-info')); ?>
                                                <a  title="Reset Password" class="btn btn-outline-info" data-toggle="modal" data-target="#restpassword" data-password="<?php echo $adminusers['Adminuser']['password_text']; ?>" data-id="<?php echo $adminusers['Adminuser']['admin_id']; ?>"><i class="fa fa-history"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                    $i++;
                                }
                                ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-12">
                    <ul class="pagination pagination-rounded justify-content-center mt-4">
                        <?php
                        echo $this->Paginator->prev('<i class="mdi mdi-chevron-left"></i>', array('tag' => 'li', 'class' => 'page-link', 'escape' => false), '<a><i class="mdi mdi-chevron-left"></i></a>', array('class' => 'prev disabled page-link', 'tag' => 'li', 'escape' => false));
                        $numbers = $this->Paginator->numbers();
                        if (empty($numbers)) {
                            echo '<li class="active page-link"><a>1</a></li>';
                        } else {
                            echo $this->Paginator->numbers(array('separator' => '', 'tag' => 'li', 'class' => 'page-link', 'first' => 'First page', 'currentClass' => 'active', 'currentTag' => 'a'));
                        }
                        echo $this->Paginator->next('<i class="mdi mdi-chevron-right"></i>', array('tag' => 'li', 'class' => 'page-link', 'escape' => false), '<a><i class="mdi mdi-chevron-right"></i></a>', array('class' => 'next disabled page-link', 'tag' => 'li', 'escape' => false));
                        ?>
                    </ul>
                </div> <!-- end col-->
            </div>
        <?php } else { ?>
            <div class="no-data text-center">
                <img src="<?php echo BASE_URL; ?>img/no-data.png"/>
            </div>
        <?php } ?>
        <!-- end row -->
    </div> <!-- container-fluid -->
</div>

<div class="modal fade effect-flip-vertical" id="updatestaffstatus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="display: block;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Update Status</h4>
            </div>
            <form method="post" action="<?php echo BASE_URL; ?>adminusers/staffstatus">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Staff Status</label>
                        <select class="form-control" name="data[Adminuser][status]" id="product-avail">
                            <option value="">---Select---</option>
                            <option value="Pending">Pending</option>
                            <option value="Active">Approved</option>
                            <option value="Inactive">Reject</option>
                        </select>

                        <input type="hidden" name="data[Adminuser][admin_id]" id="product-id"/>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form> 
        </div>
    </div>
</div>
<div class="modal fade effect-flip-vertical" id="restpassword" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="display: block;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Update Status</h4>
            </div>
            <form method="post" action="<?php echo BASE_URL; ?>adminusers/staffpassword">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="data[Adminuser][password]" class="form-control"  id="staff-password"/>
                        <input type="hidden" name="data[Adminuser][admin_id]"  id="staff-id"/>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form> 
        </div>
    </div>
</div>
<script>
    $('#updatestaffstatus').on('shown.bs.modal', function(event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var modal = $(this)
        modal.find('#product-id').val(button.attr('data-id'));
        modal.find('#product-avail').val(button.attr('data-status'));
    });
    $('#restpassword').on('shown.bs.modal', function(event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var modal = $(this)
        modal.find('#staff-password').val(button.attr('data-password'));
        modal.find('#staff-id').val(button.attr('data-id'));
    });
</script>

