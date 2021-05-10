<div id="page_content">
    <div id="page_content_inner">
        <div class="md-card">
            <div class="md-card-content clearfix">
                <div class="uk-grid" data-uk-grid-margin="" data-uk-grid-match="{target:'.md-card'}">
                    <div class="uk-width-medium-8-10 uk-row-first">
                        <h3 class="heading_a">Product List</h3>
                    </div>
                    <div align="right" class="uk-width-medium-2-10">
                        <a href="<?php echo BASE_URL; ?>admin/products/add" type="button" class="md-btn md-btn-primary">+</a>
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
                                <th>M.R.P</th>
                                <th>Discount Price</th>
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
                                    <td class="red">Rs. <?php echo $product['Product']['mrp']; ?></td>
                                    <td class="green">Rs. <?php echo $product['Product']['discount_price']; ?></td>
                                    
                                    <td>
                                        <a href="<?php echo BASE_URL; ?>admin/products/view/<?php echo $product['Product']['product_id'] ?>"><i class="md-icon material-icons">visibility</i></a>
                                        <a href="<?php echo BASE_URL; ?>admin/products/edit/<?php echo $product['Product']['product_id'] ?>"><i class="md-icon material-icons">&#xE254;</i></a>
                                        <a href="<?php echo BASE_URL; ?>admin/products/delete/<?php echo $product['Product']['product_id'] ?>" class="delete"><i class="md-icon material-icons">delete</i></a>
                                        <a href="<?php echo BASE_URL; ?>admin/products/updatestatus/<?php echo $product['Product']['product_id'] ?>/<?php echo ($product['Product']['status'] == 'Active') ? 'Inactive' : 'Active' ?>" class="md-btn md-btn-<?php echo ($product['Product']['status'] == 'Active') ? 'success' : 'danger' ?> md-btn-mini"><?php echo $product['Product']['status']; ?></a>

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