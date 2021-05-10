<div id="page_content">
    <div id="page_content_inner">
        <div class="md-card">
            <div class="md-card-content">
                <div class="uk-grid" data-uk-grid-margin="">
                    <div class="uk-width-medium-8-10 uk-row-first">
                        <h3 class="heading_a">App About Us Information</h3>
                    </div>
                    <div class="uk-width-medium-2-10" align="right">
                    </div>
                </div>
                <form method="POST" action="#" class="validation_form"> 
                    <div class="uk-grid" data-uk-grid-margin>
                                <div class="uk-width-medium-1-1">
                                  <div class="uk-form-row">
                                    <label>Sample Rice Charge</label>
                                    <input type="text" class="md-input validate[required]" name="data[Sitesetting][sample_rice_charge]" disabled="" value="<?php echo $settings['Sitesetting']['sample_rice_charge'] ?>" />
                                  </div>
                                </div>
                        
                                <div class="uk-width-medium-1-1">
                                  <div class="uk-form-row">
                                    <label>Delivery Charge ( per KM )</label>
                                    <input type="text" class="md-input validate[required]" name="data[Sitesetting][delivery_charge]" disabled="" value="<?php echo $settings['Sitesetting']['delivery_charge'] ?>" />
                                  </div>
                                </div>
                       
                        <div class="uk-width-medium-1-1">
                            <div class="uk-form-row">
                                <label>Description</label>
                                <textarea style="height:auto !important;" class="md-input validate[required]" name="data[Sitesetting][appinfo]" disabled=""><?php echo $settings['Sitesetting']['appinfo'] ?></textarea>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-1">
                            <div class="uk-form-row">
                                <label>Version</label>
                                <input type="text" class="md-input validate[required]" name="data[Sitesetting][appversion]" disabled="" value="<?php echo $settings['Sitesetting']['appversion'] ?>" />
                            </div>
                        </div>
                        <div class="uk-width-medium-1-1">
                            <div class="uk-form-row">
                                <label>Terms & Conditions</label>
                                <textarea style="height:auto !important;" class="md-input validate[required]" name="data[Sitesetting][terms_conditions]" disabled=""><?php echo $settings['Sitesetting']['terms_conditions'] ?> </textarea>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-1">
                            <div class="uk-form-row">
                                <label>Privacy Policy</label>
                                <textarea style="height:auto !important;" class="md-input validate[required]" name="data[Sitesetting][privacy_policy]" disabled=""><?php echo $settings['Sitesetting']['privacy_policy'] ?></textarea>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-1">
                            <div class="uk-form-row">
                                <a class="md-btn md-btn-primary edit editt" href="javascript:;">Edit</a>
                                <button type="submit" class="md-btn md-btn-primary update" style="display:none;">Update</button>
                                <a href="" class="md-btn md-btn-danger">Cancel</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://qrice.in/theme/assets/js/common.min.js"></script>
<script>

        $(document).on('click', '.editt', function () {

$('textarea').prop('disabled', function (i, v) {
                return !v;
            });
            $('.update').show();
            $(this).hide();
        });
            </script>