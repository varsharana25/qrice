<div id="page_content">
    <div id="page_content_inner">
        <div class="md-card">
            <form method="POST" action="#" class="validation_form" enctype="multipart/form-data">
                <div class="md-card-content">
                    <div class="uk-grid" data-uk-grid-margin="">
                        <div class="uk-width-medium-8-10 uk-row-first">
                            <h3 class="heading_a">Add Pincode</h3>
                        </div>
                        <div class="uk-width-medium-2-10" align="right">
                        </div>
                    </div>
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-1">
                            <div class="uk-form-row">
                                <label>Pincodes</label>
                                <input type="text" class="md-input validate[required]" name="data[Pincode][pincode]"/>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-1">
                            <div class="uk-form-row">
                                <button type="submit" class="md-btn md-btn-primary">Submit</button>
                                <a href="<?php echo BASE_URL;?>admin/pincodes" class="md-btn md-btn-danger">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>