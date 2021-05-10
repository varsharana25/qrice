
<div id="page_content">
    <div id="page_content_inner">

        <div class="md-card">
            <div class="md-card-content">
                <div class="uk-grid" data-uk-grid-margin="">
                    <div class="uk-width-medium-8-10 uk-row-first">
                        <h3 class="heading_a">Add Promo Code</h3>
                    </div>
                    <div class="uk-width-medium-2-10" align="right">
                    </div>
                </div>
                <form method="POST" action="#" class="validation_form">
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-1">
                            <div class="uk-form-row">
                                <select  name="data[Promocode][type]" class="md-input validate[required]">
                                    <option value="">Select Type</option>
                                    <option value="Fixed Value" <?php echo (!empty($this->request->data['Promocode']['type']) && $this->request->data['Promocode']['value'] == 'Fixed Value') ? 'selected' : '' ?>>Fixed Value</option>
                                    <option value="Percentage Value" <?php echo (!empty($this->request->data['Promocode']['type']) && $this->request->data['Promocode']['value'] == 'Percentage Value') ? 'selected' : '' ?>>Percentage Value</option>
                                </select>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-1">
                            <div class="uk-form-row">
                                <label>Enter Value</label>
                                <input type="text" class="md-input validate[required]" name="data[Promocode][value]" value="<?php echo (!empty($this->request->data['Promocode']['value'])) ? $this->request->data['Promocode']['value'] : "" ?>" />
                            </div>
                        </div>
                        <div class="uk-width-medium-1-1">
                            <div class="uk-form-row">
                                <button type="button" class="md-btn md-btn-primary md-btn-mini" id="generatecode">Genrate Code</button>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-1">
                            <div class="md-input-wrapper md-input-focus">
                                <label>Code</label>
                                <input type="text" class="md-input validate[required]" id="newcode" name="data[Promocode][code]" value="<?php echo (!empty($this->request->data['Promocode']['code'])) ? $this->request->data['Promocode']['code'] : "" ?>"/>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-1">
                            <div class="uk-form-row">
                                <label>Expiry Date</label>
                                <input type="date" class="md-input validate[required]" name="data[Promocode][expiry_date]" value="<?php echo (!empty($this->request->data['Promocode']['expiry_date'])) ? $this->request->data['Promocode']['expiry_date'] : date('Y-m-d') ?>"/>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-1">
                            <div class="uk-form-row">
                                <button type="submit" class="md-btn md-btn-primary">Add</button>
                                 <a href="<?php echo BASE_URL;?>admin/promocodes" class="md-btn md-btn-danger">Cancel</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>