<div id="page_content">
    <div id="page_content_inner">
        <div class="uk-grid uk-grid-medium">
           
            <div class="uk-width-medium-1-4">
                <div class="md-card cm_profile_box dash_box fuc_dark_02">
                    <div class="md-card-content">
                        <a href="<?php echo BASE_URL;?>admin/deliveryboys">
                            <span><i class="flaticon-loader"></i></span>
                            <h2>Total Delivery Boys</h2>
                            <p class="cm_count"><?php echo $data['deliveryboy']; ?></p>
                        </a>
                    </div>
                </div>
            </div>
            <div class="uk-width-medium-1-4">
                <div class="md-card cm_profile_box dash_box fuc_dark_03">
                    <div class="md-card-content">
                        <a href="<?php echo BASE_URL;?>admin/users">
                            <span><i class="flaticon-target"></i></span>
                            <h2>Total Customers</h2>
                            <p class="cm_count"><?php echo $data['customers']; ?></p>
                        </a>
                    </div>
                </div>
            </div>

            <div class="uk-width-medium-1-4">
                <div class="md-card cm_profile_box dash_box fuc_dark_04">
                    <div class="md-card-content">
                        <a href="<?php echo BASE_URL;?>admin/products">
                            <span><i class="flaticon-inventory"></i></span>
                            <h2>Total Products</h2>
                            <p class="cm_count"><?php echo $data['products']; ?></p>
                        </a>
                    </div>
                </div>
            </div>
            <div class="uk-width-medium-1-4 ">
                <div class="md-card cm_profile_box dash_box fuc_dark_05">
                    <div class="md-card-content">
                        <a href="<?php echo BASE_URL;?>admin/orders">
                            <span><i class="flaticon-checklist"></i></span>
                            <h2>Total Orders</h2>
                            <p class="cm_count"><?php echo $data['orders']; ?></p>

                        </a>
                    </div>
                </div>
            </div>
            <div class="uk-width-medium-1-4">
                <div class="md-card cm_profile_box dash_box fuc_dark_08">
                    <div class="md-card-content">
                        <a href="<?php echo BASE_URL;?>admin/productcategories">
                            <span><i class="flaticon-interface"></i></span>
                            <h2>Total Categories</h2>
                            <p class="cm_count"><?php echo $data['categories']; ?></p>
                        </a>
                    </div>
                </div>
            </div>
            <div class="uk-width-medium-1-4">
                <div class="md-card cm_profile_box dash_box fuc_dark_06">
                    <div class="md-card-content">
                        <a href="<?php echo BASE_URL;?>admin/products/lowstock">
                            <span><i class="flaticon-inventory"></i></span>
                            <h2>Low Stock Products</h2>
                            <p class="cm_count"><?php echo $data['lowstock']?></p>
                        </a>
                    </div>
                </div>
            </div>
            <div class="uk-width-medium-1-4">
                <div class="md-card cm_profile_box dash_box fuc_dark_07">
                    <div class="md-card-content">
                        <a href="<?php echo BASE_URL;?>admin/products/outofstock">
                            <span><i class="flaticon-inventory"></i></span>
                            <h2>Out of Stock Products</h2>
                            <p class="cm_count"><?php echo $data['outofstock'];?></p>
                        </a>
                    </div>
                </div>
            </div>
            <div class="uk-width-medium-1-4 ">
                <div class="md-card cm_profile_box dash_box fuc_dark_09">
                    <div class="md-card-content">
                        <a href="<?php echo BASE_URL;?>admin/products/instock">
                            <span><i class="flaticon-tag"></i></span>
                            <h2>Total Inventories</h2>
                            <p class="cm_count"><?php echo $data['inventory'];?></p>

                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>