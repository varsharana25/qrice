<div id="page_content">
    <div id="page_content_inner">
        <div class="md-card">
            <div class="md-card-content clearfix">
                <div class="uk-grid" data-uk-grid-margin="" data-uk-grid-match="{target:'.md-card'}">
                    <div class="uk-width-medium-8-10 uk-row-first">
                        <h3 class="heading_a">Out of Stock Product List</h3>
                    </div>
                </div>
                <div class="custom-table product-table">
                    <table id="dataTable" class="uk-table" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Product Id</th>
                                <th width="100px">Product Image</th>
                                <th>Product Name</th>
                                <th>Category</th>
                                <th>Available Quantity</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($products as $product) {
                                $brand = ClassRegistry::init('Brand')->find('first', array('conditions' => array('brand_id' => $product['Product']['brand_id'])));
                                $category = ClassRegistry::init('Productcategory')->find('first', array('conditions' => array('procategory_id' => $product['Product']['category_id'])));
                                $variation = ClassRegistry::init('Productvariation')->find('all', array('fields' => array('MAX(Productvariation.price) as max', 'MIN(Productvariation.price) as min'), 'conditions' => array('product_id' => $product['Product']['product_id'])));
                                ?>
                                <tr>
                                    <td><?php echo $product['Product']['product_id'] + 1000; ?></td>
                                    <td><img src="<?php echo BASE_URL; ?>files/products/<?php echo $product['Product']['image']; ?>" onerror="src='<?php echo BASE_URL; ?>img/noimg.png'" class="avatar-sm"/></td>
                                    <td><?php echo $product['Product']['name']; ?></td>
                                    <td><?php echo $category['Productcategory']['name']; ?></td>
                                    <td><?php echo $product['Product']['inventory_value']; ?></td>
                                    <td>
                                        <a href="<?php echo BASE_URL; ?>admin/products/view/<?php echo $product['Product']['product_id'] ?>?stock=outof"><i class="md-icon material-icons">visibility</i></a>
                                        <a href="<?php echo BASE_URL; ?>admin/products/edit/<?php echo $product['Product']['product_id'] ?>?stock=outof"><i class="md-icon material-icons">&#xE254;</i></a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>