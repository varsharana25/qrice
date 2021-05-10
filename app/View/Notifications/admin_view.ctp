<div id="page_content">
    <div id="page_content_inner">
        <div class="md-card">
            <div class="md-card-content">
                <div class="uk-grid" data-uk-grid-margin="" data-uk-grid-match="{target:'.md-card'}">
                    <div class="uk-width-medium-8-10 uk-row-first">
                        <h3 class="heading_a">Notification View Detail</h3>
                    </div>
                </div>
                <div class="uk-grid" data-uk-grid-margin>
                    <div class="uk-width-medium-1-2">
                        <div class="uk-form-row">
                            <label>Notification Id</label>
                            <input type="text" class="md-input" id="" disabled="" value="<?php echo ($notification['Notification']['id'] + 1000) ?>" />
                        </div>
                    </div>
                    <div class="uk-width-medium-1-2">
                        <div class="uk-form-row">
                            <label>Expiry Date</label>
                            <input type="text" class="md-input" id="" disabled="" value="<?php echo date('d-m-Y', strtotime($notification['Notification']['expiry_date'])) ?>" />
                        </div>
                    </div>
                    <div class="uk-width-medium-1-2">
                        <div class="uk-form-row">
                            <label>Customers</label>
                            <select id="select_adv_s2_2" disabled="" name="select_adv_s2_2" class="uk-width-1-1" multiple data-md-select2>
                                <option value="0" <?php echo (in_array('0', explode(',',$notification['Notification']['customers']))) ? 'selected' : '' ?>>All Customer</option>
                                <?php foreach ($customers as $customer) { ?>
                                    <option <?php echo (in_array($customer['User']['user_id'], explode(',',$notification['Notification']['customers']))) ? 'selected' : '' ?> value="<?php echo $customer['User']['user_id']; ?>"><?php echo $customer['User']['name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="uk-width-medium-1-2">
                        <div class="uk-form-row">
                            <label>Delivery Boys</label>
                            <select id="select_adv_s2_3" disabled="" name="select_adv_s2_2" class="uk-width-1-1" multiple data-md-select2>
                                <option value="0" <?php echo (in_array('0', explode(',',$notification['Notification']['deliveryboys']))) ? 'selected' : '' ?>>All Delivery Boys</option>
                                <?php foreach ($deliveryboys as $deliveryboy) { ?>
                                    <option <?php echo (in_array($deliveryboy['Deliveryboy']['deliveryboy_id'], explode(',',$notification['Notification']['deliveryboys']))) ? 'selected' : '' ?> value="<?php echo $deliveryboy['Deliveryboy']['deliveryboy_id']; ?>"><?php echo $deliveryboy['Deliveryboy']['name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="uk-width-medium-1-1">
                        <div class="uk-form-row">
                            <label>Notification Description</label>
                            <textarea rows="4" class="md-input" disabled=""><?php echo $notification['Notification']['text']; ?></textarea>
                        </div>
                    </div>
                    <div class="uk-width-medium-1-1 uk-grid-margin uk-row-first">
                        <div class="uk-form-row">
                            <a href="<?php echo BASE_URL; ?>admin/notifications" class="md-btn md-btn-danger">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
