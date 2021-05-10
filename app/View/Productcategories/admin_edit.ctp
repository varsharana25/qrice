<?php
$categories = ClassRegistry::init('Productcategory')->find('all', array('conditions' => array('parent_id' => '0', 'status' => 'Active')));
?>
<div id="page_content">
    <div id="page_content_inner">
        <div class="md-card">
            <form method="POST" action="#" class="validation_form"  enctype="multipart/form-data">
                <div class="md-card-content">
                    <div class="uk-grid" data-uk-grid-margin="">
                        <div class="uk-width-medium-8-10 uk-row-first">
                            <h3 class="heading_a">Update Category</h3>
                        </div>
                        <div class="uk-width-medium-2-10" align="right">
                        </div>
                    </div>
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-2">
                            <div class="uk-form-row">
                                <label>Category Id</label>
                                <input type="text" class="md-input validate[required]" disabled="" value="<?php echo (!empty($this->request->data['Productcategory']['procategory_id'])) ? $this->request->data['Productcategory']['procategory_id'] + 1000 : "" ?>"/>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-2">
                            <div class="uk-form-row">
                                <label>Category Name</label>
                                <input type="text" class="md-input validate[required]" name="data[Productcategory][name]" value="<?php echo (!empty($this->request->data['Productcategory']['name'])) ? $this->request->data['Productcategory']['name'] : "" ?>"/>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-1">
                        </div>
                        <div class="uk-width-medium-2-10">
                            <label>Category Image</label>
                            <div id="file_upload-drop" class="uk-file-upload"  style="margin-top:10px;">
                                <a class="uk-form-file md-btn">choose file<input id="file_upload-select" type="file" name="data[Productcategory][image]" class="validate[required,custom[image]]"></a>
                            </div>
                            <div id="file_upload-progressbar" class="uk-progress uk-hidden">
                                <div class="uk-progress-bar" style="width:0">0%</div>
                            </div>
                        </div>
                        <img src="<?php echo BASE_URL;?>files/category/<?php echo $this->request->data['Productcategory']['image'];?>" class="img-responsive" style="width: 200px;height: 150px;"/>
                        <!-- <div class="uk-width-medium-1-2">
                            <div class="uk-form-row">
                                <select id="select_demo_4" name="data[Productcategory][parent_id]" data-md-selectize>
                                    <option value="">[--Parent Category--]</option>
                        <?php foreach ($categories as $category) { ?>
                                            <option <?php //echo (!empty($this->request->data['Productcategory']['parent_id']) && $this->request->data['Productcategory']['parent_id'] == $category['Productcategory']['proprocategory_id']) ? 'selected' : ''  ?> value="<?php //echo $category['Productcategory']['proprocategory_id'];  ?>"><?php //echo $category['Productcategory']['name'];  ?></option>
                        <?php } ?>
                                </select>
                            </div>
                        </div> -->
                        <div class="uk-width-medium-1-1">
                            <div class="uk-form-row">
                                <button type="submit" class="md-btn md-btn-primary">Update</button>
                                <a href="<?php echo BASE_URL;?>admin/productcategories" class="md-btn md-btn-danger">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
