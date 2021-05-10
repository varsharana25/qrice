<div id="page_content">
    <div id="page_content_inner">
        <div class="md-card">
            <div class="md-card-content">
                <div class="uk-grid" data-uk-grid-margin="">
                    <div class="uk-width-medium-8-10 uk-row-first">
                        <h3 class="heading_a">Add Banner</h3>
                    </div>
                    <div class="uk-width-medium-2-10" align="right">
                    </div>
                </div>
                <form method="post" enctype="multipart/form-data" class="validation_form">
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-2">
                            <div class="uk-form-row">
                                <div id="file_upload-drop" class="uk-file-upload">
                                    <!--<p class="uk-text">Drop file to upload</p>-->
                                    <!--<p class="uk-text-muted uk-text-small uk-margin-small-bottom">or</p>-->
                                     <p class="uk-text"></p>
                                    <p class="uk-text-muted uk-text-small uk-margin-small-bottom"></p>
                                    <a class="uk-form-file md-btn">choose file<input id="file_upload-select" type="file" class="prev_file validate[required,custom[image]]" name="data[Slider][image]"></a>
                                </div>
                                <small>Image size : 1200*630</small>
                                <div id="file_upload-progressbar" class="uk-progress uk-hidden">
                                    <div class="uk-progress-bar" style="width:0">0%</div>
                                </div>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-2">
                            <div class="uk-form-row">
                                <li class="uk-position-relative k-text-center">
                                    <button type="button" class="uk-modal-close uk-close uk-close-alt uk-position-absolute"></button>
                                    <img src="assets/img/custom/slide.jpg" width="80%" height="auto" alt="" class="prev_img" onerror="src='https://reactnativecode.com/wp-content/uploads/2018/02/Default_Image_Thumbnail.png'" style="max-width: 184px;"/>
                                </li>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-1">
                            <div class="uk-form-row">
                                <button type="submit" class="md-btn md-btn-primary">Add</button>
                                <a href="<?php echo BASE_URL;?>admin/sliders" class="md-btn md-btn-danger">Cancel</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<style>
    a.uk-form-file.md-btn {
        overflow: visible;
    }.uk-file-upload{
            padding: 52px 16px;
    }
</style>