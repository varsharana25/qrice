<div id="page_content">
    <div id="page_content_inner">
        <div class="md-card">
            <form method="POST" action="#" class="validation_form" enctype="multipart/form-data">
                <div class="md-card-content">
                    <div class="uk-grid" data-uk-grid-margin="">
                        <div class="uk-width-medium-8-10 uk-row-first">
                            <h3 class="heading_a">Edit Delivery boy</h3>
                        </div>
                        <div class="uk-width-medium-2-10" align="right">
                        </div>
                    </div>
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-2">
                            <div class="uk-form-row">
                                <label>Name</label>
                                <input type="text" class="md-input validate[required]" name="data[Deliveryboy][name]" value="<?php echo (!empty($this->request->data['Deliveryboy']['name'])) ? $this->request->data['Deliveryboy']['name'] : "" ?>" />
                            </div>
                        </div>
                        <div class="uk-width-medium-1-2">
                            <div class="uk-form-row">
                                <label>User Id</label>
                                <input type="text" class="md-input validate[required]" name="data[Deliveryboy][deliveryboyid]" value="<?php echo (!empty($this->request->data['Deliveryboy']['deliveryboyid'])) ? $this->request->data['Deliveryboy']['deliveryboyid'] : "" ?>" />
                            </div>
                        </div>
                        <div class="uk-width-medium-1-2">
                            <div class="uk-form-row">
                                <label>Mobile Number</label>
                                <input type="text" class="md-input validate[required]" name="data[Deliveryboy][mobile]" value="<?php echo (!empty($this->request->data['Deliveryboy']['mobile'])) ? $this->request->data['Deliveryboy']['mobile'] : "" ?>" />
                            </div>
                        </div>
                        <div class="uk-width-medium-1-2">
                            <div class="uk-form-row">
                                <label>Email Id</label>
                                <input type="text" class="md-input validate[required]" name="data[Deliveryboy][email]" value="<?php echo (!empty($this->request->data['Deliveryboy']['email'])) ? $this->request->data['Deliveryboy']['email'] : "" ?>" />
                            </div>
                        </div>
                        <div class="uk-width-medium-1-2">
                            <div class="uk-form-row">
                                <label>Password</label>
                                <input type="text" class="md-input validate[minSize[6]]" id="password" name="data[Deliveryboy][password]"/>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-1">
                            <div class="uk-form-row">
                                <label>Address</label>
                                <textarea rows="2" class="md-input validate[required]" name="data[Deliveryboy][address]"><?php echo (!empty($this->request->data['Deliveryboy']['address'])) ? $this->request->data['Deliveryboy']['address'] : "" ?></textarea>
                            </div>
                        </div>
                        <div class="uk-width-medium-2-10">
                            <div id="file_upload-drop" class="uk-file-upload">
                                <p class="uk-text">Drop file to upload</p>
                                <p class="uk-text-muted uk-text-small uk-margin-small-bottom">or</p>
                                <a class="uk-form-file md-btn">choose file<input id="file_upload-select" class="validate[custom[image]]" type="file" name="data[Deliveryboy][profile]"></a>
                            </div>
                            <div id="file_upload-progressbar" class="uk-progress uk-hidden">
                                <div class="uk-progress-bar" style="width:0">0%</div>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-1">
                            <div class="uk-form-row">
                                <button type="submit" class="md-btn md-btn-primary">Update</button>
                                <a href="<?php echo BASE_URL;?>admin/deliveryboys" class="md-btn md-btn-danger">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
