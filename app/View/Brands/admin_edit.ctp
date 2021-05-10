<div id="page_content">
    <div id="page_content_inner">
        <form method="post" action="#" class="validation_form" enctype="multipart/form-data">
            <div class="md-card">
                <div class="md-card-content clearfix">
                    <div class="uk-grid" data-uk-grid-margin="">
                        <div class="uk-width-medium-8-10 uk-row-first">
                            <h3 class="heading_a">Edit Brand</h3>
                        </div>
                        <div class="uk-width-medium-2-10" align="right">
                        </div>
                    </div>
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-2">
                            <div class="uk-form-row">
                                <label>Brand ID</label>
                                <input type="text" class="md-input validate[required]" disabled="" value="<?php echo (!empty($this->request->data['Brand']['brand_id'])) ? $this->request->data['Brand']['brand_id']+1000 : "" ?>"/>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-2">
                            <div class="uk-form-row">
                                <label>Brand Name</label>
                                <input type="text" class="md-input validate[required]" name="data[Brand][name]" value="<?php echo (!empty($this->request->data['Brand']['name'])) ? $this->request->data['Brand']['name'] : "" ?>"/>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-1">
                        </div>
                        <div class="uk-width-medium-2-10">
                            <label>Brand Image</label>
                            <div id="file_upload-drop" class="uk-file-upload"  style="margin-top:10px;">
                                <a class="uk-form-file md-btn">choose file<input id="file_upload-select" type="file" name="data[Brand][image]" class="validate[required,custom[image]]"></a>
                            </div>
                            <div id="file_upload-progressbar" class="uk-progress uk-hidden">
                                <div class="uk-progress-bar" style="width:0">0%</div>
                            </div>
                        </div>
                        <img src="<?php echo BASE_URL;?>files/brands/<?php echo $this->request->data['Brand']['image'];?>" class="img-responsive" style="width: 200px;height: 150px;"/>
                        
                        <div class="uk-width-medium-1-1">
                            <div class="uk-form-row">
                                <button type="submit" class="md-btn md-btn-primary">Update</button>
                                 <a href="<?php echo BASE_URL;?>admin/brands" class="md-btn md-btn-danger">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
