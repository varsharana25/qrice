<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h5 class="mb-0 font-size-18">Subscription Detail</h5>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="<?php echo BASE_URL; ?>vendors/dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="<?php echo BASE_URL; ?>vendors/subscriptions">Subscriptions</a></li>
                            <li class="breadcrumb-item active">Subscription Detail</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>     
        <div class="row">
            <div class="col-lg-6 match">
                <div class="card">
                    <div class="card-body">
                        <div class="row form-group">
                            <label class="col-md-4">Subscription ID</label>
                            <div class="col-md-8">
                                <?php echo $subscription['Subscription']['subscriptionid']; ?>
                            </div>
                        </div>
                        <div class="row form-group">
                            <label class="col-md-4">Subscription Status</label>
                            <div class="col-md-8">
                                <label class="badge badge-success"><?php echo $subscription['Subscriptiondetail']['status']; ?></label>
                            </div>
                        </div>
                        <div class="row form-group">
                            <label class="col-md-4">User</label>
                            <div class="col-md-8">
                                <div class="media">
                                    <img class="mr-3 avatar-sm" src="<?php echo BASE_URL; ?>files/users/<?php echo $subscription['User']['profile']; ?>" onerror="src='<?php echo BASE_URL; ?>img/avatar.png'">
                                    <div class="media-body">
                                        <h5 class="mt-0"><?php echo (!empty($subscription['User']['name'])) ? $subscription['User']['name'] . '-' : ""; ?> <?php echo $subscription['User']['mobile'] ?></h5>
                                        <p><?php echo $subscription['User']['email']; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row form-group">
                            <label class="col-md-4">Product</label>
                            <div class="col-md-8">
                                <div class="media">
                                    <img src='<?php echo BASE_URL; ?><?php echo $sessionvendor['Vendor']['vendor_path'] ?>/<?php echo $subscription['Product']['image'] ?>' onerror="src='<?php echo BASE_URL; ?>img/noimg.png'" class="avatar-sm mr-3"/>
                                    <div class="media-body">
                                        <p><?php echo $subscription['Product']['name']; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row form-group">
                            <label class="col-md-4">Qty</label>
                            <div class="col-md-8">
                                <?php echo $subscription['Subscriptiondetail']['qty']; ?>
                            </div>
                        </div>
                        <div class="row form-group">
                            <label class="col-md-4">Repeat</label>
                            <div class="col-md-8">
                                <?php echo $subscription['Subscriptiondetail']['repeat']; ?>
                            </div>
                        </div>
                        <div class="row form-group">
                            <label class="col-md-4">Days</label>
                            <div class="col-md-8">
                                <?php echo $subscription['Subscriptiondetail']['days']; ?>
                            </div>
                        </div>
                        <div class="row form-group">
                            <label class="col-md-4">Total Deliveries</label>
                            <div class="col-md-8">
                                <?php echo $subscription['Subscriptiondetail']['total_deliveries']; ?>
                            </div>
                        </div>
                        <div class="row form-group">
                            <label class="col-md-4">Pending Deliveries</label>
                            <div class="col-md-8">
                                <?php echo $subscription['Subscriptiondetail']['pending_deliveries']; ?>
                            </div>
                        </div>
                        <div class="row form-group">
                            <label class="col-md-4">Total Amount</label>
                            <div class="col-md-8">
                                Rs. <?php echo $subscription['Subscriptiondetail']['total_amount']; ?>
                            </div>
                        </div>
                        <div class="row form-group">
                            <label class="col-md-4">Payment id</label>
                            <div class="col-md-8">
                                <?php echo (!empty($subscription['Subscriptiondetail']['payment_id'])) ? $subscription['Subscriptiondetail']['payment_id'] : "-" ?>
                            </div>
                        </div>
                        <div class="row form-group">
                            <label class="col-md-4">Created Date</label>
                            <div class="col-md-8">
                                <?php echo date('d-m-Y', strtotime($subscription['Subscription']['datetime'])) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 match">
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
            </div>
        </div>
    </div> <!-- container-fluid -->
</div>