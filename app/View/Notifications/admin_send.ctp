<div id="page_content">
    <div id="page_content_inner">
        <div class="md-card">
            <div class="md-card-content">
                <div class="uk-grid" data-uk-grid-margin="" data-uk-grid-match="{target:'.md-card'}">
                    <div class="uk-width-medium-8-10 uk-row-first">
                        <h3 class="heading_a">Send Notification</h3>
                    </div>
                </div>
                <form method="POST" action="#" class="validation_form">
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-1">
                            <div class="uk-form-row">
                                <label>Expiry Date</label>
                                <input type="date" class="md-input" id="" name="data[Notification][expiry_date]" value="<?php echo (!empty($this->request->data['Notification']['expiry_date'])) ? $this->request->data['Notification']['expiry_date'] : date('Y-m-d') ?>" placeholder="" />
                            </div>
                        </div>
                        <div class="uk-width-medium-1-1">
                            <div class="uk-form-row">
                                <label>Send To Customers</label>
                                <select id="select_adv_s2_2"  name="data[Notification][customers][]" class="uk-width-1-1" multiple data-md-select2>
                                    <option value="0" <?php echo ((!empty($this->request->data['Notification']['customers'])) && in_array('0', $this->request->data['Notification']['customers'])) ? 'selected' : '' ?>>All Customer</option>
                                    <?php foreach ($customers as $customer) { ?>
                                        <option <?php echo ((!empty($this->request->data['Notification']['customers'])) && in_array($customer['User']['user_id'], explode(',',$this->request->data['Notification']['customers']))) ? 'selected' : '' ?> value="<?php echo $customer['User']['user_id']; ?>"><?php echo !empty($customer['User']['name']) ? $customer['User']['name'] : $customer['User']['email']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-1">
                            <div class="uk-form-row">
                                <label>Send To Delivery Boys</label>
                                <select id="select_adv_s2_3" name="data[Notification][deliveryboys][]" class="uk-width-1-1" multiple data-md-select2>
                                    <option value="0" <?php echo ((!empty($this->request->data['Notification']['deliveryboys'])) && in_array('0', $this->request->data['Notification']['deliveryboys'])) ? 'selected' : '' ?>>All Delivery Boys</option>
                                    <?php foreach ($deliveryboys as $deliveryboy) { ?>
                                        <option <?php echo ((!empty($this->request->data['Notification']['deliveryboys'])) && in_array($deliveryboy['Deliveryboy']['deliveryboy_id'], explode(',',$this->request->data['Notification']['deliveryboys']))) ? 'selected' : '' ?> value="<?php echo $deliveryboy['Deliveryboy']['deliveryboy_id']; ?>"><?php echo $deliveryboy['Deliveryboy']['name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-1">
                            <div class="uk-form-row">
                                <label>Notification Description</label>
                                <textarea rows="4" class="md-input validate[required]" name="data[Notification][text]"><?php echo (!empty($this->request->data['Notification']['text'])) ? $this->request->data['Notification']['text'] : ""; ?></textarea>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-1 uk-grid-margin uk-row-first">
                            <div class="uk-form-row">
                                <button type="submit" class="md-btn md-btn-primary">Send</button>
                                 <a href="<?php echo BASE_URL;?>admin/notifications" class="md-btn md-btn-danger">Cancel</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>