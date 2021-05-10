<div class="br-mainpanel">
    <div class="br-pagetitle">
        <div class="col-md-6">
            <h4><span>        <i class="icon icon ion-ios-book-outline"></i> </span>Commissions</h4>
        </div>
    </div><!-- d-flex -->
    <div class="br-pagebody">
        <div class="br-section-wrapper">  

            <div class="row">
                <div class="col-md-8">
                    <div class="table-responsive">
                        <table class="table datatable-basic table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Order ID</th>
                                    <th>Posted On</th>
                                    <th>Catgeory</th>
                                    <th>No of products</th>    
                                    <th>Total Amount</th>
                                    <th>Commission (%)</th>
                                    <th class="text-right">Commission Amount (Rs)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = $this->Paginator->counter('{:start}');
                                foreach ($commissions as $commission) {
                                    $user = ClassRegistry::init('User')->find('first', array('conditions' => array('user_id' => $commission['Order']['user_id'])));
                                    $category = ClassRegistry::init('Category')->find('first', array('conditions' => array('category_id' => $commission['Order']['category_id'])));
                                    if (!empty($category['Category']['commission_amount'])) {
                                        ?>
                                        <tr class="">
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo "#LeQ" . $commission['Order']['order_id']; ?></td>
                                            <td><?php echo date('d-m-y', strtotime($commission['Order']['created_date'])); ?></td>
                                            <td><?php echo $category['Category']['name']; ?></td>                                  
                                            <td><?php echo $commission['Order']['total_products']; ?></td>
                                            <td><?php echo $commission['Order']['total_amount']; ?></td>
                                            <td><?php echo!empty($category['Category']['commission_amount']) ? $category['Category']['commission_amount'] . "%" : "-" ?></td>
                                            <td>
                                                <?php
                                                $total_commission = ($commission['Order']['total_amount'] * $category['Category']['commission_amount'] / 100);
                                                setlocale(LC_MONETARY, 'en_IN');
                                                echo "Rs. " . money_format('%!i', $total_commission);
                                                $catgeory_commission = $catgeory_commission + $total_commission;
                                                ?>
                                            </td>
                                        </tr>
                                        <?php
                                    }
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
                <div class="col-md-4">
                    <div class="thumbnail">
                        <div class="caption">                                  

                            <h5 style="color: #fff;text-align: center;margin-top: 15px;">Total Commission Amount</h5>

                            <h3 style="margin: 0;font-size: 40px;line-height: 16px;color: #fff;text-align: center;margin-top: 40px;margin-bottom: 20px;">                                             
                                <?php
                                setlocale(LC_MONETARY, 'en_IN');
                                $amt = !empty($catgeory_commission) ? round($catgeory_commission) : '0';
                                echo "Rs. " . money_format('%!i', $amt);
                                ?>
                            </h3>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<style>
    .col-md-7 .table tr td {
        border: unset;
    }.thumbnail {
        padding: 3px;
        margin-bottom: 20px;
        line-height: 1.5384616;
        border: 1px solid #bfbebe;
    }.thumbnail .caption {
        padding: 17px;
        padding-top: 17px;
        padding-top: 20px;
    }.caption {
        background: linear-gradient(87deg, #313131 0, #000 100%) !important;
        color: #fff;
    }.col-md-7 .table {
        margin: 0px;
    }.nav-tabs .nav-link.active, .nav-tabs .nav-item.show .nav-link{
        background-image: linear-gradient(to right, #2f2e2ebf 0%, #000 100%);
        color: #fff !important;
    }.tab-content > .tab-pane{
        padding-top: 20px;
    }.col-md-5 .table tbody tr th, .col-md-5 .table tbody tr td {

        border-top: unset;
        border-bottom: 1px solid #ddd;

    }.order-list-tabel td {
        color: #626262;
    }.caption table td h3 {
        color: #fff;
    }.Processing {
        background:blue;
        color: #fff;
        padding: 0px 10px;
    }.Cancelled{
        background:red;
        color: #fff;
        padding: 0px 10px;
    }.Shipping {
        background:#ff3559;
        color: #fff;
        padding: 0px 10px;
    }.Confirmed {
        background:#12d202;
        color: #fff;
        padding: 0px 10px;
    }.Delivered {
        background:yellow;
        color: #000;
        padding: 0px 10px;
    }.table-bordered > thead > tr > th{
        white-space: nowrap;
    }
</style>
