<div id="page_content">
    <div id="page_content_inner">
        <div class="md-card">
            <div class="md-card-content">
                <form method="POST" action="#" class="validation_form" enctype="multipart/form-data">
                    <div class="uk-grid" data-uk-grid-margin="">
                        <div class="uk-width-medium-8-10 uk-row-first">
                            <?php
                            if (!empty($_REQUEST['stock']) && $_REQUEST['stock'] == 'instock') {
                                $title = 'In Stock Product Detail';
                            } elseif (!empty($_REQUEST['stock']) && $_REQUEST['stock'] == 'outof') {
                                $title = 'Out of Stock Product Detail';
                            } elseif (!empty($_REQUEST['stock']) && $_REQUEST['stock'] == 'low') {
                                $title = 'Low Stock Product Detail';
                            } else {
                                $title = 'Product Detail';
                            }
                            ?>
                            <h3 class="heading_a"><?php echo $title; ?></h3>
                        </div>
                        <div class="uk-width-medium-2-10" align="right">
                        </div>
                    </div>
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-2">
                            <div class="uk-form-row">
                                <label>Product Id</label>
                                <input type="text" class="md-input validate[required]" disabled="" value="<?php echo (!empty($this->request->data['Product']['product_id'])) ? $this->request->data['Product']['product_id'] + 1000 : "" ?>"/>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-2">
                            <div class="uk-form-row">
                                <label>Product Name</label>
                                <input type="text" disabled="" class="md-input validate[required]" name="data[Product][name]" value="<?php echo (!empty($this->request->data['Product']['name'])) ? $this->request->data['Product']['name'] : "" ?>"/>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-2">
                            <div class="uk-form-row">
                                <select id="" name="data[Product][category_id]" disabled=""  class="validate[required] md-input">
                                    <option value="">Select Category</option>
                                    <?php foreach ($categories as $category) { ?>
                                        <option <?php echo (!empty($this->request->data['Product']['category_id']) && $this->request->data['Product']['category_id'] == $category['Productcategory']['procategory_id']) ? 'selected' : '' ?> value="<?php echo $category['Productcategory']['procategory_id']; ?>"><?php echo $category['Productcategory']['name']; ?></option>
                                    <?php } ?>>
                                </select>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-2">
                            <div class="uk-form-row">
                                <select id="subcategory" class=" md-input" disabled="">
                                    <option value="">Select Sub Category</option>
                                                                        <?php 
                                    foreach($subcategories as $subcategory){
                                    ?>
                                     <option <?php echo (!empty($this->request->data['Product']['subcategory_id']) && $this->request->data['Product']['subcategory_id'] == $subcategory['Productsubcategory']['prosubcategory_id']) ? 'selected' : '' ?> value="<?php echo $subcategory['Productsubcategory']['prosubcategory_id']; ?>"><?php echo $subcategory['Productsubcategory']['name']; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-2">
                            <div class="uk-form-row">
                                <select id="" name="data[Product][brand_id]" disabled=""   class="validate[required] md-input">
                                    <option value="">Select Brand</option>
                                    <?php foreach ($brands as $brand) { ?>
                                        <option <?php echo (!empty($this->request->data['Product']['brand_id']) && $this->request->data['Product']['brand_id'] == $brand['Brand']['brand_id']) ? 'selected' : '' ?> value="<?php echo $brand['Brand']['brand_id']; ?>"><?php echo $brand['Brand']['name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="uk-width-medium-1-2">
                            <div class="uk-form-row">
                                <label>Weight</label>
                                <input type="text" disabled="" class="md-input validate[required]" value="<?php echo (!empty($this->request->data['Product']['weight'])) ? $this->request->data['Product']['weight'] : "" ?>" name="data[Product][variation][]"/>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-2">
                            <div class="uk-form-row">
                                <label>M.R.P</label>
                                <input type="text" disabled="" class="md-input validate[required,custom[number]]" value="<?php echo (!empty($this->request->data['Product']['mrp'])) ? $this->request->data['Product']['mrp'] : "" ?>" name="data[Product][mrp][]"/>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-2">
                            <div class="uk-form-row">
                                <label>Our Price</label>
                                <input type="text" disabled="" class="md-input validate[required,custom[number]]"  value="<?php echo (!empty($this->request->data['Product']['our_price'])) ? $this->request->data['Product']['our_price'] : "" ?>" name="data[Product][salesprice][]" />
                            </div>
                        </div>
                        <div class="uk-width-medium-1-2">
                            <div class="uk-form-row">
                                <label>Discount</label>
                                <input type="text" disabled=""  class="md-input validate[required,custom[number]]" value="<?php echo (!empty($this->request->data['Product']['discount'])) ? $this->request->data['Product']['discount'] : "" ?>" name="data[Product][discount]"/>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-2">
                            <div class="uk-form-row">
                                <label>Discount Price</label>
                                <input type="text" disabled=""  class="md-input validate[required,custom[number]]"  value="<?php echo (!empty($this->request->data['Product']['discount_price'])) ? $this->request->data['Product']['discount_price'] : "" ?>" name="data[Product][discount_price]" />
                            </div>
                        </div>
                        <div class="uk-width-medium-1-2">
                            <div class="uk-form-row">
                                <label>Inventory Value</label>
                                <input type="text" disabled="" class="md-input validate[required,custom[number]]" value="<?php echo (!empty($this->request->data['Product']['inventory_value'])) ? $this->request->data['Product']['inventory_value'] : "" ?>" name="data[Product][inventory_value][]"/>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-2">
                            <div class="uk-form-row">
                                <label>Low Stock Value</label>
                                <input type="text" disabled="" class="md-input validate[required,custom[number]]" value="<?php echo (!empty($this->request->data['Product']['lowstock_value'])) ? $this->request->data['Product']['lowstock_value'] : "" ?>" name="data[Product][lowstock][]"/>
                            </div>
                        </div>
                        <?php if (!isset($_REQUEST['stock'])) { ?>
                            <div class="uk-width-medium-1-1">
                                <div class="uk-form-row">
                                    <label>Item Description</label>
                                    <textarea rows="2" class="md-input validate[required]" name="data[Product][description]"><?php echo (!empty($this->request->data['Product']['description'])) ? $this->request->data['Product']['description'] : "" ?></textarea>
                                </div>
                            </div>
                            <div class="uk-width-medium-1-1">
                                <div class="uk-form-row">
                                    <label>Features</label>
                                    <textarea rows="2" class="md-input validate[required]" name="data[Product][features]"><?php echo (!empty($this->request->data['Product']['features'])) ? $this->request->data['Product']['features'] : "" ?></textarea>
                                </div>
                            </div>
                        <?php } ?>
                        <div class="uk-width-medium-1-1">
                        </div>
                        <div class="uk-width-medium-2-10">
                            <img src="<?php echo BASE_URL; ?>files/products/<?php echo $product['Product']['image'] ?>" class="avatar-sm"/>
                        </div>
                        <div class="uk-width-medium-1-1">
                            <div class="uk-form-row">
                                <a href="<?php echo BASE_URL; ?>admin/products/edit/<?php echo $product['Product']['product_id']; ?><?php echo (!empty($_REQUEST['stock'])) ? '?stock=' . $_REQUEST['stock'] : '' ?>" class="md-btn md-btn-primary">Edit</a>
                                <?php if (!empty($_REQUEST['stock']) && $_REQUEST['stock'] == 'instock') { ?>
                                    <a href="<?php echo BASE_URL; ?>admin/products/instock" class="md-btn md-btn-danger">Cancel</a>
                                <?php } elseif (!empty($_REQUEST['stock']) && $_REQUEST['stock'] == 'outof') { ?>
                                    <a href="<?php echo BASE_URL; ?>admin/products/outofstock" class="md-btn md-btn-danger">Cancel</a>
                                <?php } elseif (!empty($_REQUEST['stock']) && $_REQUEST['stock'] == 'low') {
                                    ?>
                                    <a href="<?php echo BASE_URL; ?>admin/products/lowstock" class="md-btn md-btn-danger">Cancel</a>
                                <?php } else { ?>
                                    <a href="<?php echo BASE_URL; ?>admin/products" class="md-btn md-btn-danger">Cancel</a>
                                <?php }
                                ?>

                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>