<div class="br-mainpanel">
    <div class="br-pagetitle">        
        <div class="col-md-6">
            <h4><span><i class="icon icon ion-ios-book-outline"></i> </span>Withdraw form wallet</h4>
        </div>     
    </div><!-- d-flex -->
    <?php
    $vendors = ClassRegistry::init('Vendor')->find('first', array('conditions' => array('vendor_id' => $this->Session->read('Vendor.vendor_id'))));
    ?>
    <div class="br-pagebody">
        <div class="br-section-wrapper">  
            <div class="row">
                <div class="col-md-4">
                    <form method="post" action="#" class="validation_form" enctype="multipart/form-data">
                        <div class="row mg-t-20">
                            <label class="col-sm-12 form-control-label">My Balance amount in wallet (Rs) : <span class="tx-danger">*</span></label>
                            <div class="col-sm-12 mg-t-10 mg-sm-t-0">
                                <?php
                                setlocale(LC_MONETARY, 'en_IN');
                                $amount = money_format('%!i', $vendors['Vendor']['wallet']);
                                ?>
                                <input type="text" value="<?php echo $amount ?>" class="form-control" name="data[Widthdraw][vendorbalnce]" readonly=""/>
                            </div>
                        </div><!-- row -->  
                        <div class="row mg-t-20">
                            <label class="col-sm-12 form-control-label">Enter Amount: <span class="tx-danger">*</span></label>
                            <div class="col-sm-12 mg-t-10 mg-sm-t-0">                            
                                <input type="text" class="form-control" name="data[Withdraw][amount]"/>
                            </div>
                        </div><!-- row -->    
                        <div class="row mg-t-20">
                            <div class="col-sm-12 mg-t-10 mg-sm-t-0">
                                <button class="btn btn-info" type="submit"> <i class="ace-icon fa fa-check bigger-110"></i> Submit </button>                     
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-8">
                    <h5>My withdrawels</h5>
                    <div class="table-responsive">
                        <table class="table datatable-basic table-bordered">
                            <thead class="thead-colored thead-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Amount</th>                          
                                    <th>Status</th>
                                    <th>Requested On</th>                 
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = $this->Paginator->counter('{:start}');
                                foreach ($withdraws as $withdraw) {
                                    ?>
                                    <tr class="">
                                        <td><?php echo $i; ?></td>
                                        <?php
                                        setlocale(LC_MONETARY, 'en_IN');
                                        $amount = money_format('%!i', $withdraw['Withdraw']['withraw_amount']);
                                        ?>
                                        <td><?php echo $withdraw['Withdraw']['withraw_amount']; ?></td>                     
                                        <td><label class="<?php echo $withdraw['Withdraw']['status']; ?>"><?php echo $withdraw['Withdraw']['status']; ?></label></td>
                                        <td><?php echo date('d-m-y', $withdraw($order['Withdraw']['created_date'])); ?></td>                           
                                    </tr>
                                    <?php
                                    $i++;
                                }
                                ?>
                            </tbody>
                        </table>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>