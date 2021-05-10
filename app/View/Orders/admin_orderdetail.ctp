<div id="page_content">
    <div id="page_content_inner">
        <div class="uk-grid" data-uk-grid-margin data-uk-grid-match id="user_profile">
            <div class="uk-width-large-1-1">
                <div class="md-card">
                    <div class="user_heading">
                        <div class="user_heading_avatar">
                            <div class="thumbnail">
                                <?php
                                $user = ClassRegistry::init('User')->find('first', array('conditions' => array('user_id'=>$order['user_id'])));
                                ?>
                                <img src="<?php echo BASE_URL; ?>files/users/<?php echo $user['User']['profile'] ?>" onerror="src='<?php echo BASE_URL; ?>theme/assets/img/custom/avatar_11_tn@4x.png'" alt="user avatar" />
                            </div>
                        </div>
                        <div class="user_heading_content">
                            <h2 class="heading_b uk-margin-bottom"><span class="uk-text-truncate"><?php echo $user['User']['name'] ?></span><span class="sub-heading">Order ID: <?php echo $order['orderid']; ?> | Order Status: <?php echo $order['order_status'] ?></span></h2>
                        </div>
                    </div>
                    <div class="user_content">
                        <ul id="customer_tabs" class="uk-tab" data-uk-tab="{connect:'#customer_tabs_content', animation:'slide-horizontal'}" data-uk-sticky="{ top: 48, media: 960 }">
                            <li class="uk-active"><a href="#">Order Information</a></li>
                            <li><a href="#">Items</a></li>
                            <li><a href="#">Assigned Delivery Boy</a></li>
                        </ul>
                        <ul id="customer_tabs_content" class="uk-switcher uk-margin">
                            <li>
                                <div class="vw-odetail">
                                    <div class="uk-grid">
                                        <div class="uk-width-medium-1-4 uk-grid-margin">
                                            <div class="uk-form-row">
                                                <label>Order Id</label>
                                                <input type="text" class="md-input" id="" disabled="" value="<?php echo $order['orderid'] ?>"/>
                                            </div>
                                        </div>
                                        <div class="uk-width-medium-1-4 uk-grid-margin">
                                            <div class="uk-form-row">
                                                <label>Order Status</label>
                                                <input type="text" class="md-input" id="" disabled="" value="<?php echo $order['order_status'] ?>"/>
                                            </div>
                                        </div>
                                        <div class="uk-width-medium-1-4 uk-grid-margin">
                                            <div class="uk-form-row">
                                                <label>Name</label>
                                                <input type="text" class="md-input" name="" disabled="" value="<?php echo $user['User']['name'] ?>"/>
                                            </div>
                                        </div>
                                        <div class="uk-width-medium-1-4 uk-grid-margin">
                                            <div class="uk-form-row">
                                                <label>Order Date</label>
                                                <input type="text" class="md-input" id="" disabled="" value="<?php echo date('d-m-Y', strtotime($order['datetime'])) ?>"/>
                                            </div>
                                        </div>
                                        <div class="uk-width-medium-1-4 uk-grid-margin">
                                            <div class="uk-form-row">
                                                <label>Total Items</label>
                                                <input type="text" class="md-input" name="" disabled="" value="<?php echo count($orderdetails); ?>"/>
                                            </div>
                                        </div>

                                        <div class="uk-width-medium-1-4 uk-grid-margin">
                                            <div class="uk-form-row">
                                                <label>Total Amount</label>
                                                <input type="text" class="md-input" name="" disabled="" value="<?php echo $order['total_amount'] ?>"/>
                                            </div>
                                        </div>
                                        <div class="uk-width-medium-1-4 uk-grid-margin">
                                            <div class="uk-form-row">
                                                <label>Net Payable Amount</label>
                                                <input type="text" class="md-input" name="" disabled="" value="<?php echo $order['grand_total']; ?>"/>
                                            </div>
                                        </div>
                                        <div class="uk-width-medium-1-4 uk-grid-margin">
                                            <div class="uk-form-row">
                                                <label>Discount</label>
                                                <input type="text" class="md-input" name="" disabled="" value="<?php echo $order['discount_amount']; ?>"/>
                                            </div>
                                        </div>
                                        <div class="uk-width-medium-1-4 uk-grid-margin">
                                            <div class="uk-form-row">
                                                <label>Delivery Address</label>
                                                <input type="text" class="md-input" name="" disabled="" value="<?php echo $address['Deliveryaddress']['address']; ?>"/>
                                            </div>
                                        </div>
                                        <div class="uk-width-medium-1-4 uk-grid-margin">
                                            <div class="uk-form-row">
                                                <label>Phone No</label>
                                                <input type="text" class="md-input" name="" disabled="" value="+91<?php echo $address['Deliveryaddress']['mobile_number']; ?>"/>
                                            </div>
                                        </div>
                                        <div class="uk-width-medium-1-4 uk-grid-margin">
                                            <div class="uk-form-row">
                                                <label>Payment Mode</label>
                                                <input type="text" class="md-input" name="" disabled="" value="<?php echo $order['payment_method']; ?>"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="vw-orders">
                                    <div id="qrice-table">
                                    <div class="custom-table">
                                        <table id="dt_individual_search" class="uk-table" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>Product ID</th>
                                                    <th>Product Name</th>
                                                    <th>Quantity</th>
                                                    <th>Weight</th>
                                                    <th>Amount</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($orderdetails as $orderdetail) { 
                                                $product = ClassRegistry::init('Product')->find('first', array('conditions' => array('product_id'=>$orderdetail['product_id'])));
                                                ?>
                                                    <tr>
                                                        <td data-title="Product ID"><?php echo $product['Product']['product_id'];?></td>
                                                        <td data-title="Product Name"><?php echo $product['Product']['name']; ?></td>
                                                        <td data-title="Quantity"><?php echo $orderdetail['qty']; ?></td>
                                                        <td data-title="Weight"><?php echo $product['Product']['weight']; ?></td>
                                                        <td data-title="Amount"><?php echo $orderdetail['total_amount']; ?></td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="vw-transaction">
                                    <div class="custom-table">
                                        <?php $dboy = ClassRegistry::init('Deliveryboy')->find('first', array('conditions' => array('deliveryboy_id'=>$order['deliveryboy_id']))); ?>
                                        <?php if(!empty($dboy)) { ?>
                                        <h6>Assigned delivery boy : </h6>
                                        <p>Name    : <b><?php echo $dboy['Deliveryboy']['name'];?></b></p>
                                        <p>Mobile  : <b><?php echo $dboy['Deliveryboy']['mobile'];?></b></p>
                                        <p>Address : <b><?php echo $dboy['Deliveryboy']['address'];?></b></p>
                                        <?php } ?>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
