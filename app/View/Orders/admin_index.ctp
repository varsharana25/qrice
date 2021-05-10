<div id="page_content">
    <div id="page_content_inner">
        <div class="md-card">
            <div class="md-card-content clearfix">
                <div class="uk-grid" data-uk-grid-margin="" data-uk-grid-match="{target:'.md-card'}">
                    <div class="uk-width-medium-8-10 uk-row-first">
                        <h3 class="heading_a">Order List</h3>
                    </div>
                    <div class="search">
                    <form method="get" action="<?php echo BASE_URL;?>admin/orders/index">
                        <ul class="list-inline list-unstyled">
                            <li>
                               <input type="text" class="form-control" autocomplete="off" value="<?php echo (!empty($_REQUEST['name'])) ? $_REQUEST['name'] : "" ?>" placeholder="Search" name="s"/>
                            </li>
                            <li>
                               <button class="btn btn-primary" type="submit" name="search">Search</button>
                               <?php if (isset($_REQUEST['search'])) { ?>
                                  <a class="btn btn-danger" href="<?php echo BASE_URL; ?>admin/orders/index">Cancel</a>    
                                <?php } ?>
                            </li>
                        </ul>
                    </form>
                </div>
                </div>
                <div id="qrice-table">
                <div class="custom-table product-table">
                    <table class="uk-table" cellspacing="0" width="100%" >
                        <thead class="xs-hidden">
                            <tr>
                                <th>Order Id</th>
                                <th>Order Status</th>
                                <th>Customer Name</th>
                                <th>Order Date</th>
                                <th>Items</th>
                                <th>Net Payable Amount</th>
                                <th>Payment Mode</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = $this->Paginator->counter('{:start}');
                            foreach ($orders as $order) {
                                $items=ClassRegistry::init('Orderdetail')->find('count',array('conditions'=>array('order_id'=>$order['Order']['order_id'])));
                                ?>
                                <tr>
                                    <td data-title="Order Id"><?php echo $order['Order']['orderid']; ?></td>
                                    <td data-title="Order Status"><?php echo $order['Order']['order_status']; ?></td>
                                    <td data-title="Customer Name"><?php echo $order['User']['name']; ?></td>
                                    <td data-title="Order Date"><?php echo date('d-m-Y',strtotime($order['Order']['datetime'])); ?></td>
                                    <td data-title="Items"><?php echo $items; ?></td>
                                    <td data-title="Net Payable Amount">Rs. <?php echo $order['Order']['total_amount']; ?></td>
                                    <td data-title="Payment Mode"><?php echo $order['Order']['payment_method']; ?></td>
                                    <td data-title="Action">
                                        <a href="<?php echo BASE_URL; ?>admin/orders/vieworder/<?php echo $order['Order']['order_id']; ?>"><i class="md-icon material-icons">visibility</i></a>
                                        <a href="<?php echo BASE_URL; ?>admin/orders/cancelorder/<?php echo $order['Order']['order_id']; ?>" class="md-btn md-btn-<?php echo ($order['Order']['status'] != 'Cancelled') ? 'warning' : 'danger' ?> md-btn-mini">Cancel order</a>

                                    </td>
                                </tr>
                            <?php }$i++; ?>
                        </tbody>
                    </table>
                </div>
                </div>
                <div class="row mob-tfo">
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
                                <div class="dataTables_paginate paging_simple_numbers pull-right dataTables_paginate paging_simple_numbers" id="sample-table-2_paginate">
                                    <ul class="pagination">
                                        <?php
                                        echo $this->Paginator->prev('Previous', array('tag' => 'li', 'class' => 'page-link', 'escape' => false), '<a>Previous</a>', array('class' => 'prev disabled page-link', 'tag' => 'li', 'escape' => false));
                                        $numbers = $this->Paginator->numbers();
                                        if (empty($numbers)) {
                                            echo '<li class="active page-link"><a>1</a></li>';
                                        } else {
                                            echo $this->Paginator->numbers(array('separator' => '', 'tag' => 'li', 'class' => 'page-link', 'first' => 'First page', 'currentClass' => 'active', 'currentTag' => 'a'));
                                        }
                                        echo $this->Paginator->next('Next', array('tag' => 'li', 'class' => 'page-link', 'escape' => false), '<a>Next</a>', array('class' => 'next disabled page-link', 'tag' => 'li', 'escape' => false));
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
            </div>
        </div>
    </div>
</div>
<style>
    div#sample-table-2_paginate {
    float: right;
}ul.pagination {
    list-style: none;
    display: flex;
}li.prev.disabled.page-link a, li.next.disabled.page-link a {
    background: #ffffff;
    color: #333;
}li.active.page-link a {
    background: #7cb342;
    color: #fff;
    padding: 4px 10px;
    margin: 10px;
}.search {
        padding-left: 0px;
}.search ul {
    display: flex;
    list-style: none;
}.search ul input {
    border: 1px solid #e1e1e1;
    padding: 6px;
}button.btn.btn-primary {
    background: #338110;
    color: #ffff;
    padding: 5px;
    border: 1px solid #338110;
}a.btn.btn-danger {
    background: red;
    color: #fff;
    padding: 4px 5px;
    font-size: 12px;
    font-weight: 500;
}li.page-link a {
    color: #000;
    margin-right: 12px;
}
</style>
