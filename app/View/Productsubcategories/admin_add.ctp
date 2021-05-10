<?php
$categories = ClassRegistry::init('Productcategory')->find('all', array('conditions' => array('parent_id' => '0', 'status' => 'Active')));
?>
<div id="page_content">
    <div id="page_content_inner">
        <div class="md-card">
            <form method="POST" action="#" class="validation_form">
                <div class="md-card-content">
                    <div class="uk-grid" data-uk-grid-margin="">
                        <div class="uk-width-medium-8-10 uk-row-first">
                            <h3 class="heading_a">Add Subcategory</h3>
                        </div>
                        <div class="uk-width-medium-2-10" align="right">
                        </div>
                    </div>
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-2">
                            <div class="uk-form-row">
                                <label>Subcategory Name</label>
                                <input type="text" class="md-input validate[required]" value="" name="data[Productsubcategory][name]" value="<?php echo (!empty($this->request->data['Productsubcategory']['name'])) ? $this->request->data['Productsubcategory']['name'] : "" ?>"/>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-2">
                            <div class="uk-form-row">
                                <select id="select_demo_4" name="data[Productsubcategory][parent_id]" data-md-selectize>
                                    <option value="">[--Select Category--]</option>
                                    <?php foreach ($categories as $category) { ?>
                                        <option <?php echo (!empty($this->request->data['Productcategory']['parent_id']) && $this->request->data['Productcategory']['parent_id'] == $category['Productcategory']['parent_id']) ? 'selected' : '' ?> value="<?php echo $category['Productcategory']['procategory_id']; ?>"><?php echo $category['Productcategory']['name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-1">
                            <div class="uk-form-row">
                                <button type="submit" class="md-btn md-btn-primary">Add</button>
                                <a href="<?php echo BASE_URL;?>admin/productsubcategories" class="md-btn md-btn-danger">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
