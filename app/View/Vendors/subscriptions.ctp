<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-size-18">Subscriptions</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="<?php echo BASE_URL; ?>vendors/dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item active">Subscriptions</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>     
        <div class="card">
            <div class="card-body">
                <form method="get" action="<?php echo BASE_URL; ?>vendors/subscriptions" class="form-inline">
                    <div class="form-group">
                        <input type="text" value="<?php echo isset($_REQUEST['s']) ? $_REQUEST['s'] : "" ?>" class="form-control validate[required]" name="s" placeholder="Search"/>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-danger top-search" name="search" type="submit">Search</button>
                        <?php if (isset($_REQUEST['search'])) { ?><a class="btn btn-warning" href="<?php echo BASE_URL; ?>vendors/orders">Cancel</a><?php } ?> 
                    </div>
                </form>
            </div>
        </div>
        <?php if (!empty($subscriptions)) { ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="">
                        <div class="table-responsive">
                            <table class="table project-list-table table-nowrap table-centered table-borderless">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Subscription ID</th>
                                        <th>User</th>
                                        <th>Product</th>
                                        <th>Qty</th>
                                        <th>Repeat</th>
                                        <th>Days</th>
                                        <th>Total Deliveries</th>
                                        <th>Pending Deliveries</th>
                                        <th>Total Amount</th>
                                        <th>Start Date</th>
                                        <th>Delivery Address</th>
                                        <th>Subscription Status</th>
                                        <th>Created Date</th>
                                        <th  class="text-right"><?php echo __('Actions'); ?></th>
                                    </tr>
                                </thead>
                                <tbody class="image-logo">
                                    <?php
                                    $i = $this->Paginator->counter('{:start}');
                                    foreach ($subscriptions as $subscription) {
                                        $address = $this->App->getDeliveryAddress($subscription['Subscription']['address_id']);
                                        ?>
                                        <tr>
                                            <td><?php echo h($i); ?></td>
                                            <td><?php echo $subscription['Subscription']['subscriptionid'] ?></td>
                                            <td>
                                                <div class="media">
                                                    <img class="mr-3 avatar-sm" src="<?php echo BASE_URL; ?>files/users/<?php echo $subscription['User']['profile']; ?>" onerror="src='<?php echo BASE_URL; ?>img/avatar.png'">
                                                    <div class="media-body">
                                                        <h5 class="mt-0"><?php echo (!empty($subscription['User']['name'])) ? $subscription['User']['name'] . '-' : ""; ?> <?php echo $subscription['User']['mobile'] ?></h5>
                                                        <p><?php echo $subscription['User']['email']; ?></p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="media">
                                                    <img class="mr-3 avatar-sm" src="<?php echo BASE_URL; ?><?php echo $sessionvendor['Vendor']['vendor_path']; ?>/<?php echo $subscription['Product']['image'] ?>" onerror="src='<?php echo BASE_URL; ?>img/noimg.png'">
                                                    <div class="media-body">
                                                        <p><?php echo $subscription['Product']['name']; ?></p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <?php echo $subscription['Subscriptiondetail']['qty']; ?>
                                            </td>
                                            <td>
                                                <?php echo $subscription['Subscriptiondetail']['repeat']; ?>
                                            </td>
                                            <td>
                                                <?php echo $subscription['Subscriptiondetail']['days']; ?>
                                            </td>
                                            <td>
                                                <?php echo $subscription['Subscriptiondetail']['total_deliveries']; ?>
                                            </td>
                                            <td>
                                                <?php echo $subscription['Subscriptiondetail']['pending_deliveries']; ?>
                                            </td>
                                            <td>
                                                Rs. <?php echo $subscription['Subscriptiondetail']['total_amount']; ?>
                                            </td>
                                            <td>
                                                <?php echo date('d-m-Y',strtotime($subscription['Subscriptiondetail']['start_date'])); ?>
                                            </td>
                                            <td>
                                                <?php echo $address; ?>
                                            </td>
                                            <td>
                                                <label class="badge badge-success"><?php echo $subscription['Subscriptiondetail']['status']; ?></label>
                                            </td>
                                            <td><?php echo date('d-m-Y', strtotime($subscription['Subscription']['datetime'])); ?></td>
                                            <td class="text-right">
                                                <div class="btn-group">        
                                                    <a href="<?php echo BASE_URL; ?>vendors/viewsubscription/<?php echo $subscription['Subscriptiondetail']['subdetail_id']; ?>" class="btn btn-outline-info" title="View Subscription">   
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                </div>
                                            </td>
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
            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-12">
                    <ul class="pagination pagination-rounded justify-content-center mt-4">
                        <?php
                        echo $this->Paginator->prev('<i class="mdi mdi-chevron-left"></i>', array('tag' => 'li', 'class' => 'page-link', 'escape' => false), '<a><i class="mdi mdi-chevron-left"></i></a>', array('class' => 'prev disabled page-link', 'tag' => 'li', 'escape' => false));
                        $numbers = $this->Paginator->numbers();
                        if (empty($numbers)) {
                            echo '<li class="active page-link"><a>1</a></li>';
                        } else {
                            echo $this->Paginator->numbers(array('separator' => '', 'tag' => 'li', 'class' => 'page-link', 'first' => 'First page', 'currentClass' => 'active', 'currentTag' => 'a'));
                        }
                        echo $this->Paginator->next('<i class="mdi mdi-chevron-right"></i>', array('tag' => 'li', 'class' => 'page-link', 'escape' => false), '<a><i class="mdi mdi-chevron-right"></i></a>', array('class' => 'next disabled page-link', 'tag' => 'li', 'escape' => false));
                        ?>
                    </ul>
                </div> <!-- end col-->
            </div>
        <?php } else { ?>
            <div class="no-data text-center">
                <img src="<?php echo BASE_URL; ?>img/no-data.png"/>
            </div>
        <?php } ?>
        <!-- end row -->
    </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->
<style>
    h5.mt-0 {
        font-size: 13px;
    }
    img.avatar-sm {
        object-fit: cover;
        height: 3rem;
        width: 3rem;
        border-radius: 50%;
    }
    .badge-success {
        color: #fff;
        background-color: #34c34c;
    }
    label.badge {
        font-size: 13px;
    }
</style>