<div id="page_content">
    <div id="page_content_inner">
        <div class="md-card">
            <div class="md-card-content">
                <form method="POST" action="#" class="validation_form" enctype="multipart/form-data">
                    <div class="uk-grid" data-uk-grid-margin="">
                        <div class="uk-width-medium-8-10 uk-row-first">
                            <h3 class="heading_a">Add Product</h3>
                        </div>
                        <div class="uk-width-medium-2-10" align="right">
                        </div>
                    </div>
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-2">
                            <div class="uk-form-row">
                                <label>Product Name</label>
                                <input type="text" class="md-input validate[required]" name="data[Product][name]" value="<?php echo (!empty($this->request->data['Product']['name'])) ? $this->request->data['Product']['name'] : "" ?>"/>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-2">
                            <div class="uk-form-row">
                                <select id="maincategory" name="data[Product][category_id]" class="validate[required] md-input">
                                    <option value="">Select Category</option>
                                    <?php foreach ($categories as $category) { ?>
                                        <option <?php echo (!empty($this->request->data['Product']['category_id']) && $this->request->data['Product']['category_id'] == $category['Productcategory']['procategory_id']) ? 'selected' : '' ?> value="<?php echo $category['Productcategory']['procategory_id']; ?>"><?php echo $category['Productcategory']['name']; ?></option>
                                    <?php } ?>>
                                </select>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-2">
                            <div class="uk-form-row">
                                <select id="subcategory" class="md-input" name="data[Product][subcategory_id]">
                                    <option value="">Select Sub Category</option>
                                </select>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-2">
                            <div class="uk-form-row">
                                <select id="" name="data[Product][brand_id]" class="validate[required] md-input">
                                    <option value="">Select Brand</option>
                                    <?php foreach ($brands as $brand) { ?>
                                        <option <?php echo (!empty($this->request->data['Product']['brand_id']) && $this->request->data['Product']['brand_id'] == $category['Productcategory']['procategory_id']) ? 'selected' : '' ?> value="<?php echo $brand['Brand']['brand_id']; ?>"><?php echo $brand['Brand']['name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="uk-width-medium-1-2">
                            <div class="uk-form-row">
                                 <input type="text" class="md-input validate[required]" name="data[Product][weight]" placeholder="Product Weight"/>
                                <!--<select id="select_demo_4" data-md-selectize name="data[Product][weight]" class="validate[required]">-->
                                <!--    <option value="">Weight</option>-->
                                <!--    <option value="500 Gm">500 Gm</option>-->
                                <!--    <option value="1 Kg">1 Kg</option>-->
                                <!--    <option value="5 Kg">5 Kg</option>-->
                                <!--    <option value="10 Kg">10 Kg</option>-->
                                <!--    <option value="25 Kg">25 Kg</option>-->
                                <!--</select>-->
                            </div>
                        </div>
                        <div class="uk-width-medium-1-2">
                            <div class="uk-form-row">
                                <label>M.R.P</label>
                                <input type="text" class="md-input validate[required,custom[number]]" value="<?php echo (!empty($this->request->data['Product']['mrp'])) ? $this->request->data['Product']['mrp'] : "" ?>" name="data[Product][mrp]"/>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-2">
                            <div class="uk-form-row">
                                <label>Our Price</label>
                                <input type="text" class="md-input validate[required,custom[number]]"  value="<?php echo (!empty($this->request->data['Product']['our_price'])) ? $this->request->data['Product']['our_price'] : "" ?>" name="data[Product][our_price]" />
                            </div>
                        </div>
                        <div class="uk-width-medium-1-2">
                            <div class="uk-form-row">
                                <label>Discount</label>
                                <input type="text" class="md-input validate[required]" value="<?php echo (!empty($this->request->data['Product']['discount'])) ? $this->request->data['Product']['discount'] : "" ?>" name="data[Product][discount]"/>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-2">
                            <div class="uk-form-row">
                                <label>Discount Price</label>
                                <input type="text" class="md-input validate[required,custom[number]]"  value="<?php echo (!empty($this->request->data['Product']['discount_price'])) ? $this->request->data['Product']['discount_price'] : "" ?>" name="data[Product][discount_price]" />
                            </div>
                        </div>
                        <div class="uk-width-medium-1-2">
                            <div class="uk-form-row">
                                <label>Add Inventory Value</label>
                                <input type="text" class="md-input validate[required,custom[number]]" value="<?php echo (!empty($this->request->data['Product']['inventory_value'])) ? $this->request->data['Product']['inventory_value'] : "" ?>" name="data[Product][inventory_value]"/>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-2">
                            <div class="uk-form-row">
                                <label>Add Low Stock Value</label>
                                <input type="text" class="md-input validate[required,custom[number]]" value="<?php echo (!empty($this->request->data['Product']['lowstock_value'])) ? $this->request->data['Product']['lowstock_value'] : "" ?>" name="data[Product][lowstock_value]"/>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-2">
                            <div class="uk-form-row">
                                <label>Select pincode</label>
                                <select id="select_adv_s2_2"  name="data[Product][pincode][]" class="uk-width-1-1 validate[required]" multiple data-md-select2>
                                    <?php 
                                    $pincodes = ClassRegistry::init('Pincode')->find('all');
                                    foreach ($pincodes as $pincode) { ?>
                                        <option value="<?php echo $pincode['Pincode']['pincode']; ?>"><?php echo $pincode['Pincode']['pincode']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
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
                        <div class="uk-width-medium-1-1">
                        </div>
                        <div class="uk-width-medium-2-10">
                            <div id="file_upload-drop" class="uk-file-upload">
                                <!--<p class="uk-text">Drop file to upload</p>-->
                                <!--<p class="uk-text-muted uk-text-small uk-margin-small-bottom">or</p>-->
                                <a class="uk-form-file md-btn">choose file<input id="file_upload-select" type="file" name="data[Product][image]" class="validate[required,custom[image]]"></a>
                            </div>
                            <div id="file_upload-progressbar" class="uk-progress uk-hidden">
                                <div class="uk-progress-bar" style="width:0">0%</div>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-1">
                            <div class="uk-form-row">
                                <button type="submit" class="md-btn md-btn-primary">Add</button>
                                <a href="<?php echo BASE_URL;?>admin/products" class="md-btn md-btn-danger">Cancel</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>

</script>