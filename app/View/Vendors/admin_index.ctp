<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-size-18">Vendors</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="<?php echo BASE_URL; ?>admin/adminusers/dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item active">Vendors</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>     
        <div class="row">
            <div class="col-xl-12  manage">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card mini-stats-wid">
                            <div class="card-body">
                                <div class="media">
                                    <div class="media-body">
                                        <p class="text-muted font-weight-medium">Approved</p>
                                        <h4 class="mb-0"><?php echo $approved; ?></h4>
                                    </div>

                                    <div class="mini-stat-icon avatar-sm rounded-circle bg-primary align-self-center">
                                        <span class="avatar-title">
                                            <i class="bx bx-copy-alt font-size-24"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card mini-stats-wid">
                            <div class="card-body">
                                <div class="media">
                                    <div class="media-body">
                                        <p class="text-muted font-weight-medium">Pending</p>
                                        <h4 class="mb-0"><?php echo $pending; ?></h4>
                                    </div>

                                    <div class="avatar-sm rounded-circle bg-primary align-self-center mini-stat-icon">
                                        <span class="avatar-title rounded-circle bg-primary">
                                            <i class="bx bx-archive-in font-size-24"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card mini-stats-wid">
                            <div class="card-body">
                                <div class="media">
                                    <div class="media-body">
                                        <p class="text-muted font-weight-medium">Rejected</p>
                                        <h4 class="mb-0"><?php echo $rejected; ?></h4>
                                    </div>
                                    <div class="avatar-sm rounded-circle bg-primary align-self-center mini-stat-icon">
                                        <span class="avatar-title rounded-circle bg-primary">
                                            <i class="bx bx-purchase-tag-alt font-size-24"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->

            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <form method="get" action="<?php echo BASE_URL; ?>admin/vendors/index" class="form-inline">
                    <div class="form-group">
                        <input type="text" value="<?php echo isset($_REQUEST['s']) ? $_REQUEST['s'] : "" ?>" class="form-control validate[required]" name="s" placeholder="Search"/>
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="category_id">
                            <option value="">All Business Categories</option>
                            <?php
                            $categories = ClassRegistry::init('Category')->find('all');
                            foreach ($categories as $category) {
                                ?>
                                <option <?php echo (!empty($_REQUEST['category_id']) && $_REQUEST['category_id'] == $category['Category']['category_id']) ? 'selected' : '' ?> value="<?php echo $category['Category']['category_id']; ?>"><?php echo $category['Category']['name']; ?></option>
                            <?php }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-danger top-search" name="search" type="submit">Search</button>
                        <?php if (isset($_REQUEST['search'])) { ?><a class="btn btn-warning" href="<?php echo BASE_URL; ?>admin/vendors/index">Cancel</a><?php } ?> 
                    </div>
                </form>
            </div>
        </div>
        <?php if (!empty($vendors)) { ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="">
                        <div class="table-responsive">
                            <table class="table project-list-table table-nowrap table-centered table-borderless">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Shop Logo</th>
                                        <th>Shop Name</th>
                                        <th>Business category</th>
                                        <th>Mobile</th>
                                        <th>Email</th>
                                        <th>Location</th>
                                        <th>District</th>                     
                                        <th>Reg Date</th>
                                        <th>Status</th>
                                        <th  class="text-right"><?php echo __('Actions'); ?></th>
                                    </tr>
                                </thead>
                                <tbody class="image-logo">
                                    <?php
                                    $i = $this->Paginator->counter('{:start}');
                                    foreach ($vendors as $vendor) {
                                        ?>
                                        <tr>
                                            <td><?php echo h($i); ?></td>

                                            <td>
                                                <?php echo (!empty($vendor['Vendor']['full_name'])) ? $vendor['Vendor']['full_name'] : "-"; ?>
                                            </td>
                                            <td class="text-center">
                                                <img src="<?php echo BASE_URL; ?><?php echo $vendor['Vendor']['vendor_path'] . '/' . $vendor['Vendor']['shop_logo']; ?>" class="avatar-sm" onerror="src='<?php echo BASE_URL; ?>img/noimg.png'"/>
                                            </td>
                                            <td>
                                                <?php echo (!empty($vendor['Vendor']['shop_name'])) ? $vendor['Vendor']['shop_name'] : "-" ?>
                                            </td>
                                            <td>
                                                <?php echo (!empty($vendor['Category']['name'])) ? $vendor['Category']['name'] : "-" ?>
                                            </td>
                                            <td>
                                                <?php echo (!empty($vendor['Vendor']['mobile'])) ? $vendor['Vendor']['mobile'] : "-" ?>
                                            </td>
                                            <td>
                                                <?php echo (!empty($vendor['Vendor']['email'])) ? $vendor['Vendor']['email'] : "-" ?>
                                            </td>
                                            <td>
                                                <?php echo (!empty($vendor['Vendor']['location'])) ? $vendor['Vendor']['location'] : "-" ?>
                                            </td>
                                            <td>
                                                <?php echo (!empty($vendor['Vendor']['district'])) ? $vendor['Vendor']['district'] : "-" ?>
                                            </td>
                                            <td>
                                                <?php echo date('d-m-Y', strtotime($vendor['Vendor']['created_date'])); ?>
                                            </td>
                                            <td>
                                                <a data-toggle="modal" title="Update Status" data-commission="<?php echo!empty($vendor['Vendor']['commission_amount']) ? $vendor['Vendor']['commission_amount'] : ""; ?>" data-status="<?php echo $vendor['Vendor']['status']; ?>" data-id="<?php echo $vendor['Vendor']['vendor_id']; ?>" href="javascript:;" data-toggle="modal" data-target="#updatestatus" class="label label-<?php echo $vendor['Vendor']['status']; ?>">
                                                    <?php
                                                    echo $vendor['Vendor']['status'];
                                                    ?>
                                                </a>
                                            </td>
                                            <td class="text-right">
                                                <div class="btn-group">        
                                                    <a href="<?php echo BASE_URL; ?>admin/vendors/view/<?php echo $vendor['Vendor']['vendor_id']; ?>" class="btn btn-outline-info" title="View">   
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                    <a href="<?php echo BASE_URL; ?>admin/vendors/delete/<?php echo $vendor['Vendor']['vendor_id']; ?>" class="delconfirm btn btn-outline-info" title="Delete">   
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                </div>
                                            </td>

                                        </tr>
                                        <?php
                                        $i++;
                                    }
                                    ?>
                                </tbody>
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
<!-- End Page-content -->
<div class="modal fade" id="updatestatus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="display: block;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Update Status</h4>
            </div>
            <form method="post" action="<?php echo BASE_URL; ?>admin/vendors/updatestatus">
                <div class="modal-body">
                    <div class="form-group">
                        <select class="form-control" name="data[Vendor][status]" id="vendor-status">
                            <option value="Pending">Pending</option>
                            <option value="Approved">Approved</option>
                            <option value="Rejected">Rejected </option>
                        </select>                       
                        <input type="hidden" name="data[Vendor][vendor_id]" id="vendor-id"/>
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
    $('#updatestatus').on('shown.bs.modal', function(event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var modal = $(this)
        modal.find('#vendor-commission').val(button.attr('data-commission'));
        modal.find('#vendor-id').val(button.attr('data-id'));
        modal.find('#vendor-status').val(button.attr('data-status'));
    });
</script>