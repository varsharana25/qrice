<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-size-18">Vendor Detail</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href='<?php echo BASE_URL; ?>admin/vendors'>Vendors</a></li>
                            <li class="breadcrumb-item active">View</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>     
        <!-- end page title -->
        <div class="row">
            <div class="col-8">
                <div class="card view-card">
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-md-4  col-form-label">Vendor Name</label>
                            <div class="col-md-8">
                                <p><?php echo (!empty($vendor['Vendor']['full_name'])) ? $vendor['Vendor']['full_name'] : "" ?></p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4  col-form-label">Business category</label>
                            <div class="col-md-8">
                                <p><?php echo (!empty($vendor['Category']['name'])) ? $vendor['Category']['name'] : "" ?></p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4  col-form-label">Shop Name</label>
                            <div class="col-md-8">
                                <p><?php echo (!empty($vendor['Vendor']['shop_name'])) ? $vendor['Vendor']['shop_name'] : "" ?></p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4  col-form-label">Shop Logo</label>
                            <div class="col-md-8">
                                <img src="<?php echo BASE_URL; ?><?php echo $vendor['Vendor']['vendor_path'] . '/' . $vendor['Vendor']['shop_logo'] ?>" onerror="src='<?php echo BASE_URL; ?>img/noimg.png'" class='avatar-sm'/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4  col-form-label">Email</label>
                            <div class="col-md-8">
                                <p><?php echo (!empty($vendor['Vendor']['email'])) ? $vendor['Vendor']['email'] : "" ?></p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4  col-form-label">Mobile</label>
                            <div class="col-md-8">
                                <p><?php echo (!empty($vendor['Vendor']['mobile'])) ? $vendor['Vendor']['mobile'] : "" ?></p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4  col-form-label">Location</label>
                            <div class="col-md-8">
                                <p><?php echo (!empty($vendor['Vendor']['location'])) ? $vendor['Vendor']['location'] : "" ?></p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4  col-form-label">District</label>
                            <div class="col-md-8">
                                <p><?php echo (!empty($vendor['Vendor']['district'])) ? $vendor['Vendor']['district'] : "" ?></p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4  col-form-label">State</label>
                            <div class="col-md-8">
                                <p><?php echo (!empty($vendor['Vendor']['state'])) ? $vendor['Vendor']['state'] : "" ?></p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4  col-form-label">State</label>
                            <div class="col-md-8">
                                <p><?php echo (!empty($vendor['Vendor']['state'])) ? $vendor['Vendor']['state'] : "" ?></p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4  col-form-label">Pincode</label>
                            <div class="col-md-8">
                                <p><?php echo (!empty($vendor['Vendor']['pincode'])) ? $vendor['Vendor']['pincode'] : "" ?></p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4  col-form-label">Status</label>
                            <div class="col-md-8">
                                <p><?php echo (!empty($vendor['Vendor']['status'])) ? $vendor['Vendor']['status'] : "" ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- end col -->
            <div class="col-4">
                <div class="card view-card">
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>Total Products</th>
                                <td>
                                    <?php
                                    $products = ClassRegistry::init('Product')->find('count', array('conditions' => array('status' => 'Active', 'vendor_id' => $vendor['Vendor']['vendor_id'])));
                                    echo $products;
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Total Orders</th>
                                <td>
                                    <?php
                                    $orders = ClassRegistry::init('Order')->find('count', array('conditions' => array('vendor_id' => $vendor['Vendor']['vendor_id'])));
                                    echo $orders;
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Total Subscriptions</th>
                                <td>
                                    <?php
                                    $subscriptions = ClassRegistry::init('Subscription')->find('count', array('conditions' => array( 'vendor_id' => $vendor['Vendor']['vendor_id'])));
                                    echo $subscriptions;
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Wallet Amount</th>
                                <td>Rs. <?php echo $vendor['Vendor']['wallet_amount']; ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
    </div>
</div>