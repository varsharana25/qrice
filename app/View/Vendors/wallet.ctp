<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h5 class="mb-0 font-size-18">Withdrawals</h5>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="<?php echo BASE_URL; ?>vendors/dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item active">Withdrawals</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-9 match">
                <div class="card">
                    <div class="card-body">
                        <?php if (!empty($requests)) { ?>
                            <div class="table-responsive">
                                <table class="table project-list-table table-nowrap table-centered table-borderless">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>ID</th>                          
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
                                                <td>Rs. <?php echo $request['Withdrawrequest']['requested_amount']; ?></td>
                                                <td><?php echo date('d-m-Y', strtotime($request['Withdrawrequest']['requested_on'])); ?></td>
                                                <td><?php echo $request['Withdrawrequest']['bank_details']; ?></td>
                                                <td><label class="badge badge-<?php echo $request['Withdrawrequest']['status']; ?>"><?php echo $request['Withdrawrequest']['status']; ?></label></td>
                                                <td>Rs. <?php echo (!empty($request['Withdrawrequest']['paid_amount'])) ? $request['Withdrawrequest']['paid_amount'] : "0" ?></td>
                                                <td><?php echo ($request['Withdrawrequest']['status'] == 'Paid') ? date('d-m-Y', strtotime($request['Withdrawrequest']['paid_on'])) : "-" ?></td>
                                                <td>
                                                    <?php if ($request['Withdrawrequest']['status'] == 'Pending') { ?>
                                                        <div class="btn-group">
                                                            <a class="btn btn-outline-info" href="<?php echo BASE_URL; ?>vendors/wallet/<?php echo $request['Withdrawrequest']['request_id']; ?>"><i class="fa fa-edit"></i></a>
                                                            <a class="btn btn-outline-info delconfirm" href="<?php echo BASE_URL; ?>vendors/deleterequest/<?php echo $request['Withdrawrequest']['request_id']; ?>"><i class="fa fa-trash"></i></a>
                                                        </div>
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
            <div class="col-lg-3 match">
                <div class="card">
                    <div class="card-body">
                        <h4 style="margin:0px;">
                            Wallet Amount - 
                            <?php
                            echo 'Rs. ' . $sessionvendor['Vendor']['wallet_amount'];
                            ?>
                        </h4>
                        <hr/>
                        <form method="POST" action="#" class="validation_form">
                            <div class="form-group">
                                <label>Amount</label>
                                <input type="text" max="<?php echo $sessionvendor['Vendor']['wallet_amount']; ?>" class="form-control validate[required]" name="data[Withdrawrequest][requested_amount]" placeholder="Enter Request Amount" value="<?php echo (!empty($this->request->data['Withdrawrequest']['requested_amount'])) ? $this->request->data['Withdrawrequest']['requested_amount'] : "" ?>"/>
                            </div>
                            <div class="form-group">
                                <label>Bank Acc Details</label>
                                <textarea class="form-control validate[required]" name="data[Withdrawrequest][bank_details]" placeholder="Enter Bank Acc Details"><?php echo (!empty($this->request->data['Withdrawrequest']['bank_details'])) ? $this->request->data['Withdrawrequest']['bank_details'] : "" ?></textarea>
                                <input type="hidden" name="data[Withdrawrequest][request_id]" value="<?php echo (!empty($this->request->data['Withdrawrequest']['request_id'])) ? $this->request->data['Withdrawrequest']['request_id'] : "" ?>"/>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-danger">SUBMIT</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
