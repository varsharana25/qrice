
<div id="page_content">
    <div id="page_content_inner">
        <div class="md-card">
            <div class="md-card-content">
                <div class="uk-grid" data-uk-grid-margin="">
                    <div class="uk-width-medium-8-10 uk-row-first">
                        <h3 class="heading_a">App Contact Us Information</h3>
                    </div>
                    <div class="uk-width-medium-2-10" align="right">
                    </div>
                </div>
                <form method="POST" action="#">
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-2">
                            <div class="uk-form-row">
                                <label>Phone Number</label>
                                <input type="text" class="md-input validate[required,custom[phone]]" name="data[Sitesetting][phone]" disabled="" value="<?php echo $settings['Sitesetting']['phone'] ?>" />
                            </div>
                        </div>
                        <div class="uk-width-medium-1-2">
                            <div class="uk-form-row">
                                <label>Email ID</label>
                                <input type="text" class="md-input validate[required,custom[email]]" name="data[Sitesetting][email]" disabled="" value="<?php echo $settings['Sitesetting']['email'] ?>" />
                            </div>
                        </div>
                        <div class="uk-width-medium-1-2">
                            <div class="uk-form-row">
                                <label>Address</label>
                                <input type="text" class="md-input validate[required]" name="data[Sitesetting][address]" disabled="" value="<?php echo $settings['Sitesetting']['address'] ?>" />
                            </div>
                        </div>
                        <div class="uk-width-medium-1-1">
                            <div class="uk-form-row">
                                <a class="md-btn md-btn-primary edit" href="javascript:;">Edit</a>
                                <button type="submit" class="md-btn md-btn-primary update" style="display:none;">Update</button>
                                <a href="" class="md-btn md-btn-danger cancel">Cancel</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
