<div id="page_content">
    <div id="page_content_inner">
        <div class="md-card">
            <div class="md-card-content">
                <div class="uk-grid" data-uk-grid-margin="" data-uk-grid-match="{target:'.md-card'}">
                    <div class="uk-width-medium-8-10 uk-row-first">
                        <h3 class="heading_a">Send Offer</h3>
                    </div>
                </div>
                <form method="POST" action="#" class="validation_form">
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-1">
                            <div class="uk-form-row">
                                <label>Expiry Date</label>
                                <input type="date" class="md-input" id="" value="<?php echo (!empty($this->request->data['Offer']['expiry_date'])) ? $this->request->data['Offer']['expiry_date'] : date('Y-m-d') ?>" name="data[Offer][expiry_date]"/>

                            </div>
                        </div>
                        <div class="uk-width-medium-1-1">
                            <div class="uk-form-row">
                                <label>Send To Customers</label>
                                <select id="select_adv_s2_2"  name="data[Offer][customers][]" class="uk-width-1-1" multiple data-md-select2>
                                    <option value="0" <?php echo ((!empty($this->request->data['Offer']['customers'])) && in_array('0', $this->request->data['Offer']['customers'])) ? 'selected' : '' ?>>All Customer</option>
                                    <?php foreach ($customers as $customer) { ?>
                                        <option <?php echo ((!empty($this->request->data['Offer']['customers'])) && in_array($customer['User']['user_id'], explode(',', $this->request->data['Offer']['customers']))) ? 'selected' : '' ?> value="<?php echo $customer['User']['user_id']; ?>"><?php echo !empty($customer['User']['name']) ? $customer['User']['name'] : $customer['User']['email']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-1">
                            <div class="uk-form-row">
                                <label>Offer Description</label>
                                <textarea rows="4" class="md-input validate[required]" name="data[Offer][text]"><?php echo (!empty($this->request->data['Offer']['text'])) ? $this->request->data['Offer']['text'] : ""; ?></textarea>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-1 uk-grid-margin uk-row-first">
                            <div class="uk-form-row">
                                <button type="submit" class="md-btn md-btn-primary">Send</button>
                                 <a href="<?php echo BASE_URL;?>admin/offers" class="md-btn md-btn-danger">Cancel</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>