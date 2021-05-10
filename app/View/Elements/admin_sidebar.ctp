<aside id="sidebar_main">
    <div class="sidebar_main_header">
        <div class="sidebar_logo">
            <a href="#" class="sSidebar_hide sidebar_logo_large">
                <img class="logo_regular" src="<?php echo BASE_URL; ?>theme/assets/img/custom/index.png" alt="" height="20" width="100" />
            </a>
            <span>Admin DashBoard</span>
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="menu_section">
        <ul>
            <?php
            if (($this->params['action'] == 'admin_dashboard')) {
                $class = "act_section current_section";
            } else {
                $class = "";
            }
            ?>
            <li class=" <?php echo $class; ?> " title="Dashboard">
                <a href="<?php echo BASE_URL; ?>admin/adminusers/dashboard">
                    <span class="menu_icon"><i class="flaticon-home"></i></span>
                    <span class="menu_title">Dashboard</span>
                </a>
            </li>
            <?php
            if (($this->params['controller'] == 'users')) {
                $class = "act_section current_section";
            } else {
                $class = "";
            }
            ?>
            <li title="Dashboard" class="<?php echo $class; ?>">
                <a href="<?php echo BASE_URL; ?>admin/users">
                    <span class="menu_icon">
                        <i class="flaticon-target"></i></span>
                    <span class="menu_title">Customers</span>
                </a>
                <ul>
                    <li><a href="<?php echo BASE_URL; ?>admin/users">Customers List</a></li>
                </ul>
            </li>
            <?php
            if (($this->params['controller'] == 'deliveryboys')) {
                $class = "act_section current_section";
            } else {
                $class = "";
            }
            ?>
            <li title="Chats" class="<?php echo $class; ?>">
                <a href="#">
                    <span class="menu_icon">
                        <i class="flaticon-loader"></i></span>
                    <span class="menu_title">Delivery Boys</span>
                </a>
                <ul>
                    <li><a href="<?php echo BASE_URL; ?>admin/deliveryboys/add">Add Delivery Boy</a></li>
                    <li><a href="<?php echo BASE_URL; ?>admin/deliveryboys/">Delivery Boys List</a></li>
                </ul>
            </li>
             <?php
            if (($this->params['controller'] == 'pincodes')) {
                $class = "act_section current_section";
            } else {
                $class = "";
            }
            ?>
            <li class="<?php echo $class; ?>">
                <a href="#">
                    <span class="menu_icon"><i class="flaticon-inventory"></i></span>
                    <span class="menu_title">Pincodes</span>
                </a>
                <ul>
                    <li><a href="<?php echo BASE_URL; ?>admin/pincodes/add">Add Pincode</a></li>
                    <li><a href="<?php echo BASE_URL; ?>admin/pincodes">Pincodes List</a></li>
                </ul>
            </li>
            <?php
            if (($this->params['controller'] == 'products')) {
                $class = "act_section current_section";
            } else {
                $class = "";
            }
            ?>
            <li title="Chats" class="<?php echo $class; ?>">
                <a href="#">
                    <span class="menu_icon"><i class="flaticon-inventory"></i></span>
                    <span class="menu_title">Products</span>
                </a>
                <ul>
                    <li><a href="<?php echo BASE_URL; ?>admin/products/add">Add Product</a></li>
                    <li><a href="<?php echo BASE_URL; ?>admin/products">Products List</a></li>
                </ul>
            </li>
            <?php
            if (($this->params['controller'] == 'categories')) {
                $class = "act_section current_section";
            } else {
                $class = "";
            }
            ?>
            <li title="Chats" class="<?php echo $class; ?>">
                <a href="#">
                    <span class="menu_icon"><i class="flaticon-interface"></i></span>
                    <span class="menu_title">Categories</span>
                </a>
                <ul>
                    <li><a href="<?php echo BASE_URL; ?>admin/productcategories/add">Add Category</a></li>
                    <li><a href="<?php echo BASE_URL; ?>admin/productcategories">Categories List</a></li>
                </ul>
            </li>
            <?php
            if (($this->params['controller'] == 'productsubcategories')) {
                $class = "act_section current_section";
            } else {
                $class = "";
            }
            ?>
            <li title="Chats" class="<?php echo $class; ?>">
                <a href="#">
                    <span class="menu_icon"><i class="flaticon-interface"></i></span>
                    <span class="menu_title">Subcategories</span>
                </a>
                <ul>
                    <li><a href="<?php echo BASE_URL; ?>admin/productsubcategories/add">Add Subcategory</a></li>
                    <li><a href="<?php echo BASE_URL; ?>admin/productsubcategories">Subcategories List</a></li>
                </ul>
            </li>
            <?php
            if (($this->params['controller'] == 'brands')) {
                $class = "act_section current_section";
            } else {
                $class = "";
            }
            ?>
            <li title="Chats" class="<?php echo $class; ?>">
                <a href="#">
                    <span class="menu_icon"><i class="flaticon-tag"></i></span>
                    <span class="menu_title">Brands</span>
                </a>
                <ul>
                    <li><a href="<?php echo BASE_URL; ?>admin/brands/add">Add Brand</a></li>
                    <li><a href="<?php echo BASE_URL; ?>admin/brands">Brands List</a></li>
                </ul>
            </li>
            <?php
            if (($this->params['controller'] == 'products')) {
                $class = "act_section current_section";
            } else {
                $class = "";
            }
            ?>
            <li title="Chats" class="<?php echo $class; ?>">
                <a href="#">
                    <span class="menu_icon"><i class="flaticon-inventory-1"></i></span>
                    <span class="menu_title">Inventories</span>
                </a>
                <ul>
                    <li class="menu_subtitle">In Stock Products</li>
                    <li><a href="<?php echo BASE_URL; ?>admin/products/instock">Products List</a></li>
                    <li class="menu_subtitle">Out of Stock Products</li>
                    <li><a href="<?php echo BASE_URL; ?>admin/products/outofstock">Products List</a></li>
                    <li class="menu_subtitle">Low Stock Products</li>
                    <li><a href="<?php echo BASE_URL; ?>admin/products/lowstock">Products List</a></li>
                </ul>
            </li>
            <?php
            if (($this->params['controller'] == 'orders')) {
                $class = "act_section current_section";
            } else {
                $class = "";
            }
            ?>
            <li title="Chats" class="<?php echo $class; ?>">
                <a href="#">
                    <span class="menu_icon"><i class="flaticon-checklist"></i></span>
                    <span class="menu_title">Orders</span>
                </a>
                <ul>
                    <li><a href="<?php echo BASE_URL; ?>admin/orders">Orders List</a></li>
                </ul>
            </li>
            <?php
            if (($this->params['controller'] == 'notifications' || $this->params['controller'] == 'offers')) {
                $class = "act_section current_section";
            } else {
                $class = "";
            }
            ?>
            <li title="Chats" class="<?php echo $class; ?>">
                <a href="#">
                    <span class="menu_icon"><i class="flaticon-discount"></i></span>
                    <span class="menu_title">Notification & Offers</span>
                </a>
                <ul>
                    <li class="menu_subtitle">Notifications</li>
                    <li><a href="<?php echo BASE_URL; ?>admin/notifications/send">Send Notification</a></li>
                    <li><a href="<?php echo BASE_URL; ?>admin/notifications">All Notifications</a></li>
                    <li class="menu_subtitle">Offers</li>
                    <li><a href="<?php echo BASE_URL; ?>admin/offers/send">Send Offer</a></li>
                    <li><a href="<?php echo BASE_URL; ?>admin/offers">All Offers</a></li>
                </ul>
            </li>
            <?php
            if (($this->params['controller'] == 'sliders')) {
                $class = "act_section current_section";
            } else {
                $class = "";
            }
            ?>
            <li title="Chats" class="<?php echo $class; ?>">
                <a href="#">
                    <span class="menu_icon"><i class="flaticon-ad-pop-up"></i></span>
                    <span class="menu_title">Banners</span>
                </a>
                <ul>
                    <li><a href="<?php echo BASE_URL; ?>admin/sliders/add">Add Banner</a></li>
                    <li><a href="<?php echo BASE_URL; ?>admin/sliders">Banners List</a></li>
                </ul>
            </li>
            <?php
            if (($this->params['controller'] == 'promocodes')) {
                $class = "act_section current_section";
            } else {
                $class = "";
            }
            ?>
            <li title="Chats" class="<?php echo $class; ?>">
                <a href="3">
                    <span class="menu_icon"><i class="flaticon-collaboration"></i></span>
                    <span class="menu_title">Promo Codes</span>
                </a>
                <ul>
                    <li><a href="<?php echo BASE_URL; ?>admin/promocodes/add">Add Promo Code</a></li>
                    <li><a href="<?php echo BASE_URL; ?>admin/promocodes">Promo Codes List</a></li>
                </ul>
            </li>
            <?php
            if (($this->params['controller'] == 'reviews')) {
                $class = "act_section current_section";
            } else {
                $class = "";
            }
            ?>
            <li title="Chats" class="<?php echo $class; ?>">
                <a href="#">
                    <span class="menu_icon"><i class="flaticon-rating"></i></span>
                    <span class="menu_title">Rate & Reviews</span>
                </a>
                <ul>
                    <li><a href="<?php echo BASE_URL; ?>admin/reviews">All Reviews</a></li>
                </ul>
            </li>
             <?php
            if (($this->params['controller'] == 'faqs')) {
                $class = "act_section current_section";
            } else {
                $class = "";
            }
            ?>
            <li title="Chats" class="<?php echo $class; ?>">
                <a href="#">
                    <span class="menu_icon"><i class="flaticon-question-mark"></i></span>
                    <span class="menu_title">App FAQS</span>
                </a>
                <ul>
                    <li><a href="<?php echo BASE_URL; ?>admin/faqs/add">Add FAQ</a></li>
                    <li><a href="<?php echo BASE_URL; ?>admin/faqs">FAQS List</a></li>
                </ul>
            </li>
            <?php
            if (($this->params['action'] == 'admin_contactus')) {
                $class = "act_section current_section";
            } else {
                $class = "";
            }
            ?>
            <li title="Chats" class="<?php echo $class; ?>">
                <a href="<?php echo BASE_URL; ?>admin/sitesettings/contactus">
                    <span class="menu_icon"><i class="flaticon-office-building"></i></span>
                    <span class="menu_title">App Contact Us</span>
                </a>
            </li>
            <?php
            if (($this->params['action'] == 'admin_ccms')) {
                $class = "act_section current_section";
            } else {
                $class = "";
            }
            ?>
            <li title="Chats">
                <a href="<?php echo BASE_URL; ?>admin/sitesettings/cms">
                    <span class="menu_icon"><i class="flaticon-office-building"></i></span>
                    <span class="menu_title">CMS</span>
                </a>
            </li>
            <li title="Chats" class="<?php echo $class; ?>">
                <a href="#">
                    <span class="menu_icon"><i></i></span>
                    <span class="menu_title"></span>
                </a>
            </li>
        </ul>
    </div>
</aside><!-- main sidebar end -->
