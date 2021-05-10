<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-size-18">Orders</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="<?php echo BASE_URL; ?>vendors/dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item active">Orders</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>     
        <div class="card">
            <div class="card-body">
                <form method="get" action="<?php echo BASE_URL; ?>vendors/orders" class="form-inline">
                    <div class="form-group">
                        <input type="text" value="<?php echo isset($_REQUEST['s']) ? $_REQUEST['s'] : "" ?>" class="form-control validate[required]" name="s" placeholder="Search"/>
                    </div>
                    <div class="form-group">
                        <input type="text" value="<?php echo isset($_REQUEST['from_date']) ? $_REQUEST['from_date'] : "" ?>" class="form-control validate[required] datepicker" name="from_date" placeholder="From Date"/>
                    </div>
                    <div class="form-group">
                        <input type="text" value="<?php echo isset($_REQUEST['to_date']) ? $_REQUEST['to_date'] : "" ?>" class="form-control validate[required] datepicker" name="to_date" placeholder="To Date"/>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-danger top-search" name="search" type="submit">Search</button>
                        <?php if (isset($_REQUEST['search'])) { ?><a class="btn btn-warning" href="<?php echo BASE_URL; ?>vendors/orders">Cancel</a><?php } ?> 
                    </div>
                </form>
            </div>
        </div>
        <?php if (!empty($orders)) { ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="">
                        <div class="table-responsive">
                            <table class="table project-list-table table-nowrap table-centered table-borderless">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Order ID</th>
                                        <th>User</th>
                                        <th>Total Products</th>
                                        <th>Order Total</th>
                                        <th>Delivery Charge</th>
                                        <th>Delivery Address</th>
                                        <th>Order Status</th>
                                        <th>Order Date</th>
                                        <th  class="text-right"><?php echo __('Actions'); ?></th>
                                    </tr>
                                </thead>
                                <tbody class="image-logo">
                                    <?php
                                    $i = $this->Paginator->counter('{:start}');
                                    foreach ($orders as $order) {
                                        $address = $this->App->getDeliveryAddress($order['Order']['address_id']);
                                        ?>
                                        <tr>
                                            <td><?php echo h($i); ?></td>
                                            <td><?php echo $order['Order']['orderid'] ?></td>
                                            <td>
                                                <div class="media">
                                                    <img class="mr-3 avatar-sm" src="<?php echo BASE_URL; ?>files/users/<?php echo $order['User']['profile']; ?>" onerror="src='<?php echo BASE_URL; ?>img/avatar.png'">
                                                    <div class="media-body">
                                                        <h5 class="mt-0"><?php echo (!empty($order['User']['name'])) ? $order['User']['name'] . '-' : ""; ?> <?php echo $order['User']['mobile'] ?></h5>
                                                        <p><?php echo $order['User']['email']; ?></p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <?php echo $order['Order']['total_products']; ?>
                                            </td>
                                            <td>
                                                Rs. <?php echo $order['Order']['grand_total']; ?>
                                            </td>
                                            <td>
                                                Rs. <?php echo $order['Order']['delivery_charge']; ?>
                                            </td>
                                            <td>
                                                <?php echo $address; ?>
                                            </td>
                                            <td>
                                                <label class="badge badge-success"><?php echo $order['Order']['order_status']; ?></label>
                                            </td>
                                            <td>
                                                <?php echo $order['Deliveryboy']['name']; ?>
                                            </td>
                                            <td>
                                                <label class="badge badge-<?php echo $order['Order']['deliveryboy_status']; ?>"><?php echo $order['Order']['deliveryboy_status']; ?></label>
                                            </td>
                                            <td><?php echo date('d-m-Y', strtotime($order['Order']['datetime'])); ?></td>
                                            <td class="text-right">
                                                <div class="btn-group">        
                                                    <a href="<?php echo BASE_URL; ?>vendors/vieworder/<?php echo $order['Order']['order_id']; ?>" class="btn btn-outline-info" title="View Order">   
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