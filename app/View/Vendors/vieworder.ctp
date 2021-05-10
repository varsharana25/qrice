<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h5 class="mb-0 font-size-18">Order Detail</h5>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="<?php echo BASE_URL; ?>vendors/dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="<?php echo BASE_URL; ?>vendors/orders">Orders</a></li>
                            <li class="breadcrumb-item active">Order Detail</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>     
        <div class="row">
            <div class="col-lg-4 match">
                <div class="card">
                    <div class="card-body">
                        <div class="row form-group">
                            <label class="col-md-4">Order ID</label>
                            <div class="col-md-8">
                                <?php echo $order['Order']['orderid']; ?>
                            </div>
                        </div>
                        <div class="row form-group">
                            <label class="col-md-4">Order Status</label>
                            <div class="col-md-8">
                                <label class="badge badge-success"><?php echo $order['Order']['order_status']; ?></label>
                            </div>
                        </div>
                        <div class="row form-group">
                            <label class="col-md-4">User</label>
                            <div class="col-md-8">
                                <div class="media">
                                    <img class="mr-3 avatar-sm" src="<?php echo BASE_URL; ?>files/users/<?php echo $order['User']['profile']; ?>" onerror="src='<?php echo BASE_URL; ?>img/avatar.png'">
                                    <div class="media-body">
                                        <h5 class="mt-0"><?php echo (!empty($order['User']['name'])) ? $order['User']['name'] . '-' : ""; ?> <?php echo $order['User']['mobile'] ?></h5>
                                        <p><?php echo $order['User']['email']; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row form-group">
                            <label class="col-md-4">Total products</label>
                            <div class="col-md-8">
                                <?php echo $order['Order']['total_products']; ?>
                            </div>
                        </div>
                        <div class="row form-group">
                            <label class="col-md-4">Total Amount</label>
                            <div class="col-md-8">
                                Rs. <?php echo $order['Order']['total_amount']; ?>
                            </div>
                        </div>
                        <div class="row form-group">
                            <label class="col-md-4">Delivery Charge</label>
                            <div class="col-md-8">
                                Rs. <?php echo $order['Order']['delivery_charge']; ?>
                            </div>
                        </div>
                        <div class="row form-group">
                            <label class="col-md-4">Payment method</label>
                            <div class="col-md-8">
                                <?php echo $order['Order']['payment_method']; ?>
                            </div>
                        </div>
                        <div class="row form-group">
                            <label class="col-md-4">Payment id</label>
                            <div class="col-md-8">
                                <?php echo (!empty($order['Order']['payment_id'])) ? $order['Order']['payment_id'] : "-" ?>
                            </div>
                        </div>
                        <div class="row form-group">
                            <label class="col-md-4">Order Date</label>
                            <div class="col-md-8">
                                <?php echo date('d-m-Y', strtotime($order['Order']['datetime'])) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 match">
                <div class="card">
                    <div class="card-body">
                        <h5>Delivery Address - <?php echo $address['Deliveryaddress']['type']; ?> </h5>
                        <br/>
                        <div class="row form-group">
                            <label class="col-md-4">Location</label>
                            <div class="col-md-8">
                                <?php echo $address['Deliveryaddress']['location']; ?>
                            </div>
                        </div>
                        <div class="row form-group">
                            <label class="col-md-4">Flat No</label>
                            <div class="col-md-8">
                                <?php echo $address['Deliveryaddress']['flat_no']; ?>
                            </div>
                        </div>
                        <div class="row form-group">
                            <label class="col-md-4">Building</label>
                            <div class="col-md-8">
                                <?php echo $address['Deliveryaddress']['building']; ?>
                            </div>
                        </div>
                        <div class="row form-group">
                            <label class="col-md-4">Landmark</label>
                            <div class="col-md-8">
                                <?php echo $address['Deliveryaddress']['landmark']; ?>
                            </div>
                        </div>
                        <div class="row form-group">
                            <label class="col-md-4">Pincode</label>
                            <div class="col-md-8">
                                <?php echo $address['Deliveryaddress']['pincode']; ?>
                            </div>
                        </div>
                        <div class="row form-group">
                            <label class="col-md-4">Instruction</label>
                            <div class="col-md-8">
                                <?php echo (!empty($address['Deliveryaddress']['instruction'])) ? $address['Deliveryaddress']['instruction'] : "-"; ?>
                            </div>
                        </div>
                        <div class="row form-group">
                            <label class="col-md-4">Contact_person</label>
                            <div class="col-md-8">
                                <?php echo (!empty($address['Deliveryaddress']['contact_person'])) ? $address['Deliveryaddress']['contact_person'] : "-"; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="row form-group">
                            <label class="col-md-4">Assigned Delivery Boy</label>
                            <div class="col-md-8">
                                <?php echo $order['Deliveryboy']['name']; ?>
                            </div>
                        </div>
                        <div class="row form-group">
                            <label class="col-md-4">Delivery Boy Status</label>
                            <div class="col-md-8">
                                <label class="badge badge-<?php echo $order['Order']['deliveryboy_status']; ?>"><?php echo $order['Order']['deliveryboy_status']; ?></label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            if ($order['Order']['order_status'] != 'Cancelled') {
                $orderstatus = array('Order Placed', 'Order Picked Up', 'Order Delivered');
                $status_key = array_search($order['Order']['order_status'], $orderstatus);
                ?>
                <div class="col-lg-4 match">
                    <div class="card">
                        <div class="card-body">
                            <ul class="verti-timeline list-unstyled">
                                <li class="event-list <?php echo ($status_key == 0) ? 'active' : "" ?>">
                                    <div class="event-timeline-dot">
                                        <i class="bx bx-right-arrow-circle <?php echo ($status_key == 0) ? 'bxs-right-arrow-circle bx-fade-right' : "bx-right-arrow-circle" ?> font-size-18"></i>
                                    </div>
                                    <div class="media">
                                        <div class="media-body">
                                            <div>
                                                Order Placed
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="event-list <?php echo ($status_key == 1) ? 'active' : "" ?>">
                                    <div class="event-timeline-dot">
                                        <i class="bx <?php echo ($status_key == 1) ? 'bxs-right-arrow-circle bx-fade-right' : "bx-right-arrow-circle" ?>  font-size-18"></i>
                                    </div>
                                    <div class="media">
                                        <div class="media-body">
                                            <div>
                                                Order Picked Up
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="event-list  <?php echo ($status_key == 2) ? 'active' : "" ?>">
                                    <div class="event-timeline-dot">
                                        <i class="bx font-size-18  <?php echo ($status_key == 2) ? 'bxs-right-arrow-circle bx-fade-right' : "bx-right-arrow-circle" ?>"></i>
                                    </div>
                                    <div class="media">
                                        <div class="media-body">
                                            <div>
                                                Order Delivered
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <div class="col-lg-12 match">
                <h5>Ordered Products</h5>
                <div class="table-responsive">
                    <table class="table project-list-table table-nowrap table-centered table-borderless">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th></th>
                                <th>Product</th>
                                <th>Qty</th>
                                <th>Price</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody class="image-logo">
                            <?php
                            $i = 1;
                            foreach ($orderdetails as $orderdetail) {
                                ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><img src='<?php echo BASE_URL; ?><?php echo $sessionvendor['Vendor']['vendor_path'] ?>/<?php echo $orderdetail['Product']['image'] ?>' onerror="src='<?php echo BASE_URL; ?>img/noimg.png'" class="avatar-sm"/></td>
                                    <td><?php echo $orderdetail['Product']['name']; ?> - <?php echo $orderdetail['Productvariation']['variation']; ?></td>
                                    <td><?php echo $orderdetail['Orderdetail']['qty']; ?></td>
                                    <td>Rs. <?php echo $orderdetail['Productvariation']['price']; ?></td>
                                    <td>Rs. <?php echo $orderdetail['Orderdetail']['total_amount']; ?></td>
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
    </div> <!-- container-fluid -->
</div>