<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h5 class="mb-0 font-size-18">Withdrawals</h5>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="<?php echo BASE_URL; ?>admin/adminusers/dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item active">Withdrawals</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 match">
                <div class="card">
                    <div class="card-body">
                        <?php if (!empty($requests)) { ?>
                            <div class="table-responsive">
                                <table class="table project-list-table table-nowrap table-centered table-borderless">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>ID</th>
                                            <th width='100px'></th>
                                            <th>Vendor</th>
                                            <th>Requested Amount</th>
                                            <th>Requested  On</th>
                                            <th>Bank Details</th>
                                            <th>Status</th>
                                            <th>Paid Amount</th>
                                            <th>Paid On</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = $this->Paginator->counter('{:start}');
                                        foreach ($requests as $request) {
                                            ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $request['Withdrawrequest']['requestid']; ?></td>
                                                <th><img src="<?php echo BASE_URL; ?><?php echo $request['Vendor']['vendor_path']; ?>/<?php echo $request['Vendor']['shop_logo'] ?>" class="avatar-sm" onerror="src='<?php echo BASE_URL; ?>img/noimg.png'"/></th>
                                                <td><?php echo $request['Vendor']['shop_name']; ?> - <?php echo $request['Vendor']['full_name']; ?> </td>
                                                <td>Rs. <?php echo $request['Withdrawrequest']['requested_amount']; ?></td>
                                                <td><?php echo date('d-m-Y', strtotime($request['Withdrawrequest']['requested_on'])); ?></td>
                                                <td><?php echo $request['Withdrawrequest']['bank_details']; ?></td>
                                                <td><label class="badge badge-<?php echo $request['Withdrawrequest']['status']; ?>"><?php echo $request['Withdrawrequest']['status']; ?></label></td>
                                                <td>Rs. <?php echo (!empty($request['Withdrawrequest']['paid_amount'])) ? $request['Withdrawrequest']['paid_amount'] : "0" ?></td>
                                                <td><?php echo ($request['Withdrawrequest']['status'] == 'Paid') ? date('d-m-Y', strtotime($request['Withdrawrequest']['paid_on'])) : "-" ?></td>
                                                <td>
                                                    <?php if ($request['Withdrawrequest']['status'] == 'Pending') { ?>
                                                        <a class="btn btn-sm btn-danger" data-toggle="modal" data-target="#pay" data-id="<?php echo $request['Withdrawrequest']['request_id']; ?>">Pay</a>
                                                        <a class="btn btn-sm btn-warning" href="<?php echo BASE_URL; ?>admin/vendors/removewithdrawals/<?php echo $request['Withdrawrequest']['request_id']; ?>">Reject</a>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                            <?php
                                            $i++;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="dataTables_info" id="sample-table-2_info" role="status" aria-live="polite">
                                        <?php
                                        echo $this->Paginator->counter(array(
                                            'format' => __('Page') . ' {:page} ' . __('of') . ' {:pages}, ' . __('showing') . ' {:current} ' . __('records out of') . ' {:count} ' . __('entries')
                                        ));
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="dataTables_paginate paging_simple_numbers pull-right" id="sample-table-2_paginate">
                                        <ul class="pagination">
                                            <?php
                                            echo $this->Paginator->prev('<i class="fa fa-angle-left"></i>', array('tag' => 'li', 'class' => 'page-link', 'escape' => false), '<a><i class="fa fa-angle-left"></i></a>', array('class' => 'prev disabled page-link', 'tag' => 'li', 'escape' => false));
                                            $numbers = $this->Paginator->numbers();
                                            if (empty($numbers)) {
                                                echo '<li class="active page-link"><a>1</a></li>';
                                            } else {
                                                echo $this->Paginator->numbers(array('separator' => '', 'tag' => 'li', 'class' => 'page-link', 'first' => 'First page', 'currentClass' => 'active', 'currentTag' => 'a'));
                                            }
                                            echo $this->Paginator->next('<i class="fa fa-angle-right"></i>', array('tag' => 'li', 'class' => 'page-link', 'escape' => false), '<a><i class="fa fa-angle-right"></i></a>', array('class' => 'next disabled page-link', 'tag' => 'li', 'escape' => false));
                                            ?>
                                        </ul>
                                    </div> 
                                </div>
                            </div>
                        <?php } else { ?>
                            <div class="no-data text-center">
                                <img src="<?php echo BASE_URL; ?>img/no-data.png"/>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="pay" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Pay</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form method="POST" action="#">
                <div class="modal-body">
                    <textarea class="form-control" name="data[Withdrawrequest][paid_notes]"></textarea>
                    <input type="hidden" class="form-control" name="data[Withdrawrequest][request_id]" id="request_id"/>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">SUBMIT</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $('#pay').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var modal = $(this)
        modal.find('#request_id').val(button.attr('data-id'));
    });
</script>