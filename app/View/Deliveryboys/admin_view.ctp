
<div id="page_content">
    <div id="page_content_inner">


        <div class="uk-grid" data-uk-grid-margin data-uk-grid-match id="user_profile">
            <div class="uk-width-large-1-1">

                <div class="md-card">
                    <div class="user_heading">

                        <div class="user_heading_avatar">
                            <div class="thumbnail">
                                <img src="<?php echo BASE_URL; ?>files/deliveryboys/<?php echo $deliveryboy['Deliveryboy']['profile']; ?>" onerror="src='<?php echo BASE_URL; ?>img/default.png'" alt="user avatar" />
                            </div>
                        </div>
                        <div class="user_heading_content">
                            <h2 class="heading_b uk-margin-bottom"><span class="uk-text-truncate"><?php echo $deliveryboy['Deliveryboy']['name']; ?></span><span class="sub-heading">ID: <?php echo $deliveryboy['Deliveryboy']['deliveryboy_id']; ?> | Userid: <?php echo $deliveryboy['Deliveryboy']['deliveryboyid']; ?></span></h2>
                          
                        </div>

                    </div>
                    <div class="user_content">
                        <ul id="customer_tabs" class="uk-tab" data-uk-tab="{connect:'#customer_tabs_content', animation:'slide-horizontal'}" data-uk-sticky="{ top: 48, media: 960 }">
                            <li class="uk-active"><a href="#">General Info</a></li>
                            <li><a href="#">Orders</a></li>
                            <li><a href="#">Change password</a></li>
                        </ul>
                        <ul id="customer_tabs_content" class="uk-switcher uk-margin">
                            <li>
                                <div class="vw-pi">
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-2">
                                            <div class="uk-form-row">
                                                <label>User Id</label>
                                                <input type="text" class="md-input" id="" disabled="" value="<?php echo $deliveryboy['Deliveryboy']['deliveryboyid']; ?>" />

                                            </div>
                                        </div>
                                        <div class="uk-width-medium-1-2">
                                            <div class="uk-form-row">
                                                <label>Name</label>
                                                <input type="text" class="md-input" id="" disabled="" value="<?php echo $deliveryboy['Deliveryboy']['name']; ?>" />

                                            </div>
                                        </div>
                                        <div class="uk-width-medium-1-2">
                                            <div class="uk-form-row">
                                                <label>Mobile Number</label>
                                                <input type="text" class="md-input" name="" disabled="" value="<?php echo $deliveryboy['Deliveryboy']['mobile']; ?>" />

                                            </div>
                                        </div>
                                        <div class="uk-width-medium-1-2">
                                            <div class="uk-form-row">
                                                <label>Email Id</label>
                                                <input type="text" class="md-input" id="" disabled="" value="<?php echo $deliveryboy['Deliveryboy']['email']; ?>" />

                                            </div>
                                        </div>
                                        <div class="uk-width-medium-1-1">
                                            <div class="uk-form-row">
                                                <label>Address</label>
                                                <textarea rows="1" class="md-input" disabled=""><?php echo $deliveryboy['Deliveryboy']['address']; ?></textarea>


                                            </div>
                                        </div>
                                        <div class="uk-width-medium-1-1 uk-grid-margin uk-row-first">
                                            <div class="uk-form-row">
                                                <a class="md-btn md-btn-primary" href="<?php echo BASE_URL; ?>admin/deliveryboys/edit/<?php echo $deliveryboy['Deliveryboy']['deliveryboy_id']; ?>" target="_blank">Edit</a>

                                            </div>

                                        </div>


                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="vw-orders">

                                    <div class="custom-table">
                                        <table id="dt_individual_search" class="uk-table" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>

                                                    <th>Order ID</th>
                                                    <th>Order Status</th>
                                                    <th>Name</th>
                                                    <th>Order Date</th>
                                                    <th>Items</th>
                                                    <th>Delivery Date</th>
                                                    <th>Total Amount</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (!empty($orders)) {
                                                    foreach ($orders as $order) {
                                                        $items = ClassRegistry::init('Orderdetail')->find('count', array('conditions' => array('order_id' => $order['Order']['order_id'])));
                                                        $user = ClassRegistry::init('User')->find('count', array('conditions' => array('user_id' => $order['Order']['user_id'])));
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $order['Order']['orderid'] ?></td>
                                                            <td><?php echo $order['Order']['order_status'] ?></td>
                                                            <td><?php echo $user['User']['name'] ?></td>
                                                            <td><?php echo date('d-m-Y', strtotime($order['Order']['datetime'])) ?></td>
                                                            <td><?php echo $items; ?></td>
                                                            <td><?php echo !empty($order['Order']['delivery_datetime']) ? date('d-m-Y', strtotime($order['Order']['delivery_datetime'])) : ""?></td>
                                                            <td><?php echo $order['Order']['total_amount'] ?></td>
                                                            <td>
                                                                <a href="<?php echo BASE_URL; ?>admin/orders/orderdetail/<?php echo $order['Order']['order_id']; ?>"><i class="md-icon material-icons">visibility</i></a>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="vw-p-chnagepassword">
                                    <form method="POST" action="<?php echo BASE_URL; ?>admin/deliveryboys/updatepassword/<?php echo $deliveryboy['Deliveryboy']['deliveryboy_id'] ?>" class="validation_form">
                                        <div class="uk-grid" data-uk-grid-margin>
                                            <div class="uk-width-medium-1-2">
                                                <div class="uk-form-row">
                                                    <label>New Password</label>
                                                    <input type="password" class="md-input validate[required]" id="password" />
                                                </div>
                                                <div class="uk-form-row">
                                                    <label>Confirm Password</label>
                                                    <input type="password" class="md-input validate[required,equals[password]]" id="" value="" />
                                                </div>
                                                <div class="uk-form-row">
                                                    <button type="submit" class="md-btn md-btn-primary">Change</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>